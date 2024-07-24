<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="vh-100">
    <div class="container-fluid p-0 d-flex flex-column h-100">
        <div class="bg-primary d-flex flex-column justify-content-center align-items-center text-white py-3">
            <span class="h3">{{ $currentRoute }}</span>
            <span class="d-flex gap-5">
                @foreach ($navLink as $link => $url)
                    <li>
                        <a href="{{ $url }}" class="text-white">{{ $link }}</a>
                    </li>
                @endforeach
            </span>
        </div>
        <div class="flex-grow-1" style="">
            {{ $slot }}
        </div>
    </div>
</body>
</html>