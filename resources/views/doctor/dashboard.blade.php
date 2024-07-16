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
            Citas del día de hoy
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="relative overflow-x-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center items-center">
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
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nombre del paciente</th>
                                    <th scope="col" class="px-6 py-3">Fecha</th>
                                    <th scope="col" class="px-6 py-3">Hora</th>
                                    <th scope="col" class="px-6 py-3">Teléfono</th>
                        
                                    <!-- <th scope="col" class="px-6 py-3">Consultar</th> -->

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agendas->where('atendida', 0) as $agenda)
                                    @php
                                        $paciente = $pacientes->find($agenda->id_paciente_agenda);
                                    @endphp
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $paciente->nombre_completo }}
                                        </th>
                                        <td class="px-6 py-4">{{ $agenda->fecha }}</td>
                                        <td class="px-6 py-4">{{ $agenda->hora }}</td>
                                        <td class="px-6 py-4">{{ $agenda->telefono }}</td>
                                        <!-- <td class="px-6 py-4">
                                            <form method="GET" action="{{ route('consultas.show', $agenda->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-custom focus:outline-none">
                                                    Consultar
                                                </button>
                                                 -->
                                            </form>
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
</x-app-layout>