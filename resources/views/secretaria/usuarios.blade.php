<style>
    .btn-custom {
        background-color: #203d4a;
        color: white;
        border: none;
        outline: none;
        cursor: pointer;
        width: auto; 
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); 
        padding: 5px 10px; 
        font-size: 15px; 
        font-weight: 600; 
        border-radius: 10px; 
        text-align: center;
    }

    .btn-custom:hover {
        background-color: #1a3140; 
    }
</style>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>  
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empleados') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
            <div class="relative overflow-x-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
                    <div class="flex space-x-4">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="btn-custom focus:outline-none">
                            Registrar Empleado
                        </button>
                        <button data-modal-target="eliminar-usuario-modal" data-modal-toggle="eliminar-usuario-modal" class="btn-custom focus:outline-none">
                            Eliminar Empleado
                        </button>

                    </div>
                </div>
            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">                      <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre del Empleado
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Correo Electrónico
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tipo
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            @if($usuario->tipo == 'secretaria' || $usuario->tipo == 'doctor')
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $usuario->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $usuario->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $usuario->tipo }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Registrar Empleado
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form method="POST" action="{{ route('users.store') }}" class="p-4 md:p-5">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nombre completo')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Correo Electrónico -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Contraseña -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Tipo -->
                <div class="mt-4">
                    <x-input-label for="tipo" :value="__('Tipo')" />
                    <select id="tipo" name="tipo" class="block mt-1 w-full">
                        <option value="secretaria">Secretaria</option>
                        <option value="doctor">Doctor</option>
                    </select>
                    <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #203d4a; ">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para eliminar usuario -->
<div id="eliminar-usuario-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Eliminar Usuario
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="eliminar-usuario-modal">
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form method="POST" action="{{ route('users.destroy', ['id' => 0]) }}" class="p-4 md:p-5" id="delete-user-form">
                @csrf
                @method('DELETE')
                <div class="mt-4">
                    <x-input-label for="delete_user_id" :value="__('Nombre del Empleado')" />
                    <select id="delete_user_id" name="delete_user_id" class="block mt-1 w-full">
                        <option value="">Seleccione un empleado</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('delete_user_id')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('delete_user_id').addEventListener('change', function() {
        const form = document.getElementById('delete-user-form');
        form.action = "{{ url('/users') }}/" + this.value;
    });
</script>

<script>
    function updatePhoneNumber() {
        const select = document.getElementById('id_paciente_agenda');
        const selectedOption = select.options[select.selectedIndex];
        const telefono = selectedOption.getAttribute('data-telefono');
        document.getElementById('telefono').value = telefono ? telefono : '';
    }
</script>

</x-app-layout>
