@php
    $templates_list = [
        ['title' => 'Blog Titles', 'icon' => 'blog'], 
        ['title' => 'Blog Ideas', 'icon' => 'blog-idea'], 
        ['title' => 'Blog Intros',  'icon' => 'blog-intro'], 
        ['title' => 'Blog Section', 'icon' => 'blog'], 
        ['title' => 'Blog Conclusion', 'icon' => 'conclusion'], 
        ['title' => 'Summarize Text', 'icon' => 'summarize-text'], 
        ['title' => 'Startup Name Idea', 'icon' => 'startup'], 
        ['title' => 'Testimonial or Reviews', 'icon' => 'review'], 
        ['title' => 'YouTube Tag Idea', 'icon' => 'youtube'], 
        ['title' => 'Video Titles', 'icon' => 'video'], 
        ['title' => 'Video Description', 'icon' => 'video'], 
        ['title' => 'Instagram Captions', 'icon' => 'instagram'], 
        ['title' => 'Instagram #tag Idea', 'icon' => 'hashtag'], 
        ['title' => 'Social Personal Post', 'icon' => 'social-media'], 
        ['title' => 'Social Business Post', 'icon' => 'social-media'], 
        ['title' => 'Facebook Captions', 'icon' => 'facebook'], 
        ['title' => 'Facebook Ads', 'icon' => 'facebook'], 
        ['title' => 'Google Ads Titles', 'icon' => 'google-ads'], 
        ['title' => 'Google Ads Details', 'icon' => 'google-ads-details'], 
        ['title' => 'Article Generator', 'icon' => 'article-generator'], 
        ['title' => 'Content Re-writer', 'icon' => 'content-re-writer'], 
        ['title' => 'Paragraph Generator', 'icon' => 'paragraph-generator'], 
        ['title' => 'Talking Points', 'icon' => 'talking-points'], 
        ['title' => 'Pros & Cons', 'icon' => 'pros-cons'], 
        ['title' => 'Product Name Idea', 'icon' => 'product-name'], 
        ['title' => 'Product Description',  'icon' => 'product-description'], 
        ['title' => 'Meta Description', 'icon' => 'meta-description'], 
        ['title' => 'FAQs', 'icon' => 'faqs'], 
        ['title' => 'FAQ Answers', 'icon' => 'faqs-answer'], 
        ['title' => 'Problem Agitate Solution', 'icon' => 'problem-agitate-solution']
    ];
@endphp

<section id="templates" class="max-w-[1200px] w-full mx-auto pt-5 pb-[140px] relative" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
    <div class="hidden dark:block after:content-[''] after:absolute after:left-[15%] after:top-10 after:w-[250px] sm:after:w-[400px] after:h-[64px] sm:after:h-[104px] after:blur-[80px] sm:after:blur-[125px] after:rounded-full after:pointer-events-none after:bg-[#997AF1]"></div>

    <div class="hidden dark:block after:content-[''] after:absolute after:right-[8%] after:top-0 after:w-[232px] sm:after:w-[432px] after:h-[66px] sm:after:h-[112px] after:blur-[100px] sm:after:blur-[145px] after:rounded-full after:pointer-events-none after:bg-[#CB7AF1]"></div>

    <div class="relative z-10">
        <div class="mb-12 max-w-[700px] mx-auto">
            <h3 class="max-w-[340px] mx-auto font-bold text-2xl md:text-4xl text-center">
                {{$templates->title}}
            </h3>
            <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
                {{$templates->subtitle}}
            </p>
        </div>
    
        <div class="marquee marquee-forward">
            <div class="slide">
                @foreach (array_slice($templates_list, 0, 10) as $item)
                <div class="content h-14 px-2">
                    <a href="/templates" class="flex items-center justify-center border border-gray-200 rounded-lg">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-4 h-4 text-primary-500'])
                        <p class="ml-2 font-medium">{{$item['title']}}</p>
                    </a>
                </div>
                @endforeach
            </div>
    
            <div class="slide">
                @foreach (array_slice($templates_list, 0, 10) as $item)
                <div class="content h-14 px-2">
                    <a href="/templates" class="flex items-center justify-center border border-gray-200 rounded-lg">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-4 h-4 text-primary-500'])
                        <p class="ml-2 font-medium">{{$item['title']}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    
        <div class="marquee marquee-reverse my-4">
            <div class="slide">
                @foreach (array_slice($templates_list, 10, 10) as $item)
                <div class="content h-14 px-2">
                    <a href="/templates" class="flex items-center justify-center border border-gray-200 rounded-lg">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-4 h-4 text-primary-500'])
                        <p class="ml-2 font-medium">{{$item['title']}}</p>
                    </a>
                </div>
                @endforeach
            </div>
    
            <div class="slide">
                @foreach (array_slice($templates_list, 10, 10) as $item)
                <div class="content h-14 px-2">
                    <a href="/templates" class="flex items-center justify-center border border-gray-200 rounded-lg">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-4 h-4 text-primary-500'])
                        <p class="ml-2 font-medium">{{$item['title']}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    
        <div class="marquee marquee-forward">
            <div class="slide">
                @foreach (array_slice($templates_list, 20, 10) as $item)
                <div class="content h-14 px-2">
                    <a href="/templates" class="flex items-center justify-center border border-gray-200 rounded-lg">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-4 h-4 text-primary-500'])
                        <p class="ml-2 font-medium">{{$item['title']}}</p>
                    </a>
                </div>
                @endforeach
            </div>
    
            <div class="slide">
                @foreach (array_slice($templates_list, 20, 10) as $item)
                <div class="content h-14 px-2">
                    <a href="/templates" class="flex items-center justify-center border border-gray-200 rounded-lg">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-4 h-4 text-primary-500'])
                        <p class="ml-2 font-medium">{{$item['title']}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
