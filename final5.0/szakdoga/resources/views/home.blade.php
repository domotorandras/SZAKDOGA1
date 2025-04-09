<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kezdőoldal</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite(['resources/css/home.css', 'resources/js/home.js'])
</head>
<body>

    <div id="panorama"></div>
    
    <div class="container">
        <h1 id="titleLabel">
            @auth
                <a href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
            @endauth
            @guest
                Játékmód
            @endguest
        </h1>
        <div class="button-group">
            <button onclick="window.location.href='{{ route('districts') }}'"    id="districtsButton">Kerületek</button>
            <button onclick="window.location.href='{{ route('subdistricts') }}'" id="subDistrictsButton">Városrészek</button>
            <button onclick="window.location.href='{{ route('guessr') }}'"       id="guessrButton">Guessr</button>
        </div>

        <div class="button-group">
            <button onclick="window.location.href='{{ route('districts.leaderboard') }}'"    id="districtsLeaderboardButton"    hidden>Kerületek</button>
            <button onclick="window.location.href='{{ route('subdistricts.leaderboard') }}'" id="subDistrictsLeaderboardButton" hidden>Városrészek</button>
            <button onclick="window.location.href='{{ route('guessr.leaderboard') }}'"       id="guessrLeaderboardButton"       hidden>Guessr</button>
        </div>
        
        <div class="auth-buttons">
            <button class="redbutton" id="leaderboardButton">Ranglisták</button>
            <button class="redbutton"  onclick="window.location.href='{{ route('manual') }}'" id="manualButton">Használat</button>
            @guest
                <button class="greenbutton" onclick="window.location.href='{{ route('login') }}'"    id="loginButton">Bejelentkezés</button>
                <button class="greenbutton" onclick="window.location.href='{{ route('register')}}'"  id="registerButton">Regisztráció</button>
            @endguest
            @auth
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="greenbutton" id="logoutButton">Kijelentkezés</button>
                </form>
            @endauth
            <button class="redbutton" id="backButton" hidden>Vissza</button>
        </div>
    </div>

</body>
</html>
