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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
            <div class="relative overflow-x-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
                    <div class="flex space-x-4">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="btn-custom focus:outline-none">
                            Registrar
                        </button>
                        <button data-modal-target="editar-patient-modal" data-modal-toggle="editar-patient-modal" class="btn-custom focus:outline-none">
                            Editar
                        </button>
                        <button data-modal-target="eliminar-cita-modal" data-modal-toggle="eliminar-cita-modal" class="btn-custom focus:outline-none">
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
                                Nombre del paciente
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de nacimiento
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Género
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Teléfono
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $paciente->nombre_completo }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $paciente->fecha_nacimiento }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $paciente->genero }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $paciente->telefono }}
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
                    Registrar Paciente
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('patients.store') }}" class="p-4 md:p-5">
                @csrf

                <!-- Nombre -->
                <div>
                    <x-input-label for="name" :value="__('Nombre completo')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="mt-4">
                    <x-input-label for="birthdate" :value="__('Fecha de nacimiento')" />
                    <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />
                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                </div>

                <!-- Género -->
                <div class="mt-4">
                    <x-input-label for="sex" :value="__('Género')" />
                    <select id="sex" name="sex" class="block mt-1 w-full">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                </div>

                <!-- Teléfono -->
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Teléfono')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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

<!-- Modal para editar pacientes -->
<div id="editar-patient-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Paciente
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editar-patient-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="" class="p-4 md:p-5" id="edit-patient-form">
                @csrf
                @method('PATCH')

                <!-- Nombre del Paciente -->
                <div class="mt-4">
                    <x-input-label for="edit_id_paciente" :value="__('Nombre del Paciente')" />
                    <select id="edit_id_paciente" name="edit_id_paciente" class="block mt-1 w-full" onchange="updateEditPatientFields()">
                        <option value="">Seleccione un paciente</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}" data-nacimiento="{{ $paciente->fecha_nacimiento }}" data-sexo="{{ $paciente->genero }}" data-telefono="{{ $paciente->telefono }}">{{ $paciente->nombre_completo }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('edit_id_paciente')" class="mt-2" />
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="mt-4">
                    <x-input-label for="edit-birthdate" :value="__('Fecha de nacimiento')" />
                    <x-text-input id="edit-birthdate" class="block mt-1 w-full" type="date" name="birthdate" required />
                    <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                </div>

                <!-- Género -->
                <div class="mt-4">
                    <x-input-label for="edit-sex" :value="__('Género')" />
                    <select id="edit-sex" name="sex" class="block mt-1 w-full">
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                    <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                </div>

                <!-- Teléfono -->
                <div class="mt-4">
                    <x-input-label for="edit-phone" :value="__('Teléfono')" />
                    <x-text-input id="edit-phone" class="block mt-1 w-full" type="tel" name="phone" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: #203d4a; ">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para eliminar pacientes -->
<div id="eliminar-cita-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Eliminar Paciente
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="eliminar-cita-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('patients.destroy', ['id' => 0]) }}" class="p-4 md:p-5" id="delete-patient-form">
                @csrf
                @method('DELETE')

                <!-- Nombre del Paciente -->
                <div class="mt-4">
                    <x-input-label for="delete_patient_id" :value="__('Nombre del Paciente')" />
                    <select id="delete_patient_id" name="delete_patient_id" class="block mt-1 w-full">
                        <option value="">Seleccione un paciente</option>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->nombre_completo }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('delete_patient_id')" class="mt-2" />
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

<!-- Codigo JS necesario para eliminar paciente -->
<script>
    document.getElementById('delete_patient_id').addEventListener('change', function() {
        const form = document.getElementById('delete-patient-form');
        form.action = "{{ url('/patients') }}/" + this.value;
    });
</script>

<!-- Codigo JS necesario para cuando se edita un paciente se autocompleten los datos -->
<script>
    function updateEditPatientFields() {
        const select = document.getElementById('edit_id_paciente');
        const selectedOption = select.options[select.selectedIndex];

        const birthdate = selectedOption.getAttribute('data-nacimiento');
        const sex = selectedOption.getAttribute('data-sexo');
        const phone = selectedOption.getAttribute('data-telefono');

        document.getElementById('edit-birthdate').value = birthdate ? birthdate : '';
        document.getElementById('edit-sex').value = sex ? sex : '';
        document.getElementById('edit-phone').value = phone ? phone : '';
        
        const form = document.getElementById('edit-patient-form');
        form.action = "{{ url('/patients') }}/" + selectedOption.value;
    }
</script>


</x-app-layout>
