<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

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
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Consultas') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="relative overflow-x-auto">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                        <span>{{ __("Consulta") }}</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="/images/logo_grande.png" alt="profile picture">
                            </div>
                            <div class="ml-4">
                                <div class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                    {{ $paciente->nombre_completo }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Fecha de Nacimiento: {{ $paciente->fecha_nacimiento }} <br>
                                    Género: {{ $paciente->genero }} <br>
                                    Teléfono: {{ $paciente->telefono }} <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">Signos vitales
                            </h3>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700">
                            <dl class="grid grid-cols-2 gap-x-4 gap-y-8 px-4 py-5 sm:grid-cols-4 sm:px-6">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Talla</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="tallaValue">0 m </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Temperatura</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="temperaturaValue"> 0
                                        °C</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Peso</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="pesoValue">0 kg </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Saturación de
                                        oxígeno</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="saturacionValue"> 0%
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Frecuencia cardíaca
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="frecuenciaValue">0 bpm
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tensión arterial
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="tensionValue">0/0
                                        (mm/Hg)</dd>
                                </div>
                                <button id="editButton" class="btn-custom focus:outline-none">Editar</button>
                            </dl>
                        </div>
                    </div>

<!-- Modal -->
<div id="signosVitalesModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
        <div
            class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200"
                            id="modalTitle"> Editar Signos Vitales </h3>
                        <div class="mt-2">
                            <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                                <div>
                                    <label for="modalTallaInput"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Talla (cm)</label>
                                    <input type="number" id="modalTallaInput" min="50" max="250"
                                        class="mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="modalTemperaturaInput"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Temperatura (°C)</label>
                                    <input type="number" step="0.1" min="35" max="42" id="modalTemperaturaInput"
                                        class="mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="modalPesoInput"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Peso (kg)</label>
                                    <input type="number" min="2" max="300" step="0.1" id="modalPesoInput"
                                        class="mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="modalSaturacionInput"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Saturación de oxígeno (%)</label>
                                    <input type="number" min="70" max="100" id="modalSaturacionInput"
                                        class="mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="modalFrecuenciaInput"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Frecuencia cardíaca (bpm)</label>
                                    <input type="number" min="30" max="200" id="modalFrecuenciaInput"
                                        class="mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="modalTensionInput"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tensión arterial (mmHg)</label>
                                    <input type="text" id="modalTensionInput" placeholder="120/80" maxlength="7"
                                        class="mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-900 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="modalSaveButton" type="button"
                    class="btn-custom focus:outline-none">Guardar</button>
                <button id="modalCancelButton" type="button"
                    class="btn-custom focus:outline-none">Cancelar</button>
            </div>
        </div>
    </div>
</div>
    <script>
    const tensionInput = document.getElementById('modalTensionInput');

    tensionInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-numeric characters
        if (value.length >= 3) {
            value = value.slice(0, 3) + '/' + value.slice(3, 6);
        }
        e.target.value = value;
    });
