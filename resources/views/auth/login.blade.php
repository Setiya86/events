@extends('layouts.app')

@section('title', 'Login Admin')
@section('bodyClass', 'bg-gray-100 flex flex-col justify-center sm:py-12 min-h-screen')

@section('content')
<div class="relative py-3 sm:max-w-xl sm:mx-auto w-full">
    <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-sky-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>

    <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
        <div class="max-w-md mx-auto">
            <div>
                <h1 class="text-2xl font-semibold">Login Admin</h1>
            </div>

            @if($errors->any())
                <div class="bg-red-100 text-red-600 p-2 mb-4 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="divide-y divide-gray-200">
                @csrf
                <div class="py-8 space-y-6 text-gray-700">
                    <div class="relative">
                        <input autocomplete="off" id="email" name="email" type="email"
                               class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 
                               focus:outline-none focus:border-cyan-500"
                               placeholder="Email address" required/>
                        <label for="email"
                               class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base 
                               peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 
                               transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                            Email Address
                        </label>
                    </div>

                    <div class="relative">
                        <input autocomplete="off" id="password" name="password" type="password"
                               class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 
                               focus:outline-none focus:border-cyan-500"
                               placeholder="Password" required/>
                        <label for="password"
                               class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base 
                               peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 
                               transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">
                            Password
                        </label>
                    </div>

                    <div class="relative">
                        <button class="w-full bg-cyan-500 text-white rounded-md px-4 py-2 hover:bg-cyan-600 transition">
                            Login
                        </button>
                    </div>
                </div>
            </form>

            <div class="w-full flex justify-center mt-4">
                <button type="button"
                        class="flex items-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 
                        text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 
                        focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 0 48 48">
                        <g fill="none" fill-rule="evenodd">
                            <path d="M9.827 24c0-1.524.253-2.985.705-4.356L2.623 13.604A23.9 23.9 0 0 0 .214 24c0 3.737.868 7.262 2.407 10.388l7.905-6.051A14.2 14.2 0 0 1 9.827 24" fill="#FBBC05"/>
                            <path d="M23.714 10.133c3.311 0 6.302 1.173 8.652 3.093L39.202 6.4C35.036 2.773 29.695.533 23.714.533c-9.287 0-17.269 5.31-21.091 13.071l7.905 6.04c1.822-5.531 6.997-9.511 13.186-9.511" fill="#EB4335"/>
                            <path d="M23.714 37.867c-6.165 0-11.36-3.979-13.182-9.511l-7.905 6.038c3.822 7.762 11.804 13.073 21.091 13.073 5.732 0 10.604-1.77 14.093-5.849l-7.507-5.804c-2.118 1.334-4.785 2.052-7.59 2.052" fill="#34A853"/>
                            <path d="M46.145 24c0-1.387-.213-2.88-.534-4.267H23.714v9.067h12.604c-.63 3.091-2.345 5.468-4.8 7.015l7.507 5.804C43.339 37.614 46.145 31.649 46.145 24" fill="#4285F4"/>
                        </g>
                    </svg>
                    <span>Continue with Google</span>
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
