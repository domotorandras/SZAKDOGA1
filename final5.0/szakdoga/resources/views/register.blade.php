<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="icon" type="image/png" href="{{ asset('icons/pointer.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @vite('resources/css/auth.css')
</head>
<body>

    <div id="panorama"></div>

    <div class="container">
        <h1>Regisztráció</h1>

        <div class="content">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="inner">
                    <input 
                        class       ="inputfield"
                        type        ="text" 
                        id          ="name" 
                        name        ="name" 
                        value       ="{{ old('name') }}" 
                        placeholder ="Név"
                        autofocus
                    >

                    <input 
                        class       ="inputfield"
                        type        ="text" 
                        id          ="email" 
                        name        ="email" 
                        value       ="{{ old('email') }}" 
                        placeholder ="Email"
                    >

                    <input 
                        class       ="inputfield"
                        type        ="password" 
                        id          ="password" 
                        name        ="password" 
                        placeholder ="Jelszó"
                    >

                    <input 
                        class       ="inputfield"
                        type        ="password" 
                        id          ="password_confirmation" 
                        name        ="password_confirmation"
                        placeholder ="Jelszó megerősítése"
                    >

                    <button type="submit">Regisztráció</button>
                </form>

            </div>
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
