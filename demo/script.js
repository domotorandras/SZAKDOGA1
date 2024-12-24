fetch('./data/optimiseddata.geojson') //to run: index.html -> right click -> Open with Live Server
  .then(res => res.json())
  .then(data => {
    processData(data)
  })
  .catch(error => console.error('Error fetching the data:', error))

function processData(data) {

    var map = L.map('map').setView([47.5, 19.15], 11)

    // L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
    // 	attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ',
    // 	maxZoom: 16
    // }).addTo(map);


    // L.tileLayer('https://{s}.tile.thunderforest.com/mobile-atlas/{z}/{x}/{y}.png?apikey={apikey}', {
    // 	attribution: '&copy; <a href="http://www.thunderforest.com/">Thunderforest</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    // 	apikey: '<your apikey>',
    // 	maxZoom: 22
    // }).addTo(map);






    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        minZoom: 10,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map)




    const arr = Array.from({ length: data[0]["features"].length }, (_, i) => i )
    const shuffledArray = arr.sort((a, b) => 0.5 - Math.random())

    function newPoly(coords, name){
        
        var polygon = L.polygon(coords,
            {
                color:      'gray',
                fillColor:  '#0000',
                opacity:    1
            },)

        .on('mouseover', function (e) {
                            e.target.setStyle({fillColor: 'black'})})
        .on('mouseout', function (e) {
                            e.target.setStyle({fillColor: '#0000'})})
        .on('click', function (e) {
                            console.log(name)             
                            console.log("\n")
                            var target = data[0]["features"][shuffledArray.pop()]["properties"]["name"]
                            console.log(target)})
        .addTo(map)
    }


    for(let i = 0; i < data[0]["features"].length; i++){
        newPoly(data[0]["features"][i]["geometry"]["coordinates"], data[0]["features"][i]["properties"]["name"])
    }
}