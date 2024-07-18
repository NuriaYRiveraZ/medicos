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

    <div class="py-12">
            <div class="relative overflow-x-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
                    <div class="flex space-x-4">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="btn-custom focus:outline-none">
                            Registrar
                        </button>
                        <button data-modal-target="editar-servicio-modal" data-modal-toggle="editar-servicio-modal"class="btn-custom focus:outline-none">
                            Editar
                        </button>
                        <button data-modal-target="eliminar-servicio-modal" data-modal-toggle="eliminar-servicio-modal" class="btn-custom focus:outline-none">
                            Eliminar
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
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servicios as $servicio)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $servicio->nombre }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $servicio->precio }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Registrar Servicio
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
<!-- Modal body -->
<form method="POST" action="{{ route('servicios.store') }}" class="p-4 md:p-5">
    @csrf

    <!-- Nombre del Servicio -->
    <div>
        <x-input-label for="nombre" :value="__('Nombre del Servicio')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="nombre" />
        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    </div>

    <!-- Precio -->
    <div class="mt-4">
        <x-input-label for="precio" :value="__('Precio')" />
        <x-text-input id="precio" class="block mt-1 w-full" type="number" name="precio" :value="old('precio')" required />
        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit"  class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #203d4a; ">
            Registrar
        </button>
    </div>
</form>

        </div>
    </div>
</div> 


<!-- Modal para editar servicios -->
<div id="editar-servicio-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Servicio
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editar-servicio-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
<!-- Modal body -->
<form method="POST" id="edit-servicio-form" action="" class="p-4 md:p-5">
    @csrf
    @method('PATCH')

    <!-- Seleccionar Servicio -->
    <div>
        <x-input-label for="edit_id_servicio" :value="__('Seleccionar Servicio')" />
        <select id="edit_id_servicio" name="edit_id_servicio" class="block mt-1 w-full" onchange="updateEditServicioFields()">
            <option value="">Seleccione un servicio</option>
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id }}" data-nombre="{{ $servicio->nombre }}" data-precio="{{ $servicio->precio }}">{{ $servicio->nombre }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('edit_id_servicio')" class="mt-2" />
    </div>

    <!-- Nombre del Servicio -->
    <div class="mt-4">
        <x-input-label for="edit-nombre" :value="__('Nombre del Servicio')" />
        <x-text-input id="edit-nombre" class="block mt-1 w-full" type="text" name="nombre" required autofocus />
        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
    </div>

    <!-- Precio -->
    <div class="mt-4">
        <x-input-label for="edit-precio" :value="__('Precio')" />
        <x-text-input id="edit-precio" class="block mt-1 w-full" type="number" name="precio" required />
        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit"  class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #203d4a; ">
            Actualizar
        </button>
    </div>
</form>

        </div>
    </div>
</div>


<!-- Modal para eliminar servicios -->
<div id="eliminar-servicio-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Eliminar Servicio
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="eliminar-servicio-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" id="delete-servicio-form" action="" class="p-4 md:p-5">
                @csrf
                @method('DELETE')

                <!-- Seleccionar Servicio -->
                <div>
                    <x-input-label for="delete_servicio_id" :value="__('Seleccionar Servicio')" />
                    <select id="delete_servicio_id" name="servicio_id" class="block mt-1 w-full">
                        <option value="" disabled selected>Seleccione un servicio</option>
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('servicio_id')" class="mt-2" />
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
    document.getElementById('delete_servicio_id').addEventListener('change', function() {
        const form = document.getElementById('delete-servicio-form');
        form.action = "{{ url('/servicios') }}/" + this.value;
    });

    document.getElementById('edit_id_servicio').addEventListener('change', function() {
        const select = document.getElementById('edit_id_servicio');
        const selectedOption = select.options[select.selectedIndex];

        const nombre = selectedOption.getAttribute('data-nombre');
        const precio = selectedOption.getAttribute('data-precio');

        document.getElementById('edit-nombre').value = nombre ? nombre : '';
        document.getElementById('edit-precio').value = precio ? precio : '';
        
        const form = document.getElementById('edit-servicio-form');
        form.action = "{{ url('/servicios') }}/" + selectedOption.value;
    });

</script>

</x-app-layout>
