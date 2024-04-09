@php
    $child_features = [
        [
            'title' => '', 
            'description' => '', 
            'icon' => 'startup',
            'modal' => 'featureChildStartup'
        ], 
        [
            'title' => '', 
            'description' => '', 
            'icon' => 'dashboard',
            'modal' => 'featureChildDashboard'
        ], 
        [
            'title' => '', 
            'description' => '',  
            'icon' => 'payment-gateway',
            'modal' => 'featureChildPayment'
        ], 
        [
            'title' => '', 
            'description' => '', 
            'icon' => 'support',
            'modal' => 'featureChildSupport'
        ], 
        [
            'title' => '', 
            'description' => '', 
            'icon' => 'text',
            'modal' => 'featureChildText'
        ], 
        [
            'title' => '', 
            'description' => '', 
            'icon' => 'speech',
            'modal' => 'featureChildSpeech'
        ], 
    ];

    $counter = 0;
    foreach ($features->child_sections as $child_section) {
        $child_features[$counter]['title'] = $child_section->title;
        $child_features[$counter]['description'] = $child_section->subtitle;
        $counter++;
    }
@endphp

<div class="py-[100px] mb-[140px]">
    <div class="max-w-[1200px] w-full mx-auto relative">
        <div class="hidden dark:block after:content-[''] after:absolute after:left-0 after:top-10 after:w-[140px] sm:after:w-[200px] after:h-[216px] sm:after:h-[316px] after:blur-[100px] sm:after:blur-[150px] after:rounded-full after:pointer-events-none after:bg-[#CB7AF1]"></div>

        <div class="hidden dark:block after:content-[''] after:absolute after:left-[24%] after:top-0 after:w-[225px] sm:after:w-[385px] after:h-[66px] sm:after:h-[116px] after:blur-[80px] sm:after:blur-[130px] after:rounded-full after:pointer-events-none after:bg-[#907AF1]"></div>
        <div 
            data-aos="fade-up" 
            data-aos-duration="1500"
            data-aos-anchor-placement="center-bottom" 
            class="max-w-[400px] w-full mx-auto mb-12"
        >
            <h3 class="font-bold text-2xl md:text-4xl text-center">
                {{$features->title}}
            </h3>
            <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
                {{$features->subtitle}}
            </p>
        </div>
         
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach ($child_features as $item)
                <div 
                    data-aos="fade-up" 
                    data-aos-duration="1500" 
                    data-aos-anchor-placement="center-bottom" 
                    class="relative z-10 py-9 px-4 text-center group hover:bg-primary-25 dark:hover:bg-gray-800 rounded-lg hover:scale-[1.02] transition-all duration-300 cursor-pointer hover:shadow-card"
                >
                    <div class="w-10 h-10 mx-auto rounded-md bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-700 dark:text-gray-400 group-hover:bg-primary-500 dark:group-hover:bg-primary-500 group-hover:text-white dark:group-hover:text-white transition-all duration-300">
                        @include('components.icons.'.$item['icon'], ['class' => 'w-6 h-6'])
                    </div>
                    <p class="text-lg text-gray-900 dark:text-white font-bold my-2">
                        {{$item['title']}}
                    </p>
                    <p class="text-gray-700 dark:text-white">
                        {{$item['description']}}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>