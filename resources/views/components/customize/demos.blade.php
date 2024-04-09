@php
    $child1 = $demo_content->child_sections[0];
    $child2 = $demo_content->child_sections[1];
    $child3 = $demo_content->child_sections[2];
@endphp
<section id="demos" class="max-w-[1200px] w-full mx-auto px-6 pt-5 pb-[140px] relative">
    <div class="hidden dark:block after:content-[''] after:absolute after:left-0 after:top-10 after:w-[265px] sm:after:w-[565px] after:h-[100px] sm:after:h-[147px] after:blur-[120px] sm:after:blur-[200px] after:rounded-full after:pointer-events-none after:bg-[#997AF1]"></div>

    <div class="hidden dark:block after:content-[''] after:absolute after:right-0 after:top-0 after:w-[265px] sm:after:w-[565px] after:h-[100px] sm:after:h-[147px] after:blur-[115px] sm:after:blur-[175px] after:rounded-full after:pointer-events-none after:bg-[#CB7AF1]"></div>

    <div class="relative z-10">
        <div class="max-w-[650px] mx-auto text-center relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', 
                [ 'class'=>'w-8 h-8', 'dialog' => 'demoSection']
            )

            <h3 class="font-bold text-2xl md:text-4xl">
                {{$demo_content->title}}
            </h3>
            <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base">
                {{$demo_content->subtitle}}
            </p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-14 md:gap-10 mt-[60px] mb-[140px] relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', [ 'class'=>'w-8 h-8', 'dialog' => 'demoChild1'])

            <div class="w-full md:max-w-[500px] mr-auto">
                <div class="flex items-center mb-10">
                    <div class="w-20 h-20 bg-primary-50 dark:bg-gray-800 rounded-lg overflow-hidden relative">
                        <div class="w-14 h-14 rounded-tl-lg bg-white dark:bg-gray-700 absolute right-0 bottom-0 p-3">
                            @include('components.icons.blog', ['class' => 'w-9 h-9 text-primary-500'])
                        </div>
                    </div>
                    <p class="text24 font-medium ml-6">{{$child1->title}}</p>
                </div>
               <h4 class="font-bold text-[22px] md:text-[32px] md:leading-[48px] mb-6">
                  {{$child1->subtitle}}
               </h4>
                <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base mb-10">
                    {{$child1->description}}
                </p>
                <div class="max-w-[200px] relative border border-dashed border-gray-500">
                    @include('components.icons.edit-pen', ['class'=>'w-6 h-6', 'dialog'=>'demoChildLink1'])
                    
                    <a 
                        href="{{$child1->section_links[0]->link_url}}" 
                        class="whitespace-nowrap w-[135px] block px-7 py-3 rounded-lg border text-sm font-bold border-primary-500 bg-primary-500  hover:bg-primary-600 text-white"
                    >
                        {{$child1->section_links[0]->link_text}}
                    </a>
                </div>
            </div>

            <img
                src="{{asset($child1->image)}}"
                class="w-full md:max-w-full relative z-[1] rounded-xl"
                alt=""
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-14 md:gap-10 mt-[60px] mb-[140px] relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', [ 'class'=>'w-8 h-8', 'dialog' => 'demoChild2'])

            <img 
                src="{{asset($child2->image)}}"
                class="w-full md:max-w-full relative z-[1] rounded-xl"
                alt=""
            />
         
            <div class="w-full md:max-w-[500px] ml-auto">
                <div class="flex items-center mb-10">
                    <div class="w-20 h-20 bg-primary-50 dark:bg-gray-800 rounded-lg overflow-hidden relative">
                        <div class="w-14 h-14 rounded-tl-lg bg-white dark:bg-gray-700 absolute right-0 bottom-0 p-3">
                            @include('components.icons.social-media', ['class' => 'w-9 h-9 text-primary-500'])
                        </div>
                    </div>
                    <p class="text24 font-medium ml-6">{{$child2->title}}</p>
                </div>
               <h4 class="font-bold text-[22px] md:text-[32px] md:leading-[48px] mb-6">
                  {{$child2->subtitle}}
               </h4>
                <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base mb-11">
                    {{$child2->description}}
                </p>
                <div class="max-w-[200px] relative border border-dashed border-gray-500">
                    @include('components.icons.edit-pen', ['class'=>'w-6 h-6', 'dialog'=>'demoChildLink2'])
                    
                    <a 
                        href="{{$child2->section_links[0]->link_url}}" 
                        class="whitespace-nowrap w-[135px] block px-7 py-3 rounded-lg border text-sm font-bold border-primary-500 bg-primary-500 hover:bg-primary-600 text-white"
                    >
                        {{$child2->section_links[0]->link_text}}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-14 md:gap-10 mt-[60px] relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', [ 'class'=>'w-8 h-8', 'dialog' => 'demoChild3'])

            <div class="w-full md:max-w-[500px] mr-auto">
                <div class="flex items-center mb-10">
                    <div class="w-20 h-20 bg-primary-50 dark:bg-gray-800 rounded-lg overflow-hidden relative">
                        <div class="w-14 h-14 rounded-tl-lg bg-white dark:bg-gray-700 absolute right-0 bottom-0 p-3">
                            @include('components.icons.blog', ['class' => 'w-9 h-9 text-primary-500'])
                        </div>
                    </div>
                    <p class="text24 font-medium ml-6">{{$child3->title}}</p>
                </div>
               <h4 class="font-bold text-[22px] md:text-[32px] md:leading-[48px] mb-6">
                  {{$child3->subtitle}}
               </h4>
                <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base mb-11">
                    {{$child3->description}}
                </p>
                <div class="max-w-[200px] relative border border-dashed border-gray-500">
                    @include('components.icons.edit-pen', ['class'=>'w-6 h-6', 'dialog'=>'demoChildLink3'])

                    <a 
                        href="{{$child3->section_links[0]->link_url}}" 
                        class="whitespace-nowrap w-[135px] block px-7 py-3 rounded-lg border text-sm font-bold border-primary-500 bg-primary-500 hover:bg-primary-600 text-white"
                    >
                        {{$child3->section_links[0]->link_text}}
                    </a>
                </div>
            </div>

            <img
                src="{{asset($child3->image)}}"
                class="w-full md:max-w-full relative z-[1] rounded-xl"
                alt=""
            />
        </div>
    </div>
</section>

@include('components.customize.edit_section', 
    ['dialog' => 'demoSection', 'section' => $demo_content]
)

@include('components.customize.edit_child_section', 
    [
        'dialog' => "demoChild1", 
        'title' => "$demo_content->title Section", 
        'section' => $child1
    ]
)
@include('components.customize.edit_child_section', 
    [
        'dialog' => "demoChild2", 
        'title' => "$demo_content->title Section", 
        'section' => $child2
    ]
)
@include('components.customize.edit_child_section', 
    [
        'dialog' => "demoChild3", 
        'title' => "$demo_content->title Section", 
        'section' => $child3
    ]
)

@include('components.customize.edit_child_section_link', 
    [
        'dialog' => "demoChildLink1", 
        'section' => $demo_content->child_sections[0]
    ]
)
@include('components.customize.edit_child_section_link', 
    [
        'dialog' => "demoChildLink2", 
        'section' => $demo_content->child_sections[1]
    ]
)
@include('components.customize.edit_child_section_link', 
    [
        'dialog' => "demoChildLink3", 
        'section' => $demo_content->child_sections[2]
    ]
)