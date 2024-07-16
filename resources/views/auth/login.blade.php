@extends('layouts.inicio')

@section('content')
<style>
.btn-custom {
    background-color: #203d4a;
    color: white;
    border: none;
    outline: none;
    cursor: pointer;
}

.btn-custom:hover {
    background-color: #1a3140; 
}
</style>
    <div class="font-sans text-gray-700">
        <div class="grid lg:grid-cols-2 md:grid-cols-2 items-center gap-4  px-6">
            <div class="order-1 lg:order-none">
                <img src="{{ asset('images/login.png') }}" class="w-full h-full object-cover" alt="login-image" />
            </div>
            <form method="POST" action="{{ route('login') }}" class="max-w-xl w-full p-6 mx-auto">
                @csrf
                <div class="mb-12">
                    <h3 class="text-4xl font-extrabold">Iniciar Sesión</h3>
                </div>
                <div>
                    <label class="text-sm block mb-2">Correo Electrónico</label>
                    <div class="relative flex items-center">
                        <input name="email" type="email" required class="w-full text-sm border-b border-gray-300 focus:border-[#333] px-2 py-3 outline-none" placeholder="Correo Electrónico" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-8">
                    <label class="text-sm block mb-2">Contraseña</label>
                    <div class="relative flex items-center">
                        <input name="password" type="password" required class="w-full text-sm border-b border-gray-300 focus:border-[#333] px-2 py-3 outline-none" placeholder="Contraseña" />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center justify-between gap-2 mt-5">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <label for="remember-me" class="ml-3 block text-sm">
                            Recuérdame
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="text-blue-600 text-sm hover:underline">
                            Olvidaste tú contraseña?
                        </a>
                    </div>
                </div>
                <div class="mt-12">
                <button type="submit" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded-full text-white btn-custom focus:outline-none">
                    Iniciar Sesión
                </button>
                </div>
            </form>
        </div>
    </div>
@endsection
