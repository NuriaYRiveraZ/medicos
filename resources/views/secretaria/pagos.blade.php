<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pagos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($pacientes->isEmpty())
                        <p class="text-center text-lg">No existen pagos pendientes</p>
                    @else
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-center">Nombre</th>
                                    <th class="px-6 py-3 text-center">Total a Pagar</th>
                                    <th class="px-6 py-3 text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="pendingPaymentsTable">
                                @foreach($pacientes as $paciente)
                                <tr class="text-center">
                                    <td class="px-6 py-4">{{ $paciente->nombre_completo }}</td>
                                    <td class="px-6 py-4">{{ $paciente->total_pagar }}</td>
                                    <td class="px-6 py-4">
                                        <button class="btn-custom"
                                            onclick="openPaymentModal('{{ $paciente->id }}', '{{ $paciente->total_pagar }}')">
                                            Completar Pago
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 px-4 py-3">
                    <h3 class="text-lg leading-6 font-medium text-white">
                        Completar Pago
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div>
                        <label for="paymentType" class="block text-sm font-medium text-gray-700">Método de Pago</label>
                        <select id="paymentType" name="paymentType" class="mt-1 block w-full rounded-md shadow-sm">
                            <option value="cash">Efectivo</option>
                            <option value="card">Tarjeta</option>
                        </select>
                    </div>

                    <div id="cashPayment" class="mt-4 hidden">
                        <label for="amountGiven" class="block text-sm font-medium text-gray-700">Monto Recibido</label>
                        <input type="number" id="amountGiven" name="amountGiven"
                            class="mt-1 block w-full rounded-md shadow-sm">
                        <p id="changeDue" class="mt-2 text-sm text-gray-600">Cambio: $0.00</p>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="completePayment()"
                        class="w-full inline-flex justify-center rounded-md shadow-sm px-4 py-2 bg-blue-600 text-white font-medium">
                        Confirmar Pago
                    </button>
                    <button onclick="closePaymentModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md shadow-sm px-4 py-2 bg-gray-300 text-gray-700 font-medium sm:mt-0 sm:w-auto">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Receipt Modal -->
    <div id="printReceiptModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div
                class="bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 px-4 py-3">
                    <h3 class="text-lg leading-6 font-medium text-white">
                        ¿Desea imprimir el ticket?
                    </h3>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="printReceipt()"
                        class="w-full inline-flex justify-center rounded-md shadow-sm px-4 py-2 bg-blue-600 text-white font-medium">
                        Sí, Imprimir
                    </button>
                    <button onclick="skipPrintReceipt()"
                        class="mt-3 w-full inline-flex justify-center rounded-md shadow-sm px-4 py-2 bg-gray-300 text-gray-700 font-medium sm:mt-0 sm:w-auto">
                        No, Gracias
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function openPaymentModal(id, total) {
            document.getElementById('paymentModal').classList.remove('hidden');
            document.getElementById('paymentModal').dataset.patientId = id;
            document.getElementById('paymentModal').dataset.total = total;
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        function openPrintReceiptModal() {
            document.getElementById('printReceiptModal').classList.remove('hidden');
        }

        function closePrintReceiptModal() {
            document.getElementById('printReceiptModal').classList.add('hidden');
        }

        document.getElementById('paymentType').addEventListener('change', function () {
            if (this.value === 'cash') {
                document.getElementById('cashPayment').classList.remove('hidden');
            } else {
                document.getElementById('cashPayment').classList.add('hidden');
            }
        });

        document.getElementById('amountGiven').addEventListener('input', function () {
            const total = parseFloat(document.getElementById('paymentModal').dataset.total);
            const amountGiven = parseFloat(this.value);
            const changeDue = amountGiven - total;
            document.getElementById('changeDue').textContent = 'Cambio: $' + changeDue.toFixed(2);
        });

        function completePayment() {
            const patientId = document.getElementById('paymentModal').dataset.patientId;
            const paymentType = document.getElementById('paymentType').value;
            const total = parseFloat(document.getElementById('paymentModal').dataset.total);

            if (paymentType === 'cash') {
                const amountGiven = parseFloat(document.getElementById('amountGiven').value);
                if (amountGiven >= total) {
                    openPrintReceiptModal();  // Abre el modal para imprimir el recibo
                } else {
                    alert('El monto recibido es insuficiente.');
                }
            } else {
                openPrintReceiptModal();  // Abre el modal para imprimir el recibo
            }
        }

        function printReceipt() {
            const patientId = document.getElementById('paymentModal').dataset.patientId;
            const paymentType = document.getElementById('paymentType').value;
            const total = parseFloat(document.getElementById('paymentModal').dataset.total);
            const amountGiven = parseFloat(document.getElementById('amountGiven').value) || null;

            generatePDFReceipt(patientId, paymentType, amountGiven);
            closePrintReceiptModal();
            updatePaymentStatus(patientId, paymentType);

            // Cerrar modal de pago automáticamente después de imprimir el ticket
            closePaymentModal();
        }

        function skipPrintReceipt() {
            closePrintReceiptModal();
            const patientId = document.getElementById('paymentModal').dataset.patientId;
            const paymentType = document.getElementById('paymentType').value;
            updatePaymentStatus(patientId, paymentType);
        }

        function updatePaymentStatus(patientId, paymentType) {
            fetch(`/completar-pago/${patientId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_type: paymentType
                })
            })
        }

        function moveToPaidTable(patientId) {
            const row = document.querySelector(`button[onclick*="${patientId}"]`).closest('tr');
            const paidTable = document.getElementById('paidPaymentsTable');
            paidTable.appendChild(row);  // Mueve la fila a la tabla de pagados
            row.querySelector('td:nth-child(3)').innerHTML = '<span class="text-green-500 font-bold">Pagado</span>';
        }

        function generatePDFReceipt(patientId, paymentType, amountGiven = null) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({
        unit: 'mm',
        format: [70, 160]
    });

    // Colors
    const headerColor = [26, 188, 156];  // Teal
    const textColor = [44, 62, 80];      // Dark blue
    const separatorColor = [149, 165, 166]; // Gray

    // Header
    doc.setFont('Helvetica', 'bold');
    doc.setFontSize(14);
    doc.setTextColor(headerColor[0], headerColor[1], headerColor[2]);
    doc.text('Heaven Medical Center', 35, 10, { align: 'center' });

    doc.setFont('Helvetica', 'normal');
    doc.setFontSize(10);
    doc.setTextColor(textColor[0], textColor[1], textColor[2]);
    doc.text('RECIBO DE PAGO', 35, 18, { align: 'center' });

    // Patient Information
    doc.setFontSize(9);
    doc.text('Paciente ID: ' + patientId, 10, 30);
    doc.text('Método de Pago: ' + (paymentType === 'cash' ? 'Efectivo' : 'Tarjeta'), 10, 36);

    // Payment Details
    doc.text('TOTAL: $' + parseFloat(document.getElementById('paymentModal').dataset.total).toFixed(2), 10, 60);

    if (paymentType === 'cash') {
        const changeDue = amountGiven - parseFloat(document.getElementById('paymentModal').dataset.total);
        doc.text('RECIBIDO: $' + amountGiven.toFixed(2), 10, 75);
        doc.text('DEVOLUCIÓN: $' + changeDue.toFixed(2), 10, 81);
    }

    // Separator Line
    doc.setLineWidth(0.3);
    doc.setDrawColor(separatorColor[0], separatorColor[1], separatorColor[2]);
    doc.line(10, 110, 60, 110);

    // Thank You Note
    doc.setFontSize(10);
    doc.setTextColor(headerColor[0], headerColor[1], headerColor[2]);
    doc.text('¡GRACIAS POR SU COMPRA!', 35, 125, { align: 'center' });

    // Save PDF
    doc.save('recibo-pago.pdf');
}

    </script>
</x-app-layout>
