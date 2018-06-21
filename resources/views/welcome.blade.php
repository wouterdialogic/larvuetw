<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <style>

</style>
</head>
<body bg-grey-lightest font->
<div id="app">
    <div class="h-screen flex items-center justify-center bg-teal-lightest">
        <todo-component></todo-component>
    </div>
   {{--  <div class="container mx-auto px-4">
        <div class="flex bg-grey-lighter">
            <div class="flex-1 text-grey-darker text-center bg-grey-light px-4 py-2 m-2">
                <todo-component></todo-component>
            </div>
            <div class="flex-1 text-grey-darker text-center bg-grey-light px-4 py-2 m-2"> 
                <tailwind-component></tailwind-component>
            </div>
            <div class="flex-1 text-grey-darker text-center bg-grey-light px-4 py-2 m-2">3</div>
            
        </div>
    </div>
    <div class="container mx-auto px-4">
        <div class="flex bg-grey-lighter">
            <div class="flex-1 text-grey-darker text-center bg-grey-light px-4 py-2 m-2">
                
            </div>
        </div>
    </div>
    <example-component>wouer    </example-component>
</div> --}}
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
