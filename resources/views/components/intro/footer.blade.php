<section  class="relative overflow-hidden">
    <div class="hidden dark:block before:content-[''] before:absolute before:right-[56%] before:-bottom-[240px] before:z-10 before:w-[265px] sm:before:w-[565px] before:h-[90px] sm:before:h-[147px] before:blur-[115px] sm:before:blur-[175px] before:rounded-full before:pointer-events-none before:bg-[#997AF1]"></div>

    <div class="hidden dark:block before:content-[''] before:absolute before:left-[56%] before:bottom-0 before:z-10 before:w-[265px] sm:before:w-[565px] before:h-[90px] sm:before:h-[147px] before:blur-[115px] sm:before:blur-[175px] before:rounded-full before:pointer-events-none before:bg-[#CB7AF1]"></div>

    <div class="px-6">
        <div
            data-aos="fade-up" 
            data-aos-duration="1500" 
            data-aos-anchor-placement="center-bottom"
            class="relative z-10 max-w-[1000px] w-full mx-auto mb-[140px] intro-footer-bg-dark px-6 py-10 text-center rounded-lg"
        >
            <div class=" max-w-[700px] mx-auto">
                <h6 class="font-bold text-white">
                    {{$banner->title}}
                </h6>
            </div>

            <div class="max-w-[400px] mx-auto flex items-center justify-center gap-4 mt-8">
                <a 
                    href="{{$banner->child_sections[0]->section_links[0]->link_url}}" 
                    class="px-7 py-3 rounded-lg border text-sm font-bold border-white bg-white  hover:bg-gray-50 text-primary-500"
                >
                    {{$banner->child_sections[0]->section_links[0]->link_text}}
                </a>
                <a 
                    href="{{$banner->child_sections[0]->section_links[1]->link_url}}" 
                    class="px-7 py-3 rounded-lg border text-sm font-bold border-white hover:bg-primary-600/40 text-white"
                >
                    {{$banner->child_sections[0]->section_links[1]->link_text}}
                </a>
            </div>
        </div>
    </div>

    <div id="footer" class="px-6 pt-20 bg-gray-25 dark:bg-transparent">
        <div class="px-6 max-w-[1200px] w-full mx-auto text-gray-600 dark:text-white">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-16 pb-10 border-b border-gray-300 dark:border-gray-700">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="{{asset($app->logo)}}" width="32" height="32" />
                        <p class="text-[22px] font-bold text-gray-900 dark:text-white ml-2">
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
                        <p class="font-bold text-gray-900 dark:text-white mb-6">
                            {{__('Nav List')}}
                        </p>
        
                        <ul class="flex flex-col gap-3">
                            <li>
                                <a href="#header">{{__('Home')}}</a>
                            </li>
                            <li>
                                <a href="#demos">{{__('Demos')}}</a>
                            </li>
                            <li>
                                <a href="#templates">{{__('Templates')}}</a>
                            </li>
                            <li>
                                <a href="#faqs">{{__('Faqs')}}</a>
                            </li>
                            <li>
                                <a href="#price-plan">{{__('Pricing')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-span-12 md:col-span-5">
                        <p class="font-bold text-gray-900 dark:text-white mb-6">
                            {{__('Company')}}
                        </p>
        
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
    </div>
</section>