<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Városrészek</title>
    <script>window.mapGeoJsonPath = "{{ asset('data/optimisedDataSub.geojson') }}";</script>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>        
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    @vite(['resources/css/game.css', 'resources/js/map.js'])
</head>
<body>



    <div id="infos">

        <div id="homeDiv">
            <button id="homeButton" onclick="window.location.href='{{ route('home') }}'">Főmenü</button>
        </div>
        <div id="percentageDiv">
            <p id="percentage"></p>
        </div>
        <div id="guessedDiv">
            <p id="guessed"></p>
        </div>
        <div id="targetDiv">
            <p id="target"></p>
        </div>

        <div id="difficultyDiv" class="difficulty-wrapper">
            <span class="diff-label">könnyű</span>
            <label class="switch">
                <input type="checkbox" id="difficulty">
                <span class="slider round"></span>
            </label>
            <span class="diff-label">nehéz</span>
        </div>
        
    </div>    

    <div id="map"></div>

    <div id="results" class="results-card" hidden>
        @auth
            <h2>Győztél, {{ Auth::user()->name }}!</h2>
        @else
            <h2>Győztél!</h2>
        @endauth
        <h1>Pontosság: <span id = "finalResult"></span>%</h1>
        <div id="resultActions" class="results-actions">
            <button id="mainMenu"    class="results-btn" onclick="window.location.href='{{ route('home') }}'" >Főmenü</button>
            <button id="newGame"     class="results-btn" onclick="window.location.href='{{ route('subdistricts') }}'" >Új Játék</button>
            <button id="leaderBoard" class="results-btn" onclick="window.location.href='{{ route('subdistricts.leaderboard') }}'" >Ranglista</button>
            @auth
                <form id="scoreForm" method="POST" action="{{ route('subdistricts.store') }}">
                    @csrf
                    <input  type="hidden" name="score"     id="finalResultToPost">
                    <input  type="hidden" name="player_id" value="{{ Auth::user()->id }}">
                    <button type="submit" class="results-btn">Mentés</button>
                </form>
            @endauth
        </div>  
    </div>

</body>
</html>