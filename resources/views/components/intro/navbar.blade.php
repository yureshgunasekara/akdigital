<nav id="navbar" class="block py-6 w-full max-w-full transition-all sticky top-0 z-40 px-6">
  <div class="max-w-[1200px] w-full h-10 mx-auto flex items-center justify-between">
    <div class="flex items-center">
      <img src="{{asset($app->logo)}}" width="32" height="32" />
      <p class="text-lg font-bold text-gray-900 dark:text-white ml-2">
        {{$app->name}}
      </p>
    </div>

    <div data-te-collapse-item>
      <ul 
        data-te-navbar-nav-ref
        class="mr-auto flex flex-row items-center gap-9 text-gray-700 dark:text-white font-medium" 
      >
        <li class="hidden lg:block" data-te-nav-item-ref>
          <a class="" href="#header">{{__('Home')}}</a>
        </li>
        <li class="hidden lg:block" data-te-nav-item-ref>
          <a class="" href="#demos">{{__('Demos')}}</a>
        </li>
        <li class="hidden lg:block" data-te-nav-item-ref>
          <a class="" href="#templates">{{__('Templates')}}</a>
        </li>
        <li class="hidden lg:block" data-te-nav-item-ref>
          <a class="" href="#faqs">{{__('Faqs')}}</a>
        </li>
        <li class="hidden lg:block" data-te-nav-item-ref>
          <a class="" href="#price-plan">{{__('Pricing')}}</a>
        </li>
        <li class="flex items-center justify-center" data-te-nav-item-ref>
          <button class="lightOrDarkMode">
            @include('components.icons.dark', ['class' => 'w-5 h-5 block dark:hidden text-gray-900 dark:text-white'])
            @include('components.icons.light', ['class' => 'w-5 h-5 hidden dark:block text-gray-900 dark:text-white'])
          </button>
        </li>
        
        <li class="hidden lg:block" data-te-nav-item-ref>
          @if (auth()->user())
            @if (auth()->user()->role == 'admin')
              <a href="/customize" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500 mr-2">
                {{__('Customize Page')}}
              </a>
            @endif
            <a href="/dashboard" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500">
              {{__('Dashboard')}}
            </a>
          @else
            <div class="flex items-center gap-5">
              <a href="/register" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500">
                {{__('Register')}}
              </a>
              <a href="/login" class="px-5 py-2 rounded-lg border border-primary-500 text-sm bg-primary-500  hover:bg-primary-600 text-white">
                {{__('Login')}}
              </a>
            </div>
          @endif
        </li>

        <li class="static block lg:hidden" data-te-nav-item-ref data-te-dropdown-ref>
          <button 
            data-te-ripple-init
            data-te-nav-link-ref
            data-te-dropdown-toggle-ref
            aria-expanded="false"
            id="dropdownMenuButton"
            data-te-ripple-color="light"
            class="p-1 hover:bg-primary-25 dark:bg-gray-100 rounded-md" 
          >
            @include('components.icons.menu', ['class' => 'w-6 h-6 text-gray-900 dark:text-white'])
          </button>
          
          <div
            data-te-dropdown-menu-ref
            aria-labelledby="dropdownMenuButton"
            class="absolute left-0 top-full right-0 z-[1000] mt-0 hidden w-full border-none bg-white dark:bg-gray-900 !transition-all [&[data-te-dropdown-show]]:block"
          >
            <div class="p-6 pt-10">
              <ul class="flex flex-col gap-6 text-gray-700 dark:text-white font-medium">
                <li>
                  <a class="" href="#header">{{__('Home')}}</a>
                </li>
                <li>
                  <a class="" href="#demos">{{__('Demos')}}</a>
                </li>
                <li>
                  <a class="" href="#templates">{{__('Templates')}}</a>
                </li>
                <li>
                  <a class="" href="#faqs">{{__('Faqs')}}</a>
                </li>
                <li>
                  <a class="" href="#price-plan">{{__('Pricing')}}</a>
                </li>
                <li class="flex items-center gap-5">
                  @if (auth()->user())
                    @if (auth()->user()->role == 'admin')
                      <a href="/customize" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500 mr-2">
                        {{__('Customize Page')}}
                      </a>
                    @endif
                    <a href="/dashboard" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500">
                      {{__('Dashboard')}}
                    </a>
                  @else
                    <div class="flex items-center gap-5">
                      <a href="/register" class="px-5 py-2 rounded-lg border text-sm border-primary-500 hover:bg-primary-25 text-primary-500">
                        {{__('Register')}}
                      </a>
                      <a href="/login" class="px-5 py-2 rounded-lg border border-primary-500 text-sm bg-primary-500  hover:bg-primary-600 text-white">
                        {{__('Login')}}
                      </a>
                    </div>
                  @endif
                </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
