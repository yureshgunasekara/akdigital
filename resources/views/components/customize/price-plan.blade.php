<section id="price-plan" class="mb-[140px] px-6">
   <div class="max-w-[1200px] w-full mx-auto">
      <div class="mb-12 max-w-[700px] mx-auto relative border border-dashed border-gray-500"
      >
         @include('components.icons.edit-pen', [ 'class'=>'w-8 h-8', 'dialog' => 'pricingSection'])

         <h3 class="max-w-[340px] mx-auto font-bold text-2xl md:text-4xl text-center">
            {{$pricing->title}}
         </h3>
         <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
            {{$pricing->subtitle}}
         </p>
      </div>

      <!--Tabs navigation-->
      <ul
         role="tablist"
         data-te-nav-ref
         class="relative z-10 mb-6 w-36 mx-auto flex justify-between list-none bg-gray-100 dark:bg-gray-800 rounded-full p-1.5 pb-2"
      >
         <li>
            <a
               role="tab"
               data-te-nav-active
               href="#tabs-home"
               data-te-toggle="pill"
               aria-controls="tabs-home"
               data-te-target="#tabs-home"
               class="text-xs my-2 px-3 py-1.5 font-medium rounded-full text-gray-500 hover:!text-white bg-white hover:!bg-primary-500 data-[te-nav-active]:bg-primary-500 data-[te-nav-active]:!text-white  dark:bg-gray-700 dark:text-gray-300 dark:data-[te-nav-active]:bg-primary-500 dark:data-[te-nav-active]:!text-white"
            >
               Monthly
            </a>
         </li>
         <li>
            <a
               role="tab"
               href="#tabs-profile"
               data-te-toggle="pill"
               aria-controls="tabs-profile"
               data-te-target="#tabs-profile"
               class="text-xs my-2 px-3 py-1.5 font-medium rounded-full text-gray-500 hover:!text-white bg-white hover:!bg-primary-500 data-[te-nav-active]:bg-primary-500 data-[te-nav-active]:!text-white  dark:bg-gray-700 dark:text-gray-300 dark:data-[te-nav-active]:bg-primary-500 dark:data-[te-nav-active]:!text-white"
            >
               Yearly
            </a>
         </li>
      </ul>

      <!--Tabs content-->
      <div class="mb-6">
         <div
            class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
            id="tabs-home"
            role="tabpanel"
            aria-labelledby="tabs-home-tab"
            data-te-tab-active
         >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
               @foreach ($plans as $item)
                  @php
                     $chatLimit = '';
                     if ($item['access_chat_bot'] == "Standard") {
                        $chatLimit = ' (Include Free)';
                     } elseif ($item['access_chat_bot'] == "Premium") {
                        $chatLimit = ' (Include Free + Standard)';
                     }

                     $templateLimit = '';
                     if ($item['access_template'] == "Standard") {
                        $templateLimit = ' (Include Free)';
                     } elseif ($item['access_template'] == "Premium") {
                        $templateLimit = ' (Include Free + Standard)';
                     }

                     $features = [
                        "Code Generation " . $item['code_generation'] . " (Per day)",
                        "Image Generation " . $item['image_generation'] . " (Per day)",
                        "Speech To Text Generation " . $item['speech_to_text_generation'] . " (Per day)",
                        "Speech Duration " . $item['speech_duration'] . " Minutes",
                        "Text To Speech Generation " . $item['text_to_speech_generation'] . " (Per day)",
                        "Text Character Length " . $item['text_character_length'],
                        "Template Prompt Generation " . $item['prompt_generation'] . " (Per day)",
                        "Support Request Sent " . $item['support_request'] . " (Per day)",
                        "Max Token Limit " . $item['content_token_length'],
                        "Access Chat Bot " . $item['access_chat_bot'] . $chatLimit,
                        "Access Template " . $item['access_template'] . $templateLimit,
                     ];
                  @endphp
                  <div class="group relative p-7 rounded-lg bg-gray-100 dark:bg-gray-900 hover:outline hover:outline-3 hover:outline-primary-500 hover:bg-white">
                     <h6 class="font-bold">
                        {{$item->name}}
                     </h6>
                     <small class="text-gray-700 dark:text-white mt-1">
                        For individual designer and developer.
                     </small>
      
                     <p class="font-medium text-gray-700 dark:text-gray-300 my-8">
                        <span class="text-[40px] font-bold text-gray-900 dark:text-white">
                           {{$item->monthly_price}}
                        </span>
                        {{$item->currency}} {{__('Monthly')}}
                     </p>
      
                     <a href="{{route("plans.selected", $item['id'])}}">
                        <button
                           class="capitalize font-bold h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500 px-7 py-3 rounded-lg border text-sm border-gray-900 dark:border-white hover:bg-primary-25 dark:hover:bg-gray-800"
                        >
                           Update Plan
                        </button>
                     </a>
      
                     @foreach ($features as $item)
                        <div class="flex items-center text-gray-700 dark:text-white mb-4 last:mb-0">
                           @include('components.icons.check-outline', ['class' => 'w-4 h-4 mr-2'])
                           <small>{{$item}}</small>
                        </div>
                     @endforeach
                  </div>
               @endforeach
            </div>
         </div>
         <div
            class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
            id="tabs-profile"
            role="tabpanel"
            aria-labelledby="tabs-profile-tab"
         >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
               @foreach ($plans as $item)
                  @php
                     $chatLimit = '';
                     if ($item['access_chat_bot'] == "Standard") {
                        $chatLimit = ' (Include Free)';
                     } else if ($item['access_chat_bot'] == "Premium") {
                        $chatLimit = ' (Include Free + Standard)';
                     }

                     $templateLimit = '';
                     if ($item['access_template'] == "Standard") {
                        $templateLimit = ' (Include Free)';
                     } else if ($item['access_template'] == "Premium") {
                        $templateLimit = ' (Include Free + Standard)';
                     }

                     $features = [
                        "Code Generation " . $item['code_generation'] . " (Per day)",
                        "Image Generation " . $item['image_generation'] . " (Per day)",
                        "Speech To Text Generation " . $item['speech_to_text_generation'] . " (Per day)",
                        "Speech Duration " . $item['speech_duration'] . " Minutes",
                        "Text To Speech Generation " . $item['text_to_speech_generation'] . " (Per day)",
                        "Text Character Length " . $item['text_character_length'],
                        "Template Prompt Generation " . $item['prompt_generation'] . " (Per day)",
                        "Support Request Sent " . $item['support_request'] . " (Per day)",
                        "Max Token Limit " . $item['content_token_length'],
                        "Access Chat Bot " . $item['access_chat_bot'] . $chatLimit,
                        "Access Template " . $item['access_template'] . $templateLimit,
                     ];
                  @endphp
                  <div class="group relative p-7 rounded-lg bg-gray-100 dark:bg-gray-900 hover:outline hover:outline-3 hover:outline-primary-500 hover:bg-white">
                     <h6 class="font-bold">
                        {{$item->name}}
                     </h6>
                     <small class="text-gray-700 dark:text-white mt-1">
                        For individual designer and developer.
                     </small>
      
                     <p class="font-medium text-gray-700 dark:text-gray-300 my-8">
                        <span class="text-[40px] font-bold text-gray-900 dark:text-white">
                           {{$item->yearly_price}}
                        </span>
                        {{$item->currency}} {{__('Yearly')}}
                     </p>
      
                     <a href="{{route("plans.selected", $item['id'])}}">
                        <button
                           class="capitalize font-bold h-[46px] mb-10 w-full group-hover:border-primary-500 group-hover:text-primary-500 px-7 py-3 rounded-lg border text-sm border-gray-900 dark:border-white hover:bg-primary-25 dark:hover:bg-gray-800"
                        >
                           Update Plan
                        </button>
                     </a>
      
                     @foreach ($features as $item)
                        <div class="flex items-center text-gray-700 dark:text-white mb-4 last:mb-0">
                           @include('components.icons.check-outline', ['class' => 'w-4 h-4 mr-2'])
                           <small>{{$item}}</small>
                        </div>
                     @endforeach
                  </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</section>

@include('components.customize.edit_section', 
    ['dialog' => 'pricingSection', 'section' => $pricing]
)