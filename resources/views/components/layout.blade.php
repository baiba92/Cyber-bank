<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Cyber Bank</title>
</head>
<body class="relative min-h-screen font-['Helvetica'] flex flex-col items-center bg-gray-100">

@include('_header')

    <div class="relative flex w-[1200px] pt-20 pb-12">

        @include('_sidebar')

        {{ $slot }}

    </div>

@include('_footer')

</body>
</html>

