function game(location){

    fetch(location)
        .then(res => res.json())
        .then(data => {
            processData(data)
        })
        .catch(error => console.error('Error fetching the data:', error))

    function processData(data) {

        const difficultySwitch  = document.querySelector("#difficulty")
        const mapDiv            = document.querySelector("#map")
        const infoHeader        = document.querySelector("#infos")
        const resultsDiv        = document.querySelector("#results")
        const finalResult       = document.querySelector("#finalResult")
        const percentageText    = document.querySelector("#percentage")
        const targetText        = document.querySelector("#target")
        const guessedText       = document.querySelector("#guessed")
        const finalResultToPost = document.querySelector("#finalResultToPost")

        const dataLength        = data["features"].length
        const arr               = Array.from({ length: dataLength }, (_, i) => i )
        const shuffledArray     = arr.sort((a, b) => 0.5 - Math.random())
        
        let target              = data["features"][shuffledArray.pop()]
        let targetName          = target["properties"]["name"]
        let clicked             = 0
        let correct             = 0
        let numOfGuesses        = 0
        let targetPolygon
        let score
        
        targetText.innerHTML    = targetName


        let map = L.map('map', { 
            zoomControl: false, 
            attributionControl:false
        }).setView([47.5, 19.15], 11)


        let easy = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 20,
                    minZoom: 10,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                })

        let hard = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
                    maxZoom: 20,
                    minZoom: 10,
                    attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ',
                })


        easy.addTo(map)
        
        

        difficultySwitch.addEventListener('change', function() {
            if(difficultySwitch.checked){
                easy.remove()
                hard.addTo(map)
            }else{
                hard.remove()
                easy.addTo(map)
            }
        })



        for(let i = 0; i < dataLength; i++){
            newPoly(
                data["features"][i]["geometry"]["coordinates"], 
                data["features"][i]["properties"]["name"]
            )
        }



        function newPoly(coords, name){

            let found = false
            
            let polygon = L.polygon(coords, {
                    color:      'gray',
                    fillColor:  '#0000',
                    opacity:    1,
            })

            .on('mouseover', function (e) {
                if(!found){
                    e.target.setStyle({fillColor: 'black'})
                }
            })

            .on('mouseout', function (e) {
                if(!found){
                    e.target.setStyle({fillColor: '#0000'})
                }
            })

            .on('click', function (e) {
            

                if(correct != dataLength){
                    clicked++
                    
                    
                    if(targetName === name){
                        found = true
                        switch(numOfGuesses){
                            case 0:
                                e.target.setStyle({fillColor : 'white'})
                                break
                            case 1:
                                e.target.setStyle({fillColor : 'yellow'})
                                break
                            case 2:
                                e.target.setStyle({fillColor : 'orange'})
                                break
                            default:
                                e.target.setStyle({fillColor : 'red'})
                                break
                        }
                        e.target.setStyle({fillOpacity: 1})

                        numOfGuesses = 0
                        correct ++

                        if(correct == dataLength){
                        // if(correct == 1){ //debugoláshoz
                            score = ((correct/clicked)*100).toFixed()
                            resultsDiv.hidden        = false
                            resultsDiv.classList.add('show');
                            infoHeader.style.display       = "none"
                            finalResult.innerHTML          = score
                            if(finalResultToPost !== null){
                                finalResultToPost.value = score
                            }
                        }else{
                            target                   = data["features"][shuffledArray.pop()]
                            targetName               = target["properties"]["name"]
                            targetText.innerHTML     = targetName
                            guessedText.innerHTML    = correct + "/" + dataLength
                        }
                        
                    }else{
                        numOfGuesses++

                        if(numOfGuesses == 4){

                            targetPolygon            = L.polygon(target["geometry"]["coordinates"]).addTo(map)
                            targetPolygon.customName = target["properties"]["name"]
                            targetPolygon.bringToBack()

                            targetPolygon.setStyle({
                                color: 'gray', 
                                fillColor: 'red',
                                fillOpacity: 0.3,
                            })

                            targetPolygon.on('click', function (e) {
                            
                                if(targetPolygon.customName === targetName){
                                    e.target.setStyle({fillOpacity: 1})
                                    correct ++
                                    found                 = true
                                    numOfGuesses          = 0
                                    target                = data["features"][shuffledArray.pop()]
                                    targetName            = target["properties"]["name"]
                                    targetText.innerHTML  = targetName
                                    guessedText.innerHTML = correct + "/" + dataLength
                                }
                            })                    
                        }
                    }
                    percentageText.innerHTML=((correct/clicked)*100).toFixed() + "%"
                }

            })
            .addTo(map)
        }
    }
}


if (typeof window.mapGeoJsonPath !== 'undefined') {
    game(window.mapGeoJsonPath)
} else {
    console.warn("No GeoJSON path provided!")
}

export default game