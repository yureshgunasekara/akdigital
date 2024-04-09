@extends('layouts.auth')

@section('content')
    <div class="bg-white shadow-card max-w-[1000px] w-full flex flex-col lg:flex-row">
        <div class="bg-primary-500 w-full lg:max-w-[454px] flex items-center justify-center py-10 px-6">
            <img src="{{asset('assets/svg/ai-auth.svg')}}"  alt="">
        </div>

        <div class="w-full px-7 md:px-[64px] py-[112px]">
            <h5 class="text22 md:text-[32px] text-gray-900 font-bold mb-6">
                {{ __('Welcome to ') }}{{$app->name}}
            </h5>
            <div class="flex items-center justify-between gap-3">
                @if($googleLoginAllow)
                    <a 
                        href="/auth/google" 
                        class="px-3 py-2.5 border border-gray-200 rounded-lg flex items-center justify-center w-full"
                    >
                        <img 
                            width="20" 
                            height="20" 
                            class="mr-2" 
                            src="{{asset('assets/svg/google.svg')}}" 
                            alt=""
                        >
                        <small class="whitespace-nowrap font-medium text-gray-900 flex">
                            <span>{{ __('Sign In') }}</span>
                            <span class="ml-1 hidden md:block">
                                {{ __('with Google') }}
                            </span>
                        </small>
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-between py-7">
                <div class="max-w-[144px] w-full border-t border-gray-200"></div>
                <small class=" whitespace-nowrap text-gray-500 font-medium">{{ __('Or Sign Up With') }}</small>
                <div class="max-w-[144px] w-full border-t border-gray-200"></div>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
    
                <div>
                    @include('components.input', [
                        'id' => '',
                        'type' => 'text',
                        'name' => 'name',
                        'value' => old('name'),
                        'label' => '',
                        'fullWidth' => true,
                        'required' => true,
                        'flexLabel' => false,
                        'disabled' => false,
                        'error' => $errors->first('name'),
                        'className' => 'h-12 px-6',
                        'placeholder' => 'Enter full name',
                    ])
                </div>

                <div class="mt-6">
                    @include('components.input', [
                        'id' => '',
                        'type' => 'email',
                        'name' => 'email',
                        'value' => old('email'),
                        'label' => '',
                        'fullWidth' => true,
                        'required' => true,
                        'flexLabel' => false,
                        'disabled' => false,
                        'error' => $errors->first('email'),
                        'className' => 'h-12 px-6',
                        'placeholder' => 'Enter your email',
                    ])
                </div>

                <div class="mt-6">
                    @include('components.input', [
                        'id' => '',
                        'type' => 'password',
                        'name' => 'password',
                        'value' => '',
                        'label' => '',
                        'fullWidth' => true,
                        'required' => true,
                        'flexLabel' => false,
                        'disabled' => false,
                        'error' => $errors->first('password'),
                        'className' => 'h-12 px-6',
                        'placeholder' => 'Enter your password',
                    ])
                </div>

                <div class="mt-6">
                    @include('components.input', [
                        'id' => '',
                        'type' => 'password',
                        'name' => 'password_confirmation',
                        'value' => '',
                        'label' => '',
                        'fullWidth' => true,
                        'required' => true,
                        'flexLabel' => false,
                        'disabled' => false,
                        'error' => '',
                        'className' => 'h-12 px-6',
                        'placeholder' => 'Enter confirm password',
                    ])
                </div>
    
                <button 
                    type="submit" 
                    class="bg-primary-500 hover:bg-primary-500 active:bg-primary-500 font-medium capitalize rounded-md text14 text-white px-4 h-12 w-full mt-7"
                >
                    {{ __('Sign Up') }}
                </button>
                <p class="font-medium text-gray-500 mt-4">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login') }}" class="text-primary-500">
                        {{ __('Sign In') }}
                    </a>
                </p>
            </form>
        </div>
    </div>

    <script>
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const superAdmin = document.getElementById('superAdmin');

        superAdmin.addEventListener('click', () => {
            email.value = 'superadmin@gmail.com';
            password.value = 'superadmin';
        });
    </script>
@endsection
