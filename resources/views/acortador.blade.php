<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acortador de URLs</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #63E5C5, #14366F);
        }

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border: 3px solid #14366F;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            width: 460px;
            max-width: 90%;
            text-align: center;
        }

        h1 {
            font-size: 45px;
            margin-bottom: 25px;
            color: #14366F;
        }

        label {
            display: block;
            font-size: 25px;
            margin-bottom: 15px;
            font-weight: bold;
            color: #14366F;
        }

        input[type="url"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        .cut-button {
            background-color: #45bc9eff;
            color: white;
            margin-top: 15px;
            padding: 12px 24px;
            font-size: 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease, background-color 0.5s ease;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .cut-button .icon {
            display: none;
            width: 29px;
            height: 29px;
        }

        .cut-button:hover .text {
            display: none;
        }

        .cut-button:hover .icon {
            display: inline;
        }

        .cut-button:hover {
            background-color: #395482ff;
            transform: scale(1.03);
        }

        .short-url {
            margin-top: 20px;
            font-size: 25px;
        }

        .short-url a {
            color: #14366F;
            font-weight: bold;
            word-break: break-all;
        }

        .short-url button {
            border: none;
            background: none;
            cursor: pointer;
            padding-left: 6px;
        }

        .short-url img {
            vertical-align: middle;
        }

        .error,
        .errors {
            color: #c62828;
            margin-top: 20px;
            font-size: 14px;
        }

        #copyMessage {
            display: none;
            color: green;
            font-size: 13px;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <h1>Acortador de URLs</h1>

        <form method="POST" action="/shorten">
            @csrf
            <label for="original_url">Introduce aquí tu URL:</label>
            <input type="url" name="original_url" id="original_url" required>
            <button type="submit" class="cut-button">
                <span class="text">Acortar</span>
                <img src="{{ asset('/tijeras.png') }}" alt="Tijeras" class="icon" />
            </button>
        </form>

        @if (session('short_url'))
            <div class="short-url">
                <p>
                    URL acortada:
                    <a href="{{ session('short_url') }}" target="_blank" id="shortUrl">
                        {{ session('short_url') }}
                    </a>
                    <button onclick="copyUrl()" title="Copiar al portapapeles"
                        style="border: none; background: none; cursor: pointer;">
                        <img src="{{ asset('clon.png') }}" alt="Copiar" width="20" style="vertical-align: middle;">
                    </button>
                </p>
                <small id="copyMessage" style="color: green; display: none;">¡Copiada!</small>
            </div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        function copyUrl() {
            const url = document.getElementById('shortUrl').href;
            navigator.clipboard.writeText(url).then(function () {
                const msg = document.getElementById('copyMessage');
                msg.style.display = 'inline';
                setTimeout(() => msg.style.display = 'none', 2000);
            });
        }
    </script>

</body>

</html>