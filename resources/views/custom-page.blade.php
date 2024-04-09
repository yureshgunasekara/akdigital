<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{$app->name}}</title>

        {{-- vites --}}
        @viteReactRefresh
        @vite(['resources/js/app.jsx'])

        <!-- Styles -->
        <link href="{{asset('styles/katex.min.css')}}" rel="stylesheet">
        <link href="{{asset('styles/quill.snow.css')}}" rel="stylesheet">
    </head>

    <body>
        <main class="min-h-screen flex flex-col justify-between">
            <div>
                <nav id="navbar" class="block py-6 w-full max-w-full transition-all sticky top-0 z-40 px-6 bg-gray-100">
                    <div class="max-w-[1200px] w-full h-10 mx-auto flex items-center justify-between">
                        <a class="flex items-center" href="/">
                            <img src="{{asset($app->logo)}}" width="32" height="32" />
                            <p class="font-bold text-gray-700 ml-2">{{$app->name}}</p>
                        </a>
                    
                        <div data-te-collapse-item>
                            <ul 
                                data-te-navbar-nav-ref
                                class="mr-auto flex flex-row items-center gap-9 text-gray-700 font-medium" 
                            >
                                <li data-te-nav-item-ref>
                                    @if (auth()->user())
                                        <a href="/dashboard" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500">
                                            {{__('Dashboard')}}
                                        </a>
                                    @else
                                        <div class="flex items-center gap-5">
                                            <a href="/register" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500">
                                                {{__('Register')}}
                                            </a>
                                            <a href="/login" class="px-5 py-2 rounded-lg border border-primary-500 text-sm bg-primary-500  hover:bg-primary-600 text-white">
                                                {{__('Login')}}
                                            </a>
                                        </div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
        
                <div class="quill max-w-[1200px] w-full mx-auto">
                    <div class="ql-container ql-snow">
                        <div class="ql-editor">
                            {!! $current_page->content !!}
                        </div>
                    </div>
                </div>
            </div>
    
            <section id="footer" class="px-6 pt-20 relative overflow-hidden bg-gray-100">            
                <div class="px-6 max-w-[1200px] w-full mx-auto text-gray-600">
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-16 pb-10 border-b border-gray-300">
                        <div>
                            <div class="flex items-center mb-6">
                                <img src="{{asset($app->logo)}}" width="32" height="32" />
                                <p class="text-[22px] font-bold text-gray-900 ml-2">
                                    {{$app->name}}
                                </p>
                            </div>
            
                            <p class="!leading-7">
                                {{$app->description}}
                            </p>
                        </div>
            
                        <div class="grid grid-cols-12 gap-16 md:gap-4">
                            <div class="col-span-12 md:col-span-2"></div>
            
                            <div class="col-span-12 md:col-span-5">
                                <p class="font-bold text-gray-900 mb-6">{{__('Nav List')}}</p>
                
                                <ul class="flex flex-col gap-3">
                                    <li>
                                        <a class="" href="#header">{{__('Home')}}</a>
                                    </li>
                                    <li>
                                        <a class="" href="#demos">{{__('Demos')}}</a>
                                    </li>
                                    <li>
                                        <a class="" href="#templates">{{__('Templates')}}</a>
                                    </li>
                                    <li>
                                        <a class="" href="#faqs">{{__('Faqs')}}</a>
                                    </li>
                                    <li>
                                        <a class="" href="#price-plan">{{__('Pricing')}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-span-12 md:col-span-5">
                                <p class="font-bold text-gray-900 mb-6">{{__('Company')}}</p>
                
                                <ul class="flex flex-col gap-3">
                                    @if (count($custom_pages) > 0)
                                        @foreach ($custom_pages as $page)
                                            <li>
                                                <a href="/app/{{ $page->route }}">
                                                    {{ $page->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>{{__('Here will show custom created pages from dashboard')}}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                
                    <div class="flex flex-col-reverse md:flex-row gap-6 items-center justify-between py-10">
                        <p class="text14 font-medium text-center">
                            {{$app->copyright}}
                        </p>
            
                        <div class="pl-6 flex items-center flex-wrap gap-4">
                            @foreach ($socials as $social)
                                <a href={{$social->link}} target="_blank">
                                    <img src="/{{$social->logo}}" class="w-5 h-5" alt="" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </main>


        <script>
            let currentScroll = 0;
            const navbar = document.getElementById("navbar");

            window.addEventListener("scroll", function () {
                currentScroll = window.pageYOffset;
                if (navbar && currentScroll > 100) {
                    navbar.classList.add("shadow-card", "bg-white");
                } else {
                    navbar.classList.remove("shadow-card", "bg-white");
                }
            });
        </script>
        <script src="{{asset('script/tw-elements.min.js')}}"></script>
    </body>
</html>