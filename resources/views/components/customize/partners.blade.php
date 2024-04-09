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

<section id="partners" class="px-6 py-16 bg-[#F0E9F6] dark:bg-gray-900">
    <div class="max-w-[1200px] w-full mx-auto">
        <div class="mb-12 max-w-[500px] mx-auto relative border border-dashed border-gray-500">
            @include('components.icons.edit-pen', 
                [ 'class'=>'w-8 h-8', 'dialog' => 'partnersSection']
            )

            <h3 class="font-bold text-2xl md:text-4xl text-center">
                {{$partners->title}}
            </h3>
            <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
                {{$partners->subtitle}}
            </p>
        </div>

        <div class="flex items-center flex-wrap justify-between gap-6">
            @foreach ($partners->child_sections as $partner)
                <div class="relative border border-dashed border-gray-500">
                    @include('components.icons.edit-pen', 
                        [ 'class'=>'w-6 h-6', 'dialog' => "partner$partner->id"]
                    )
                    
                    <img src="{{$partner->image}}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('components.customize.edit_section', 
    ['dialog' => 'partnersSection', 'section' => $partners]
)

@include('components.customize.edit_child_section', 
    [
        'dialog' => "partner".$partners->child_sections[0]->id, 
        'title' => "Partner Image ".$partners->child_sections[0]->id, 
        'section' => $partners->child_sections[0]
    ]
)
@include('components.customize.edit_child_section', 
    [
        'dialog' => "partner".$partners->child_sections[1]->id, 
        'title' => "Partner Image ".$partners->child_sections[1]->id, 
        'section' => $partners->child_sections[1]
    ]
)
@include('components.customize.edit_child_section', 
    [
        'dialog' => "partner".$partners->child_sections[2]->id, 
        'title' => "Partner Image ".$partners->child_sections[2]->id, 
        'section' => $partners->child_sections[2]
    ]
)
@include('components.customize.edit_child_section', 
    [
        'dialog' => "partner".$partners->child_sections[3]->id, 
        'title' => "Partner Image ".$partners->child_sections[3]->id, 
        'section' => $partners->child_sections[3]
    ]
)
@include('components.customize.edit_child_section', 
    [
        'dialog' => "partner".$partners->child_sections[4]->id, 
        'title' => "Partner Image ".$partners->child_sections[4]->id, 
        'section' => $partners->child_sections[4]
    ]
)
