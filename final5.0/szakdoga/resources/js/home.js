const panoramaDiv                   = document.querySelector("#panorama")
const titleLabel                    = document.querySelector("#titleLabel")
const districtsButton               = document.querySelector("#districtsButton")
const subDistrictsButton            = document.querySelector("#subDistrictsButton")
const guessrButton                  = document.querySelector("#guessrButton")
const loginButton                   = document.querySelector("#loginButton")
const registerButton                = document.querySelector("#registerButton")
const leaderboardButton             = document.querySelector("#leaderboardButton")
const districtsLeaderboardButton    = document.querySelector("#districtsLeaderboardButton")
const subDistrictsLeaderboardButton = document.querySelector("#subDistrictsLeaderboardButton")
const guessrLeaderboardButton       = document.querySelector("#guessrLeaderboardButton")
const backButton                    = document.querySelector("#backButton")
const logoutButton                  = document.querySelector("#logoutButton")
const manualButton                  = document.querySelector("#manualButton")

leaderboardButton.addEventListener('click', () =>{
    titleLabel.innerHTML                 = "Ranglisták"
    districtsButton.hidden               = true   
    subDistrictsButton.hidden            = true
    guessrButton.hidden                  = true
    if(loginButton !== null){
        loginButton.hidden               = true
    }
    if(registerButton !== null){
        registerButton.hidden            = true
    }
    if(logoutButton !== null){
        logoutButton.hidden              = true
    }
    leaderboardButton.hidden             = true
    manualButton.hidden                  = true

    districtsLeaderboardButton.hidden    = false
    subDistrictsLeaderboardButton.hidden = false
    guessrLeaderboardButton.hidden       = false
    backButton.hidden                    = false
})

backButton.addEventListener('click', ()=>{
    titleLabel.innerHTML                 = "Játékmódok"
    districtsButton.hidden               = false   
    subDistrictsButton.hidden            = false
    guessrButton.hidden                  = false
    if(loginButton !== null){
        loginButton.hidden               = false
    }
    if(registerButton !== null){
        registerButton.hidden            = false
    }
    if(logoutButton !== null){
        logoutButton.hidden              = false
    }
    leaderboardButton.hidden             = false
    manualButton.hidden                  = false
    districtsLeaderboardButton.hidden    = true
    subDistrictsLeaderboardButton.hidden = true
    guessrLeaderboardButton.hidden       = true
    backButton.hidden                    = true
})


pannellum.viewer('panorama', {
    "type": "equirectangular",
    "panorama": "/panoramas/BP.jpg",
    "autoLoad": true,
    "autoRotate": -7, 
    "yaw": 0,
    "showZoomCtrl": false, 
    "showFullscreenCtrl": false 
})    
    