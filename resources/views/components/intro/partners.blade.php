@php
    $partnersLight = [
        'assets/logo/stripe-light.png',
        'assets/logo/paddle-light.png',
        'assets/logo/razorpay-light.png',
        'assets/logo/openai-light.png',
        'assets/logo/laravel-light.png',
    ];
    $partnersDark = [
        'assets/logo/stripe-dark.png',
        'assets/logo/paddle-dark.png',
        'assets/logo/razorpay-dark.png',
        'assets/logo/openai-dark.png',
        'assets/logo/laravel-dark.png',
    ];
@endphp

<section id="partners" class="px-6 py-16 bg-[#F0E9F6] dark:bg-gray-900" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
    <div class="max-w-[1200px] w-full mx-auto">
        <div class="mb-12 max-w-[500px] mx-auto">
            <h3 class="font-bold text-2xl md:text-4xl text-center">
                {{$partners->title}}
            </h3>
            <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
                {{$partners->subtitle}}
            </p>
        </div>

        <div class="flex items-center flex-wrap justify-between gap-6">
            @foreach ($partners->child_sections as $partner)
                <img src="{{$partner->image}}" alt="">
            @endforeach
        </div>
    </div>
</section>