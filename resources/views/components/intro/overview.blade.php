@php
    $features = [
        $ai_template,
        $ai_image,
        $ai_code,
        $ai_chatbot,
        $speech_to_text,
        $text_to_speech,
    ];
@endphp

<div class="max-w-[1200px] w-full mx-auto rounded-xl border border-gray-100 dark:border-gray-800 mb-[140px]">
    <div class="relative p-4 md:p-7">
        <ul
            role="list"
            data-tabs="tabs"
            data-aos="fade-up" 
            data-aos-duration="1500" 
            data-aos-anchor-placement="center-bottom" 
            class="relative flex list-none rounded-xl bg-gray-50 dark:bg-gray-900 px-4 py-3 md:px-7 md:py-5 overflow-x-auto"
        >
            @foreach ($features as $index => $item)
                <li class="z-30 flex-auto text-center">
                    <a
                        role="tab"
                        data-tab-target=""
                        aria-controls="{{$item->type}}"
                        aria-selected="{{$index == 0 ? 'true' : 'false'}}"
                        class="overview-tab text-gray-600 dark:text-gray-400 text-sm z-30 mb-0 flex w-full cursor-pointer items-center justify-center rounded-lg border-0 bg-inherit px-5 py-3.5 transition-all ease-in-out capitalize  whitespace-nowrap"
                    >
                        {{strtolower($item->title)}}
                    </a>
                </li>
            @endforeach
        </ul>
        <div data-tab-content="" class="pt-4 md:pt-7">
            @foreach ($features as $index => $item)
                <div 
                    role="tabpanel"
                    id="{{$item->type}}" 
                    class="grid grid-cols-1 lg:grid-cols-2 gap-7 {{$index == 0 ? 'block opacity-100' : 'hidden opacity-0'}}" 
                >
                    <div 
                        data-aos="fade-up" 
                        data-aos-duration="1500" 
                        data-aos-anchor-placement="center-bottom" 
                        class="shadow-card p-7 dark:outline dark:outline-1 dark:outline-gray-800 rounded-xl"
                    >
                        <p class="text-primary-500 font-medium uppercase">
                            {{$item->title}}
                        </p>
                        <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl md:leading-[62px] font-bold my-5">
                            {{$item->subtitle}}
                        </h1>
                        <p class="text-gray-700 dark:text-white leading-[27px]">
                            {{$item->description}}
                        </p>
                    </div>

                    <div 
                        data-aos="fade-up" 
                        data-aos-duration="1500" 
                        data-aos-anchor-placement="center-bottom" 
                        class="shadow-card p-7 dark:outline dark:outline-1 dark:outline-gray-800 rounded-xl text-center"
                    >
                        <img src="{{$item->child_sections[0]->image}}" alt="">
                        <p class="text-lg text-gray-700 dark:text-white font-bold mt-4">
                            {{$item->child_sections[0]->title}}
                        </p>
                        <p class="text-gray-400 dark:text-white">
                            {{$item->child_sections[0]->subtitle}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
 </div>