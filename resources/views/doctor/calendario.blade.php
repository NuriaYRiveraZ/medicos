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
        border-radius: 10px; /* Ajusta este valor según tu preferencia */
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
            Agenda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Day Grid Calendar -->
                        <div class="col-span-2 bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                            <div id="dayGridCalendar"></div>
                        </div>

                        <!-- Appointments List -->
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                            <h2 class="text-lg font-semibold mb-4">Próximas citas</h2>
                            <div class="flex justify-between items-center mb-4">
                                <button data-modal-target="agendar-cita-modal" data-modal-toggle="agendar-cita-modal" class="btn-custom focus:outline-none">
                                    Agendar cita
                                </button>
                            </div>
                            <ul id="appointmentsList" class="list-disc pl-5">
                                @forelse($appointments as $appointment)
                                    <li>
                                        <strong>Paciente:</strong> {{ $appointment['title'] }}<br>
                                        <strong>Fecha:</strong> {{ $appointment['date'] }}<br>
                                        <strong>Hora:</strong> {{ $appointment['time'] }}<br>
                                        <strong>Teléfono:</strong> {{ $appointment['phone'] }}
                                    </li>
                                @empty
                                    <li>No hay citas para hoy.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agendar citas -->
    <div id="agendar-cita-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agendar Cita
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="agendar-cita-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('agendas.store') }}" class="p-4 md:p-5">
                    @csrf
                    <!-- Nombre del Paciente -->
                    <div class="mt-4">
                        <x-input-label for="id_paciente_agenda" :value="__('Nombre del Paciente')" />
                        <select id="id_paciente_agenda" name="id_paciente_agenda" class="block mt-1 w-full" onchange="updatePhoneNumber()">
                            <option value="">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" data-telefono="{{ $paciente->telefono }}">{{ $paciente->nombre_completo }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_paciente_agenda')" class="mt-2" />
                    </div>

                    <!-- Fecha -->
                    <div class="mt-4">
                        <x-input-label for="fecha" :value="__('Fecha')" />
                        <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" :value="old('fecha')" required min="{{ date('Y-m-d') }}" />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                    </div>


                    <!-- Hora -->
                    <div class="mt-4">
                        <x-input-label for="hora" :value="__('Hora')" />
                        <select id="hora" name="hora" class="block mt-1 w-full">
                            @for ($i = 8; $i <= 20; $i++)
                                <option value="{{ $i }}:00">{{ $i }}:00</option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('hora')" class="mt-2" />
                    </div>

                    <!-- Teléfono -->
                    <div class="mt-4">
                        <x-input-label for="telefono" :value="__('Teléfono')" />
                        <x-text-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" :value="old('telefono')" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Registrar cita') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Código JS necesario para cuando se agende cita se agrege automáticamente el número del paciente -->
    <script>
        function updatePhoneNumber() {
            const select = document.getElementById('id_paciente_agenda');
            const selectedOption = select.options[select.selectedIndex];
            const telefono = selectedOption.getAttribute('data-telefono');
            document.getElementById('telefono').value = telefono ? telefono : '';
        }

        document.addEventListener('DOMContentLoaded', function () {
            var dayGridEl = document.getElementById('dayGridCalendar');

            // Day Grid Calendar
            var dayGridCalendar = new FullCalendar.Calendar(dayGridEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                events: @json($events),
                height: 'auto', 
                contentHeight: 'auto', 
                eventDisplay: 'block', 
                titleFormat: { 
                    month: 'long', 
                    year: 'numeric'
                },
                views: {
                    dayGridMonth: {
                        titleFormat: { month: 'long', year: 'numeric' }
                    }
                },
                allDaySlot: false
            });
            dayGridCalendar.render();
        });
    </script>
    @push('scripts')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    @endpush
    <style>
        .fc {
            font-size: 0.8em;
        }
    </style>
</x-app-layout>
