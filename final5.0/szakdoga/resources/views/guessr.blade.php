<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessr</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    @vite(['resources/css/pano.css', 'resources/js/pano.js'])
</head>
<body>



    <div id="panorama"></div>

    <div id="homeDiv">
        <button id="homeButton" onclick="window.location.href='{{ route('home') }}'">Főmenü</button>
    </div>
    
    <button id="next" hidden = true>Következő</button>

    <div id="map"></div>

    <div id="results" class="results-card" hidden>
        @auth
            <h2>Győztél, {{ Auth::user()->name }}!</h2>
        @else
            <h2>Győztél!</h2>
        @endauth
        <h2>Eredmények</h2>
        <table>
            <tbody>
                <tr>
                    <td>Első kör</td>
                    <td id="firstRound"></td>
                </tr>
                <tr>
                    <td>Második kör</td>
                    <td id="secondRound"></td>
                </tr>
                <tr>
                    <td>Harmadik kör</td>
                    <td id="thirdRound"></td>
                </tr>
                <tr class="final-row">
                    <td>Végeredmény</td>
                    <td id="finalResult"></td>
                </tr>
            </tbody>
        </table>
        <div id="resultActions" class="results-actions">
            <button id="mainMenu"    class="results-btn" onclick="window.location.href='{{ route('home') }}'" >Főmenü</button>
            <button id="newGame"     class="results-btn" onclick="window.location.href='{{ route('guessr') }}'" >Új Játék</button>
            <button id="leaderBoard" class="results-btn" onclick="window.location.href='{{ route('guessr.leaderboard') }}'" >Ranglista</button>
            @auth
                <form id="scoreForm" method="POST" action="{{ route('guessr.store') }}">
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