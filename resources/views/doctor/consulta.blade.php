<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
         border-radius: 9999px;
         text-align: center;
         }
         .btn-custom:hover {
         background-color: #1a3140;
         }
         .focus\:outline-none:focus {
         outline: none;
         }
      </style>
   </head>
   <body class="bg-gray-100">
      <x-app-layout>
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
                        <button class="btn-custom focus:outline-none">Terminar consulta</button>
                     </div>
                     <div class="p-6">
                        <div class="flex items-center mb-4">
                           <div class="flex-shrink-0">
                              <img class="h-12 w-12 rounded-full" src="images/logo_grande.png" alt="profile picture">
                           </div>
                           <div class="ml-4">
                              <div class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                 Carlos Rivera
                              </div>
                              <div class="text-sm text-gray-500 dark:text-gray-400">
                              </div>
                           </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-6">
                           <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                              <div class="px-4 py-5 sm:px-6">
                                 <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                    Signos vitales
                                 </h3>
                              </div>
                              <div class="border-t border-gray-200 dark:border-gray-700">
                                 <dl class="grid grid-cols-2 gap-x-4 gap-y-8 px-4 py-5 sm:grid-cols-4 sm:px-6">
                                    <div class="sm:col-span-1">
                                       <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Talla</dt>
                                       <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="tallaValue">0 m</dd>
                                       <input type="text" id="tallaInput" class="hidden mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="sm:col-span-1">
                                       <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Temperatura</dt>
                                       <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="temperaturaValue">0 °C</dd>
                                       <input type="text" id="temperaturaInput" class="hidden mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="sm:col-span-1">
                                       <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Peso</dt>
                                       <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="pesoValue">0 kg</dd>
                                       <input type="text" id="pesoInput" class="hidden mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="sm:col-span-1">
                                       <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Saturación de oxígeno</dt>
                                       <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="saturacionValue">0%</dd>
                                       <input type="text" id="saturacionInput" class="hidden mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="sm:col-span-1">
                                       <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Frecuencia cardíaca</dt>
                                       <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="frecuenciaValue">0 bpm</dd>
                                       <input type="text" id="frecuenciaInput" class="hidden mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <div class="sm:col-span-1">
                                       <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tensión arterial</dt>
                                       <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200" id="tensionValue">0/0 (mm/Hg)</dd>
                                       <input type="text" id="tensionInput" class="hidden mt-1 block w-full sm:text-sm border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                    <button id="editButton" class="btn-custom mt-2 focus:outline-none">Editar</button>
                                 </dl>
                              </div>
                           </div>
                        </div>
                        <script>
                           document.addEventListener('DOMContentLoaded', function () {
                           								        const editButton = document.getElementById('editButton');
                           								        const fields = [
                           								            { valueId: 'tallaValue', inputId: 'tallaInput' },
                           								            { valueId: 'temperaturaValue', inputId: 'temperaturaInput' },
                           								            { valueId: 'pesoValue', inputId: 'pesoInput' },
                           								            { valueId: 'saturacionValue', inputId: 'saturacionInput' },
                           								            { valueId: 'frecuenciaValue', inputId: 'frecuenciaInput' },
                           								            { valueId: 'tensionValue', inputId: 'tensionInput' }
                           								        ];
                           								
                           								        editButton.addEventListener('click', function () {
                           								            fields.forEach(field => {
                           								                const valueElement = document.getElementById(field.valueId);
                           								                const inputElement = document.getElementById(field.inputId);
                           								
                           								                // Mostrar campos de edición y establecer el valor actual
                           								                valueElement.classList.add('hidden');
                           								                inputElement.classList.remove('hidden');
                           								                inputElement.value = valueElement.textContent.trim();
                           								            });
                           								
                           								            // Cambiar texto del botón a "Guardar" u otra acción relevante
                           								            editButton.textContent = 'Guardar';
                           								            editButton.removeEventListener('click', handleEdit);
                           								            editButton.addEventListener('click', handleSave);
                           								        });
                           								
                           								        function handleSave() {
                           								            fields.forEach(field => {
                           								                const valueElement = document.getElementById(field.valueId);
                           								                const inputElement = document.getElementById(field.inputId);
                           								
                           								                // Guardar los datos modificados
                           								                valueElement.textContent = inputElement.value;
                           								                valueElement.classList.remove('hidden');
                           								                inputElement.classList.add('hidden');
                           								            });
                           								
                           								            // Restaurar el botón a su estado original
                           								            editButton.textContent = 'Editar';
                           								            editButton.removeEventListener('click', handleSave);
                           								            editButton.addEventListener('click', handleEdit);
                           								        }
                           								
                           								        function handleEdit() {
                           								            fields.forEach(field => {
                           								                const valueElement = document.getElementById(field.valueId);
                           								                const inputElement = document.getElementById(field.inputId);
                           								
                           								                // Restaurar los campos a su estado original
                           								                valueElement.classList.remove('hidden');
                           								                inputElement.classList.add('hidden');
                           								            });
                           								
                           								            editButton.textContent = 'Editar';
                           								            editButton.removeEventListener('click', handleSave);
                           								            editButton.addEventListener('click', handleEdit);
                           								        }
                           								    });
                           								
                           
                        </script>
                        <div class="">
                           <div class="px-4 py-5 sm:px-6">
                              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                 Motivo de la consulta
                              </h3>
                           </div>
                           <div class="border-t border-gray-200 dark:border-gray-700">
                              <textarea rows="4" class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                           </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-6">
                           <div class="px-4 py-5 sm:px-6">
                              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                 Diagnóstico
                              </h3>
                           </div>
                           <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                              <input type="text" placeholder="Diagnóstico" class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              <button class="btn-custom mt-2 focus:outline-none">Agregar diagnóstico</button>
                           </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-6">
                           <div class="px-4 py-5 sm:px-6">
                              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                 Receta
                              </h3>
                           </div>
                           <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                              <div class="mb-4">
                                 <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">Medicamentos</h4>
                                 <div class="flex items-center mb-4">
                                    <select class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="medicamento">
                                       <option value="">Selecciona un medicamento</option>
                                       @foreach($medicamentos as $medicamento)
                                       <option value="{{ $medicamento->id }}" data-precio="{{ $medicamento->precio }}">{{ $medicamento->nombre }}</option>
                                       @endforeach
                                    </select>
                                    <input type="text" placeholder="Cantidad" class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2" id="cantidadMedicamento">
                                    <input type="text" placeholder="Frecuencia" class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="frecuenciaMedicamento">
                                    <input type="text" placeholder="Duración" class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2" id="duracionMedicamento">
                                 </div>
                                 <textarea rows="2" placeholder="Agregar notas..." class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="notasMedicamento"></textarea>
                                 <button class="btn-custom mt-2 focus:outline-none" id="agregarMedicamento">Agregar medicamento</button>
                              </div>
                              <div class="mb-4">
                                 <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">Servicios</h4>
                                 <div class="flex items-center mb-4">
                                    <select class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="extra">
                                       <option value="">Selecciona un servicio</option>
                                       @foreach($servicios as $servicio)
                                       <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">{{ $servicio->nombre }}</option>
                                       @endforeach
                                    </select>
                                    <input type="text" placeholder="Cantidad" class="block w-full p-2.5 mt-1 text-sm text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mx-2" id="cantidadExtra">
                                 </div>
                                 <button class="btn-custom mt-2 focus:outline-none" id="agregarExtra">Agregar servicio</button>
                              </div>
                              <div class="mb-4">
                                 <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">Resumen de Receta</h4>
                                 <div id="resumenReceta"></div>
                              </div>
                              <div class="mb-4">
                                 <h4 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200 mb-4">Total a Pagar</h4>
                                 <div id="totalAPagar" class="text-lg leading-6 text-gray-900 dark:text-gray-200">$0.00</div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <script>
                        document.addEventListener('DOMContentLoaded', function () {
                                    const agregarMedicamentoBtn = document.getElementById('agregarMedicamento');
                                    const agregarExtraBtn = document.getElementById('agregarExtra');
                                    const resumenReceta = document.getElementById('resumenReceta');
                                    const totalAPagar = document.getElementById('totalAPagar');
                        
                                    let total = 0;
                        
                                    agregarMedicamentoBtn.addEventListener('click', function () {
                                        const medicamentoSelect = document.getElementById('medicamento');
                                        const cantidadMedicamento = document.getElementById('cantidadMedicamento').value;
                                        const frecuenciaMedicamento = document.getElementById('frecuenciaMedicamento').value;
                                        const duracionMedicamento = document.getElementById('duracionMedicamento').value;
                                        const notasMedicamento = document.getElementById('notasMedicamento').value;
                        
                                        const medicamentoNombre = medicamentoSelect.options[medicamentoSelect.selectedIndex].text;
                                        const medicamentoPrecio = parseFloat(medicamentoSelect.options[medicamentoSelect.selectedIndex].getAttribute('data-precio'));
                        
                                        if (medicamentoNombre && cantidadMedicamento && frecuenciaMedicamento && duracionMedicamento) {
                                            const medicamentoItem = document.createElement('div');
                                            medicamentoItem.textContent = `${medicamentoNombre} - Cantidad: ${cantidadMedicamento}, Frecuencia: ${frecuenciaMedicamento}, Duración: ${duracionMedicamento}, Notas: ${notasMedicamento}`;
                                            resumenReceta.appendChild(medicamentoItem);
                        
                                            total += medicamentoPrecio;
                                            totalAPagar.textContent = `$${total.toFixed(2)}`;
                                        } else {
                                            alert('Por favor, complete todos los campos del medicamento.');
                                        }
                                    });
                        
                                    agregarExtraBtn.addEventListener('click', function () {
                                        const extraSelect = document.getElementById('extra');
                                        const cantidadExtra = document.getElementById('cantidadExtra').value;
                        
                                        const extraNombre = extraSelect.options[extraSelect.selectedIndex].text;
                                        const extraPrecio = parseFloat(extraSelect.options[extraSelect.selectedIndex].getAttribute('data-precio'));
                        
                                        if (extraNombre && cantidadExtra) {
                                            const extraItem = document.createElement('div');
                                            extraItem.textContent = `${extraNombre} - Cantidad: ${cantidadExtra}`;
                                            resumenReceta.appendChild(extraItem);
                        
                                            total += extraPrecio;
                                            totalAPagar.textContent = `$${total.toFixed(2)}`;
                                        } else {
                                            alert('Por favor, complete todos los campos del servicio.');
                                        }
                                    });
                                });
                        
                     </script>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </x-app-layout>
   </body>
</html>