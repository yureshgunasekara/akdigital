<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{$app->name}}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('styles/tw-elements.css')}}">
        <link rel="stylesheet" href="{{asset('styles/swiper-slider.css')}}">
        
        <script src="{{asset('script/swiper-slider.js')}}"></script>
        <script src="{{asset('script/smooth-scroll.min.js')}}"></script>
        
        {{-- vites --}}
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx'])
    </head>

    <body class="bg-white dark:bg-black text-gray-900 dark:text-white">
        @include('components.customize.navbar')
        <main class="">
            @include('components.customize.header')
            @include('components.customize.features')
            @include('components.customize.overview')
            @include('components.customize.demos')
            @include('components.customize.templates')
            @include('components.customize.testimonials')
            @include('components.customize.faqs')
            @include('components.customize.price-plan')
            @include('components.customize.footer')
        </main>

        <script src="{{asset('script/index.js')}}"></script>
        <script src="{{asset('script/video-player.js')}}"></script>
        <script src="{{asset('script/tw-elements.min.js')}}"></script>
        <script src="{{asset('script/scripts-tabs.js')}}"></script>
        <script src="{{asset('script/dialog.js')}}"></script>
    </body>
</html>