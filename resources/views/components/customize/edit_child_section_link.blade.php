@php
   $links = $section->section_links
@endphp

<div
   data-dialog-backdrop="{{$dialog}}"
   data-dialog-backdrop-close="true"
   class="hidden pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm p-4 text-gray-800"
>
   <div
      data-dialog="{{$dialog}}"
      class="relative min-w-[300px] max-w-[600px] w-full max-h-[calc(100vh-100px)] overflow-y-auto rounded-lg bg-white font-sans text-base leading-relaxed antialiased shadow-2xl font-medium p-4"
   >
      <div class="flex items-center justify-between mb-6">
         <p class="text-xl capitalize">Update Child Section Links</p>
         <span class=" text-4xl leading-none cursor-pointer" data-dialog-close="true">×</span>
      </div>
      
      <form method="POST" action="/inro-section/child/link/update">
         @csrf
         @method('PUT')

         @if (count($links) > 0 && $links[0])
            <div class="mb-4">
               <p class="mb-1">Second Link</p>
               <input hidden type="hidden" name="link_one_id" value="{{$links[0]->id}}">
               <div class="relative">
                  @include('components.input', [
                     'id' => '',
                     'type' => 'text',
                     'name' => 'link_text1',
                     'value' => $links[0]->link_text,
                     'label' => '',
                     'fullWidth' => true,
                     'required' => true,
                     'flexLabel' => false,
                     'disabled' => false,
                     'error' => false,
                     'className' => 'h-11 px-4 pl-[90px] rounded-bl-none rounded-br-none',
                     'placeholder' => 'Enter your link text',
                  ])
                  <div class="absolute left-0 top-0 pl-2 h-full w-20 bg-gray-300 rounded-tl flex items-center">
                     <span>{{__('Link Text')}}</span>
                  </div>
               </div>

               <div class="relative mt-1">
                  @include('components.input', [
                     'id' => '',
                     'type' => 'text',
                     'name' => 'link_url1',
                     'value' => $links[0]->link_url,
                     'label' => '',
                     'fullWidth' => true,
                     'required' => true,
                     'flexLabel' => false,
                     'disabled' => false,
                     'error' => false,
                     'className' => 'h-11 px-4 pl-[90px] rounded-tl-none rounded-tr-none',
                     'placeholder' => 'Enter your link url',
                  ])
                  <div class="absolute left-0 top-0 pl-2 h-full w-20 bg-gray-300 rounded-bl flex items-center">
                     <span>{{__('Link Url')}}</span>
                  </div>
               </div>
               
               @error('link_text1')
                  <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
               @enderror
               @error('link_url1')
                  <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
               @enderror
            </div>
         @endif

         @if (count($links) > 1 && $links[1])
            <div class="mb-4">
               <p class="mb-1">First Link</p>
               <input hidden type="hidden" name="link_two_id" value="{{$links[1]->id}}">
               <div class="relative">
                  @include('components.input', [
                     'id' => '',
                     'type' => 'text',
                     'name' => 'link_text2',
                     'value' => $links[1]->link_text,
                     'label' => '',
                     'fullWidth' => true,
                     'required' => true,
                     'flexLabel' => false,
                     'disabled' => false,
                     'error' => false,
                     'className' => 'h-11 px-4 pl-[90px] rounded-bl-none rounded-br-none',
                     'placeholder' => 'Enter your link text',
                  ])
                  <div class="absolute left-0 top-0 pl-2 h-full w-20 bg-gray-300 rounded-tl flex items-center">
                     <span>{{__('Link Text')}}</span>
                  </div>
               </div>

               <div class="relative mt-1">
                  @include('components.input', [
                     'id' => '',
                     'type' => 'text',
                     'name' => 'link_url2',
                     'value' => $links[1]->link_url,
                     'label' => '',
                     'fullWidth' => true,
                     'required' => true,
                     'flexLabel' => false,
                     'disabled' => false,
                     'error' => false,
                     'className' => 'h-11 px-4 pl-[90px] rounded-tl-none rounded-tr-none',
                     'placeholder' => 'Enter your link url',
                  ])
                  <div class="absolute left-0 top-0 pl-2 h-full w-20 bg-gray-300 rounded-bl flex items-center">
                     <span>{{__('Link Url')}}</span>
                  </div>
               </div>

               @error('link_text2')
                  <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
               @enderror
               @error('link_url2')
                  <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
               @enderror
            </div>
         @endif

         <div class="flex shrink-0 flex-wrap items-center justify-end">
            <button
               type="button"
               data-ripple-dark="true"
               data-dialog-close="true"
               class="middle none center mr-1 rounded-lg py-3 px-6 font-sans text-xs font-bold uppercase text-red-500 transition-all hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            >
               Cancel
            </button>
            <button
               type="submit"
               data-ripple-light="true"
               class="middle none center rounded-lg bg-gradient-to-tr from-primary-600 to-primary-400 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-primary-500/20 transition-all hover:shadow-lg hover:shadow-primary-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            >
               Save Changes
            </button>
         </div>
      </form>
   </div>
</div>