</script>

                    <div class="">
                        <!-- Motivo de Consulta -->
                        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">Motivo de
                                Consulta</h3>
                            <textarea rows="3" placeholder="Describa el motivo de la consulta..."
                                class="block w-full p-2.5 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                id="motivoConsultaTextarea"></textarea>
                            <button class="btn-custom mt-2 focus:outline-none"
                                id="guardarMotivoConsulta">Guardar</button>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-6">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">Receta</h3>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                                <!-- Medicamentos -->
                                <div class="mb-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">
                                        Medicamentos</h4>
                                    <div class="flex items-center mb-4">
                                        <select
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            id="medicamento">
                                            <option value="">Selecciona un medicamento</option>
                                            @foreach($medicamentos as $medicamento)
                                            <option value="{{ $medicamento->id }}"
                                                data-precio="{{ $medicamento->precio }}">
                                                {{ $medicamento->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="text" placeholder="Cantidad"
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2"
                                            id="cantidadMedicamento">
                                        <input type="text" placeholder="Frecuencia"
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            id="frecuenciaMedicamento">
                                        <input type="text" placeholder="Duración"
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2"
                                            id="duracionMedicamento">
                                    </div>
                                    <textarea rows="2" placeholder="Agregar notas..."
                                        class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        id="notasMedicamento"></textarea>
                                    <button class="btn-custom mt-2 focus:outline-none" id="agregarMedicamento">Agregar
                                        medicamento</button>
                                </div>
                                <!-- Servicios -->
                                <div class="mb-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">
                                        Servicios</h4>
                                    <div class="flex items-center mb-4">
                                        <select
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            id="servicio">
                                            <option value="">Selecciona un servicio</option>
                                            @foreach($servicios as $servicio)
                                            <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                                                {{ $servicio->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="text" placeholder="Cantidad"
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2"
                                            id="cantidadServicio">
                                    </div>
                                    <button class="btn-custom mt-2 focus:outline-none" id="agregarServicio">Agregar
                                        servicio</button>
                                </div>
                                <!-- Productos -->
                                <div class="mb-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">
                                        Productos</h4>
                                    <div class="flex items-center mb-4">
                                        <select
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            id="producto">
                                            <option value="">Selecciona un producto</option>
                                            @foreach($productos as $producto)
                                            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio }}">
                                                {{ $producto->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="text" placeholder="Cantidad"
                                            class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2"
                                            id="cantidadProducto">
                                    </div>
                                    <button class="btn-custom mt-2 focus:outline-none" id="agregarProducto">Agregar
                                        producto</button>
                                </div>
                                <!-- Resumen -->
                                <div class="mb-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">
                                        Resumen de Receta</h4>
                                    <div id="resumenReceta"></div>
                                </div>
                                <form method="POST" action="{{ route('terminarConsulta') }}" id="terminarConsultaForm">
                                    @csrf
                                    <input type="hidden" name="id_paciente_citas" value="{{ $paciente->id }}">
                                    <input type="hidden" name="peso" id="hiddenPesoInput">
                                    <input type="hidden" name="temperatura" id="hiddenTemperaturaInput">
                                    <input type="hidden" name="frecuencia_cardiaca" id="hiddenFrecuenciaInput">
                                    <input type="hidden" name="tension" id="hiddenTensionInput">
                                    <input type="hidden" name="talla" id="hiddenTallaInput">
                                    <input type="hidden" name="saturacion" id="hiddenSaturacionInput">
                                    <input type="hidden" name="motivo_consulta" id="hiddenMotivoConsulta">
                                    <input type="hidden" name="total" id="hiddenTotalInput">

                                    <div id="medicamentosHiddenInputs"></div>
                                    <div id="serviciosHiddenInputs"></div>
                                    <div id="productosHiddenInputs"></div>
                                    
                                    <button type="submit" class="btn-custom focus:outline-none">Terminar
                                        consulta</button>
                                </form>
                            </div>
                            <button id="downloadPdf" class="btn-custom focus:outline-none">Descargar receta</button>
                        
                        </div>

                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const agregarMedicamentoBtn = document.getElementById('agregarMedicamento');
                            const agregarServicioBtn = document.getElementById('agregarServicio');
                            const agregarProductoBtn = document.getElementById('agregarProducto');
                            const resumenReceta = document.getElementById('resumenReceta');
                            const totalAPagar = document.getElementById('totalAPagar');
                            const guardarMotivoConsultaBtn = document.getElementById('guardarMotivoConsulta');
                            const editButton = document.getElementById('editButton');
                            const modal = document.getElementById('signosVitalesModal');
                            const modalSaveButton = document.getElementById('modalSaveButton');
                            const modalCancelButton = document.getElementById('modalCancelButton');

                            let total = 0;
                            let resumenAgregado = false;

                            const fields = [
                                { valueId: 'tallaValue', inputId: 'modalTallaInput', hiddenInputId: 'hiddenTallaInput' },
                                { valueId: 'temperaturaValue', inputId: 'modalTemperaturaInput', hiddenInputId: 'hiddenTemperaturaInput' },
                                { valueId: 'pesoValue', inputId: 'modalPesoInput', hiddenInputId: 'hiddenPesoInput' },
                                { valueId: 'saturacionValue', inputId: 'modalSaturacionInput', hiddenInputId: 'hiddenSaturacionInput' },
                                { valueId: 'frecuenciaValue', inputId: 'modalFrecuenciaInput', hiddenInputId: 'hiddenFrecuenciaInput' },
                                { valueId: 'tensionValue', inputId: 'modalTensionInput', hiddenInputId: 'hiddenTensionInput' }
                            ];

                            function crearResumenEstructurado() {
                                if (resumenAgregado) return;

                                const estructura = `
                                    <div class="receta-medica">
                                        <h2 class="text-xl font-bold mb-4">Receta Médica</h2>
                                        <div class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                            Paciente: {{ $paciente->nombre_completo }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            Fecha de Nacimiento: {{ $paciente->fecha_nacimiento }} <br>
                                            Género: {{ $paciente->genero }} <br>
                                        </div>
                                        <div id="infoConsulta" class="mb-4"></div>
                                        <div id="motivoConsultaResumen" class="mb-4"></div>
                                        <div id="summary" class="mb-4"></div>
                                        <div id="medicamentos" class="mb-4">
                                            <h3 class="text-lg font-semibold">Medicamentos:</h3>
                                        </div>
                                        <div id="servicios" class="mb-4">
                                            <h3 class="text-lg font-semibold">Servicios:</h3>
                                        </div>
                                        <div id="productos" class="mb-4">
                                            <h3 class="text-lg font-semibold">Productos:</h3>
                                        </div>
                                        <div id="totalPagar" class="mt-4 font-bold"></div>
                                    </div>
                                `;
                                resumenReceta.innerHTML = estructura;
                                resumenAgregado = true;
                            }

                            function agregarItem(selectId, cantidadId, resumenTipo) {
                                crearResumenEstructurado();
                                const selectElement = document.getElementById(selectId);
                                const cantidadElement = document.getElementById(cantidadId);
                                const cantidad = cantidadElement.value;
                                const nombre = selectElement.options[selectElement.selectedIndex].text;
                                const precio = parseFloat(selectElement.options[selectElement.selectedIndex].getAttribute('data-precio'));
                                const id = selectElement.options[selectElement.selectedIndex].value;

                                if (nombre && cantidad) {
                                    const item = document.createElement('p');
                                    item.textContent = `${nombre} - Cantidad: ${cantidad}`;
                                    document.getElementById(resumenTipo.toLowerCase()).appendChild(item);

                                    total += precio * cantidad;
                                    actualizarTotal();

                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = `${resumenTipo.toLowerCase()}[${id}][id]`;
                                    hiddenInput.value = id;
                                    document.getElementById(`${resumenTipo.toLowerCase()}HiddenInputs`).appendChild(hiddenInput);

                                    const hiddenInputCantidad = document.createElement('input');
                                    hiddenInputCantidad.type = 'hidden';
                                    hiddenInputCantidad.name = `${resumenTipo.toLowerCase()}[${id}][cantidad]`;
                                    hiddenInputCantidad.value = cantidad;
                                    document.getElementById(`${resumenTipo.toLowerCase()}HiddenInputs`).appendChild(hiddenInputCantidad);
                                }
                            }


                            function actualizarTotal() {
                                document.getElementById('totalPagar').textContent = `Total a Pagar: $${total.toFixed(2)}`;
                                document.getElementById('hiddenTotalInput').value = total.toFixed(2); /* agregue esto */
                            }


                            agregarMedicamentoBtn.addEventListener('click', function () {
                                agregarItem('medicamento', 'cantidadMedicamento', 'medicamentos');
                                const notasMedicamento = document.getElementById('notasMedicamento').value;
                                if (notasMedicamento) {
                                    const notasItem = document.createElement('p');
                                    notasItem.textContent = `Notas: ${notasMedicamento}`;
                                    document.getElementById('medicamentos').appendChild(notasItem);
                                }
                            });

                            agregarServicioBtn.addEventListener('click', function () {
                                agregarItem('servicio', 'cantidadServicio', 'servicios');
                            });

                            agregarProductoBtn.addEventListener('click', function () {
                                agregarItem('producto', 'cantidadProducto', 'productos');
                            });

                            function agregarMotivoConsulta() {
                                const motivoConsulta = document.getElementById('motivoConsultaTextarea').value;
                                if (motivoConsulta) {
                                    const motivoDiv = document.getElementById('motivoConsultaResumen');
                                    motivoDiv.innerHTML = `<h3 class="text-lg font-semibold">Motivo de Consulta:</h3><p>${motivoConsulta}</p>`;
                                }
                            }

                            guardarMotivoConsultaBtn.addEventListener('click', function () {
                                crearResumenEstructurado();
                                agregarMotivoConsulta();
                                document.getElementById('hiddenMotivoConsulta').value = document.getElementById('motivoConsultaTextarea').value;
                            });

                            editButton.addEventListener('click', function () {
                                fields.forEach(field => {
                                    const valueElement = document.getElementById(field.valueId);
                                    const inputElement = document.getElementById(field.inputId);
                                    inputElement.value = valueElement.textContent.trim();
                                });
                                modal.classList.remove('hidden');
                            });

                            modalSaveButton.addEventListener('click', function () {
                                fields.forEach(field => {
                                    const valueElement = document.getElementById(field.valueId);
                                    const inputElement = document.getElementById(field.inputId);
                                    valueElement.textContent = inputElement.value.trim();
                                    document.getElementById(field.hiddenInputId).value = inputElement.value.trim();
                                });

                                crearResumenEstructurado();
                                const summary = document.getElementById('summary');
                                summary.innerHTML = `
                                    <p>Talla: ${document.getElementById('modalTallaInput').value.trim()} m</p>
                                    <p>Temperatura: ${document.getElementById('modalTemperaturaInput').value.trim()} °C</p>
                                    <p>Peso: ${document.getElementById('modalPesoInput').value.trim()} kg</p>
                                    <p>Saturación de oxígeno: ${document.getElementById('modalSaturacionInput').value.trim()} %</p>
                                    <p>Frecuencia cardíaca: ${document.getElementById('modalFrecuenciaInput').value.trim()} bpm</p>
                                    <p>Tensión arterial: ${document.getElementById('modalTensionInput').value.trim()} mm/Hg</p>
                                `;

                                modal.classList.add('hidden');
                            });

                            modalCancelButton.addEventListener('click', function () {
                                modal.classList.add('hidden');
                            });
                        });
                    </script>
                    
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const { jsPDF } = window.jspdf;
                            const downloadPdfBtn = document.getElementById('downloadPdf');

                            downloadPdfBtn.addEventListener('click', function () {
                                const pdf = new jsPDF({
                                    orientation: 'portrait',
                                    unit: 'mm',
                                    format: 'a4'
                                });

                                const pageWidth = pdf.internal.pageSize.getWidth();
                                const margin = 20; // Set margins
                                let y = 50; // Adjust the initial Y to start below the header

                                // Adding stylized title for 'Heaven Medical Solutions'
                                pdf.setFontSize(16);
                                pdf.setFont('helvetica', 'bold');
                                pdf.setTextColor('#cc0000');
                                pdf.text('HEAVEN MEDICAL SOLUTIONS', (pageWidth / 2), 20, { align: 'center' });
                                pdf.setTextColor('#333333');
                                pdf.text('Receta Médica', (pageWidth / 2), 28, { align: 'center' });

                                // Reset text color for normal content
                                pdf.setTextColor(0, 0, 0);
                                pdf.setFontSize(11);
                                pdf.setFont('helvetica', 'normal');

                                const nombrePaciente = "{{ $paciente->nombre_completo }}";
                                const fechaNacimiento = "{{ $paciente->fecha_nacimiento }}";
                                const genero = "{{ $paciente->genero }}";
                                pdf.text(`Nombre del Paciente: ${nombrePaciente}`, margin, y);
                                y += 6;
                                pdf.text(`Fecha de Nacimiento: ${fechaNacimiento}`, margin, y);
                                y += 6;
                                pdf.text(`Género: ${genero}`, margin, y);
                                y += 10;

                                const motivoConsultaResumen = document.getElementById('motivoConsultaResumen').innerText;
                                const signosVitalesResumen = document.getElementById('summary').innerText;
                                const medicamentos = document.getElementById('medicamentos').innerText;
                                const servicios = document.getElementById('servicios').innerText;
                                const productos = document.getElementById('productos').innerText;
                                const totalPagar = document.getElementById('totalPagar').innerText;

                                // Add content directly without titles
                                const contents = [motivoConsultaResumen, signosVitalesResumen, medicamentos, servicios, productos];

                                contents.forEach(content => {
                                    const contentLines = pdf.splitTextToSize(content, pageWidth - 2 * margin);
                                    contentLines.forEach(line => {
                                        pdf.text(line, margin, y);
                                        y += 5;
                                    });
                                    y += 6; // Add extra space after each content
                                });

                                // Total to Pay
                                pdf.setFontSize(12);
                                pdf.setFont('helvetica', 'bold');
                                pdf.text(`${totalPagar}`, margin, y);
                                y += 10;

                                pdf.save(`receta_medica_${nombrePaciente.replace(/\s+/g, '_').toLowerCase()}.pdf`);
                            });
                        });
                    </script>
</x-app-layout>