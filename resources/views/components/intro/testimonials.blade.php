<section id="testimonials" class="mb-[140px]">
   <div class="max-w-[1248px] w-full mx-auto overflow-x-hidden">
      <div 
         data-aos="fade-up" 
         data-aos-duration="1500" 
         data-aos-anchor-placement="center-bottom"
         class="mb-12 max-w-[400px] mx-auto"
      >
         <h3 class="font-bold text-2xl md:text-4xl text-center">
            {{$testimonial_content->title}}
         </h3>
         <p class="text-gray-700 dark:text-white mt-4 text-sm lg:text-base text-center">
            {{$testimonial_content->subtitle}}
         </p>
      </div>

      <div class="swiper-container px-5">
         <div class="swiper-wrapper pb-12 pt-[60px]">
            @foreach ($testimonials as $item)
               <div class="swiper-slide shadow-card relative p-6 mt-10 !h-[254px] rounded-lg border border-gray-100">
                  <img 
                     src="{{asset($item->image)}}" 
                     class="w-20 h-[90px] object-cover absolute -top-10 right-6 rounded-lg border border-white"
                     alt=""
                  >
                  <p class="text18 font-medium mb-1.5">{{$item->name}}</p>
                  <small class="text-gray-500  dark:text-gray-300">{{$item->designation}}</small>
                  <div class="flex items-center mt-4 mb-7">
                     <div class="flex items-center gap-1">
                        @include('components.icons.star', ['class' => 'w-4 h-4 text-warning-500'])
                        @include('components.icons.star', ['class' => 'w-4 h-4 text-warning-500'])
                        @include('components.icons.star', ['class' => 'w-4 h-4 text-warning-500'])
                        @include('components.icons.star', ['class' => 'w-4 h-4 text-warning-500'])
                        @include('components.icons.star', ['class' => 'w-4 h-4 text-warning-500'])
                     </div>
                     <small class="text-gray-500 dark:text-gray-300 ml-1">{{$item->rating}}</small>
                  </div>
                  <p class="text-gray-500 dark:text-white">
                     {{$item->comment}}
                  </p>
               </div>
            @endforeach
         </div>
         <div class="swiper-pagination" style="position: initial !important"></div>
      </div>
   </div>
</section>
