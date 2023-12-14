<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POV IMOVEISTOCK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @livewireStyles
    @stack('styles')
    <style>
        .iphone-simulator {
            width: 375px;
            height: 812px;
            background: pink;
            background-size: cover;
        }
    </style>
</head>
<body>
<section class="d-flex justify-content-center mt-4" >
    <div class="iphone-simulator bg-white p-4 border rounded-3 shadow-lg" style="position:relative; overflow:auto;  ">
        @yield('content')
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@livewireScripts
@yield('scripts')
@stack('scripts')
</body>
</html>
