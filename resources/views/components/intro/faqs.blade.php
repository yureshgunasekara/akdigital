<section id="faqs" class="max-w-[1200px] w-full mx-auto mb-[140px] relative px-6">
   <div
      data-aos="fade-up" 
      data-aos-duration="1500" 
      data-aos-anchor-placement="center-bottom" 
      class="mb-12 max-w-[460px] mx-auto"
   >
      <h3 class="max-w-[340px] mx-auto font-bold text-2xl md:text-4xl text-center">
         {{$faqs_content->title}}
      </h3>
      <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
         {{$faqs_content->subtitle}}
      </p>
   </div>

   <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center relative">
      <div 
         data-aos="fade-up" 
         data-aos-duration="1500" 
         data-aos-anchor-placement="center-bottom" 
         class="flex flex-col gap-6 relative"
         id="accordionExample" 
      >
         <div class="hidden dark:block before:content-[''] before:absolute before:right-1/2 before:top-1/2 before:w-[200px] sm:before:w-[329px] before:h-[134px] sm:before:h-[234px] before:blur-[120px] sm:before:blur-[180px] before:rounded-full before:pointer-events-none before:bg-[#997AF1] before:transform before:translate-x-1/2 before:-translate-y-1/2"></div>
         
         @foreach ($faqs_content->child_sections as $index => $faq)
            <div
               class="relative z-10 rounded-lg border dark:border-gray-700 bg-white dark:bg-gray-900"
            >
               <button
                  id="heading{{$faq->id}}"
                  data-te-collapse-init
                  data-te-target="#collapse{{$faq->id}}"
                  aria-expanded="{{$index == 0 ? 'true' : 'false'}}"
                  aria-controls="collapse{{$faq->id}}"
                  class="group relative flex w-full items-center text18 font-medium p-6"
               >
                  {{$faq->title}}
                  <span
                     class="ml-auto h-5 w-5 shrink-0 rotate-[-180deg] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:rotate-0"
                  >
                     @include('components.icons.down-arrow', ['class' => 'w-4 h-4 text-gray-700 dark:text-white'])
                  </span>
               </button>
               <div
                  id="collapse{{$faq->id}}"
                  class="{{$index == 0 ? '!visible' : 'hidden'}}"
                  data-te-collapse-item
                  @if($index == 0) data-te-collapse-show @endif
                  aria-labelledby="heading{{$faq->id}}"
                  data-te-parent="#accordionExample"
               >
                  <p class="px-6 pb-6 pt-1 text-gray-700 dark:text-white">
                     {{$faq->description}}
                  </p>
               </div>
            </div>
         @endforeach
      </div>

      <div 
         data-aos="fade-up" 
         data-aos-duration="1500" 
         data-aos-anchor-placement="center-bottom" 
         class="relative"
      >
         <div class="before:content-[''] before:absolute before:left-0 before:top-1/2 before:z-10 before:w-[124px] sm:before:w-[184px] before:h-[102] sm:before:h-[152px] before:blur-[75px] sm:before:blur-[115px] before:rounded-full before:pointer-events-none before:bg-[#C8BAFC] before:transform before:-translate-y-1/2"></div>

         <div class="after:content-[''] after:absolute after:right-10 after:top-10 after:z-10 after:w-[140px] sm:after:w-[211px] after:h-[138px] sm:after:h-[238px] after:blur-[75px] sm:after:blur-[115px] after:rounded-full after:pointer-events-none after:bg-[#9DF7C2]"></div>

         <div class="after:content-[''] after:absolute after:right-[140px] after:-bottom-10 after:z-10 after:w-[124px] sm:after:w-[184px] after:h-[113px] sm:after:h-[153px] after:blur-[75px] sm:after:blur-[115px] after:rounded-full after:pointer-events-none after:bg-[#FFEBB3]"></div>

         <img class="relative z-10" src="{{asset($faqs_content->asset)}}" alt="">
      </div>
   </div>
</section>
