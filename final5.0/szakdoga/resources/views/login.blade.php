<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite('resources/css/auth.css')

</head>
<body>

    <div id="panorama"></div>

    <div class="container">
        
        <h1>Bejelentkezés</h1>

        <div class="content">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="inner">
                    <div>
                        <input
                            class       ="inputfield"
                            type        ="text" 
                            id          ="email" 
                            name        ="email" 
                            value       ="{{ old('email') }}" 
                            placeholder ="Email"
                            autofocus
                        >
                    </div>

                    <div>
                        <input 
                            class       ="inputfield"
                            type        ="password" 
                            id          ="password" 
                            name        ="password" 
                            placeholder ="Jelszó"
                        >
                    </div>

                    <button type="submit">Bejelentkezés</button>
                </div>
            </form>
            @if ($errors->any())
                <div class="errordiv">
                    <ul class="no-bullets">
                        @foreach ($errors->all() as $error)
                            <li class="error">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        
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
