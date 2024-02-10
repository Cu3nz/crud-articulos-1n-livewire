<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!--  Fontawesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  Sweetalert2  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('titulo')</title>
</head>

<body>
    <h1>
        <center>@yield('cabecera')</center>
    </h1>

    <div class="mx-auto w-3/4 p-4">
        @yield('contenido')
    </div>

</body>
@if (session('mensaje'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('mensaje') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

</html>
