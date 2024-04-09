<section id="footer" class="px-6 pt-[140px] relative overflow-hidden">
    <div class="hidden dark:block before:content-[''] before:absolute before:right-[56%] before:-bottom-[240px] before:z-10 before:w-[265px] sm:before:w-[565px] before:h-[90px] sm:before:h-[147px] before:blur-[115px] sm:before:blur-[175px] before:rounded-full before:pointer-events-none before:bg-[#997AF1]"></div>

    <div class="hidden dark:block before:content-[''] before:absolute before:left-[56%] before:bottom-0 before:z-10 before:w-[265px] sm:before:w-[565px] before:h-[90px] sm:before:h-[147px] before:blur-[115px] sm:before:blur-[175px] before:rounded-full before:pointer-events-none before:bg-[#CB7AF1]"></div>

    <div class="relative z-10 max-w-[1000px] w-full mx-auto mb-[140px] intro-footer-bg-dark px-6 py-10 text-center rounded-lg">
        <div class=" max-w-[700px] mx-auto relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', [ 'class'=>'w-8 h-8', 'dialog' => 'footerSection'])

            <h6 class="font-bold text-white">
                {{$banner->title}}
            </h6>
        </div>

        <div class="max-w-[400px] mx-auto flex items-center justify-center gap-4 mt-8 relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', ['class'=>'w-6 h-6', 'dialog'=>'bannerSectionLink'])
            
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

    <p class="text18 font-medium text-center mb-[75px]">
        {{$app->copyright}}
    </p>
</section>

@include('components.customize.edit_section', 
    ['dialog' => 'footerSection', 'section' => $banner]
)

@include('components.customize.edit_child_section_link', 
    ['dialog' => 'bannerSectionLink', 'section' => $banner->child_sections[0]]
)