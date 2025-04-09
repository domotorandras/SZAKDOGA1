<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Használati utasítás</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite('resources/css/manual.css')

</head>
<body>

<body>
    <div id="panorama"></div>

    <div class="container">
        <h1>Használati utasítás</h1>

        <div class="content">
            <h2>Kerületek és Városrészek</h2>
            <ul class="styled-list">
                <li>A fent, középen kiírt kerületet vagy városrészt kell a térképen megkeresned és a térképen rákattintanod.</li>
                <li>A bal felső sarokban láthatod az eddig elért pontszámodat (%) és a sikeresen kitalált területek arányát az összeshez képest.</li>
                <li>A jobb felső sarokban állítható a nehézség, ez csak az alaptérképet változtatja, a pontszámot nem.</li>
                <li>Könnyű módban látszanak a térképen a kerületek / városrészek nevei, míg a nehéz mód csak egy vaktérkép.</li>
                <li>Minél többször rontod el a tippedet, annál kevesebb pontot kapsz a kitalált területre.</li>
                <li>A hibák színei:
                    <ul class="styled-sublist">
                        <li><span class="color-swatch white"></span> 0 hiba</li>
                        <li><span class="color-swatch yellow"></span> 1 hiba</li>
                        <li><span class="color-swatch orange"></span> 2 hiba</li>
                        <li><span class="color-swatch red"></span> 3 vagy annál több hiba</li>
                    </ul>
                </li>
                <li>Ha négyszer egymás után hibázol, megjelenik a célpont halvány pirossal.</li>
                <li>A pontszámod elmenthető a ranglistába, ha be be vagy jelentkezve az oldalon.</li>
            </ul>

            <h2>Guessr</h2>
            <ul class="styled-list">
                <li>Panorámakép alapján kell elhelyezni a helyszínt a jobb alsó térképen.</li>
                <li>Minél közelebb tippelsz, annál jobb helyezést kapsz.</li>
                <li>3 körből áll egy játék.</li>
                <li>A körök utány látszik a 3 kör eredménye és átlaga — ez a végleges pontszámod.</li>
                <li>A pontszámod elmenthető a ranglistába, ha be be vagy jelentkezve az oldalon.</li>
                <li>Minél kisebb a pontszámod (méter), annál jobb lesz a helyezésed.</li>
            </ul>
        </div>

        <div class="button-wrapper">
            <button id="menubutton" onclick="window.location.href='{{ route('home') }}'">Főmenü</button>
        </div>
    </div>

    <script>
        pannellum.viewer('panorama', {
            "type": "equirectangular",
            "panorama": "/panoramas/ELTE.jpg",
            "autoLoad": true,
            "autoRotate": 5, 
            "yaw": 240,
            "pitch": -10,
            "showZoomCtrl": false, 
            "showFullscreenCtrl": false 
        });
    </script>
</body>


</body>
</html>
