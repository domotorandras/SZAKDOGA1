@php
    use App\Models\District;
    use App\Models\SubDistrict;
    use App\Models\Guessr;
@endphp

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->name }}</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite('resources/css/auth.css')
</head>
<body>

    <div id="panorama"></div>

    <div class="container">
        
        <h1>{{ Auth::user()->name }}</h1>

        <div class="content">

            <table>
                <tr>
                    <th>Játékmód</th>
                    <th>Max pontszám</th>
                </tr>
                <tr>
                    <td>Kerületek</td>
                    <td>
                        {{ ($score = District::where('player_id', Auth::user()->id)->orderBy('score', 'desc')->value('score')) !== null 
                            ? $score . '%' 
                            : 'Nincs elmentett pontszám' }}
                    </td>
                </tr>
                <tr>
                    <td>Városrészek</td>
                    <td>
                        {{ ($score = SubDistrict::where('player_id', Auth::user()->id)->orderBy('score', 'desc')->value('score')) !== null 
                            ? $score . '%' 
                            : 'Nincs elmentett pontszám' }}
                    </td>                
                </tr>
                <tr>
                    <td>Guessr</td>    
                    <td>
                        {{ ($score = Guessr::where('player_id', Auth::user()->id)->orderBy('score', 'desc')->value('score')) !== null 
                            ? $score . ' méter' 
                            : 'Nincs elmentett pontszám' }}
                    </td>     
                </tr>
            </table>
        
        <button id="menubutton" onclick="window.location.href='{{ route('home') }}'">Főmenü</button>
    </div>


    <script>

        const panoramaDiv   = document.querySelector("#panorama")

        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "/panoramas/ELTE.jpg",
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
