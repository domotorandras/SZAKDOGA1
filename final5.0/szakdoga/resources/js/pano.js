fetch('/data/panos.json')
    .then(response => response.json()) 
    .then(data => {
        processData(data)
    })
    .catch(error => console.error('Error fetching JSON:', error))

function processData(data){
    
    const nextButton        = document.querySelector("#next")
    const homeButton        = document.querySelector("#homeButton")
    const panoramaDiv       = document.querySelector("#panorama")
    const resultDiv         = document.querySelector("#results")
    const firstRound        = document.querySelector("#firstRound")
    const secondRound       = document.querySelector("#secondRound")
    const thirdRound        = document.querySelector("#thirdRound")
    const finalResult       = document.querySelector("#finalResult")
    const guessMap          = document.querySelector('#map')
    const finalResultToPost = document.querySelector("#finalResultToPost")

    const arrayLength       = data["panos"].length
    const array             = Array.from({ length: arrayLength }, (_, i) => i + 1)
    const shuffledArray     = array.sort((a, b) => 0.5 - Math.random())

    const flagIcon = L.icon({
        iconUrl: 'icons/racing-flag.png',
        iconSize:    [32, 32],
        iconAnchor:  [4,  32],
        popupAnchor: [0, -32]
    });

    let   roundNumber   = 0
    let   guesses       = []
    let   randomName
    let   randomCoords
    let   randomSRC
    let   randomLat
    let   randomLong
    let   isFirstGuess
    let   guessedLat
    let   guessedLong
    let   score
    let   guessedMarker 
    let   randomMarker  
    let   connectLine
    
    let   map = L.map('map', { preferCanvas: true, attributionControl:false }).setView([47.4979, 19.0650], 11)
    map.invalidateSize()
    let   layer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            minZoom: 10,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map)
    
    nextButton.addEventListener("click", newRound)

    guessMap.addEventListener('mouseenter', () => {
        setTimeout(() => {
            map.invalidateSize();
        }, 310);
    });

    newRound()




    function newRound(){
        nextButton.hidden = true

        if(roundNumber == 2){
            nextButton.innerHTML = "Végeredmény"
        }

        if(roundNumber < 3){

            data["panos"].forEach(element => {
                if(element["id"] == shuffledArray[roundNumber]){
                    randomName   = element["name"]
                    randomCoords = element["coords"]
                }
            })

            randomSRC  = `/panoramas/${randomName}.jpg`
            randomLat  = Number(randomCoords.split(", ")[0]) 
            randomLong = Number(randomCoords.split(", ")[1])
              
            pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": `${randomSRC}`,
                "autoLoad": true,
                "compass": true,
                "showZoomCtrl": false, 
                "showFullscreenCtrl": false 
            })

            isFirstGuess = true

            map.on('click', function(e) {
                nextButton.hidden = false

                if(isFirstGuess){    
                    isFirstGuess  = false
                    guessedLat    = Number(e.latlng.lat.toFixed(6))
                    guessedLong   = Number(e.latlng.lng.toFixed(6))
                    guessedMarker = L.marker([guessedLat, guessedLong]).addTo(map)
                    randomMarker  = L.marker([randomLat, randomLong], { icon: flagIcon }).addTo(map);
                    connectLine   = L.polyline([[randomLat, randomLong], [guessedLat, guessedLong]], {
                        color: 'red',         
                        weight: 4,            
                        opacity: 0.7,         
                        dashArray: '5, 5'      
                    }).addTo(map)

                    guesses.push(differenceMeters(randomLat, randomLong, guessedLat, guessedLong))
                }
            })
            roundNumber++
        }else{
            score = ((Number(guesses[0]) + Number(guesses[1]) + Number(guesses[2])) / 3).toFixed(2)
            panoramaDiv.hidden      = true
            nextButton.hidden       = true
            homeButton.hidden       = true
            resultDiv.hidden        = false
            firstRound.innerHTML    = `${guesses[0]} méter`
            secondRound.innerHTML   = `${guesses[1]} méter`
            thirdRound.innerHTML    = `${guesses[2]} méter`
            finalResult.innerHTML   = `${score} méter`
            if(finalResultToPost !== null){
                finalResultToPost.value = score
            }
            resultDiv.classList.add('show')
            guessMap.classList.add('fullscreen')
            map.zoomControl.remove();
            map.setView([47.493014, 19.207988], 12)
            setTimeout(() => {
                map.invalidateSize();
            }, 310);
        }
    }        
}
    

function differenceMeters(randomLat, randomLong, guessedLat, guessedLong){
    const R = 6371000
    const latDiff = (guessedLat - randomLat) * (Math.PI / 180) * R
    const lonDiff = (guessedLong - randomLong) * (Math.PI / 180) * R * Math.cos((randomLat + guessedLat) / 2 * Math.PI / 180)
    return Math.sqrt(latDiff ** 2 + lonDiff ** 2).toFixed(2)
}