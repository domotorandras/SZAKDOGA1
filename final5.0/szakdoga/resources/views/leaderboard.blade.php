<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranglista</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite('resources/css/leaderboard.css')
</head>
<body>



    <div id="panorama"></div>

    <div class="button-container">
        <div class="button-group">
            <button onclick="window.location.href='{{ route('home')}}'" id="backButton">Főmenü</button>

            @if (!Request::is('districtsleaderboard'))
                <button onclick="window.location.href='{{ route('districts.leaderboard') }}'">Kerületek</button>
            @endif

            @if (!Request::is('subdistrictsleaderboard'))
                <button onclick="window.location.href='{{ route('subdistricts.leaderboard') }}'">Városrészek</button>
            @endif

            @if (!Request::is('guessrleaderboard'))
                <button onclick="window.location.href='{{ route('guessr.leaderboard') }}'">Guessr</button>
            @endif
        </div>
    </div>

    <div class="container">
        @switch(Request::path())
            @case('districtsleaderboard')
                <h1>Kerületek</h1>
                @break
            @case('subdistrictsleaderboard')
                <h1>Városrészek</h1>
                @break
            @case('guessrleaderboard')
                <h1>Guessr</h1>
                @break  
        @endswitch

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Név</th>
                        <th>Pontszám</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->player->name }}</td>
                            @switch(Request::path())
                                @case('guessrleaderboard')
                                    <td>{{ $record->score . ' méter' }}</td>
                                    @break
                                @default
                                    <td>{{ $record->score . '%' }}</td>
                                    @break
                            @endswitch
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const panoramaDiv   = document.querySelector("#panorama")

        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "/panoramas/AstoriaAluljaro.jpg",
            "autoLoad": true,
            "autoRotate": 5, 
            "yaw": 240,
            "pitch": -10,
            "showZoomCtrl": false, 
            "showFullscreenCtrl": false 
        })
    </script>

</body>
</html>