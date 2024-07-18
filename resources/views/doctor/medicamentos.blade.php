<!-- CSS for custom button style -->
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
            {{ __('Medicamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="relative overflow-x-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
                        <div class="flex space-x-4">
                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="btn-custom focus:outline-none">
                                Agregar
                            </button>
                            <button data-modal-target="editar-medicamento-modal" data-modal-toggle="editar-medicamento-modal" class="btn-custom focus:outline-none">
                                Editar
                            </button>
                            <button data-modal-target="eliminar-medicamento-modal" data-modal-toggle="eliminar-medicamento-modal" class="btn-custom focus:outline-none">
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
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nombre</th>
                                    <th scope="col" class="px-6 py-3">Tipo</th>
                                    <th scope="col" class="px-6 py-3">Cantidad</th>
                                    <th scope="col" class="px-6 py-3">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicamentos as $medicamento)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-left">
                                            {{ $medicamento->nombre }}
                                        </td>
                                        <td class="px-6 py-4 text-left">
                                            {{ $medicamento->tipo }}
                                        </td>
                                        <td class="px-6 py-4 text-left">
                                            {{ $medicamento->cantidad }} unidades
                                        </td>
                                        <td class="px-6 py-4 text-left">
                                            ${{ $medicamento->precio }} precio unitario
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Agregar Medicamento Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agregar Medicamento
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="agregar-form" class="p-4 md:p-5" enctype="multipart/form-data" action="{{ route('medicamentos.store') }}" method="POST">
                    @csrf
                    <div class="mt-4">
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="tipo" :value="__('Tipo')" />
                        <select id="tipo" name="tipo" class="block mt-1 w-full" required>
                            <option value="Medicamento">Medicamento</option>
                        </select>
                        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="cantidad" :value="__('Cantidad')" />
                        <x-text-input id="cantidad" class="block mt-1 w-full" type="number" name="cantidad" required />
                        <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="precio" :value="__('Precio')" />
                        <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" required />
                        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #203d4a;">
                            {{ __('Agregar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Editar Medicamento Modal -->
<div id="editar-medicamento-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Medicamento
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editar-medicamento-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <form id="editar-medicamento-form" class="p-4 md:p-5" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="edit-medicamento-id">
                <div class="mb-4">
                    <label for="select-medicamento" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Seleccionar Medicamento</label>
                    <select id="select-medicamento" name="medicamento" class="block w-full mt-1 text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <option value="" disabled selected>Seleccionar Medicamento</option>
                        @foreach ($medicamentos as $medicamento)
                            <option value="{{ $medicamento->id }}">{{ $medicamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label for="edit-medicamento-nombre" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Nombre</label>
                    <input id="edit-medicamento-nombre" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="text" name="nombre" required>
                </div>
                <div class="mt-4">
                    <label for="edit-medicamento-tipo" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Tipo</label>
                    <select id="edit-medicamento-tipo" name="tipo" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                        <option value="Medicamento">Medicamento</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="edit-medicamento-cantidad" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Cantidad</label>
                    <input id="edit-medicamento-cantidad" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="number" name="cantidad" required>
                </div>
                <div class="mt-4">
                    <label for="edit-medicamento-precio" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Precio</label>
                    <input id="edit-medicamento-precio" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="text" name="precio" required>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #203d4a;">
                        {{ __('Actualizar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Modal para eliminar medicamentos -->
    <div id="eliminar-medicamento-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Eliminar Medicamento
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="eliminar-medicamento-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('medicamentos.destroy', ['id' => 0]) }}" class="p-4 md:p-5" id="delete-medicamento-form">
                    @csrf
                    @method('DELETE')
                    <div class="mt-4">
                        <x-input-label for="delete_medicamento_id" :value="__('Nombre del Medicamento')" />
                        <select id="delete_medicamento_id" name="delete_medicamento_id" class="block mt-1 w-full">
                            <option value="">Seleccione un medicamento</option>
                            @foreach($medicamentos as $medicamento)
                                <option value="{{ $medicamento->id }}">{{ $medicamento->nombre}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('delete_medicamento_id')" class="mt-2" />
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
    document.getElementById('select-medicamento').addEventListener('change', function () {
        const selectedMedicamento = this.options[this.selectedIndex].value;
        const medicamentos = @json($medicamentos);
        const medicamento = medicamentos.find(m => m.id == selectedMedicamento);

        if (medicamento) {
            const form = document.getElementById('editar-medicamento-form');
            form.action = `/medicamentos/${medicamento.id}`; // Update the form action URL
            document.getElementById('edit-medicamento-id').value = medicamento.id;
            document.getElementById('edit-medicamento-nombre').value = medicamento.nombre;
            document.getElementById('edit-medicamento-tipo').value = medicamento.tipo;
            document.getElementById('edit-medicamento-cantidad').value = medicamento.cantidad;
            document.getElementById('edit-medicamento-precio').value = medicamento.precio;
        }
    });

    document.getElementById('delete_medicamento_id').addEventListener('change', function() {
        const form = document.getElementById('delete-medicamento-form');
        form.action = "{{ url('/medicamentos') }}/" + this.value;
    });
    </script>
</x-app-layout>
