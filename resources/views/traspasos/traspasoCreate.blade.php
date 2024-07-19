@extends('components.miLayout')

@section('content')
<div class="container">
    <h1>Traspaso de Animal</h1>
    <form action="{{ route('traspaso.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lote_origen">Lote de Origen</label>
            <select name="lote_origen" id="lote_origen" class="form-control" required>
                <option style="color: black;" value="">Seleccione un Lote</option>
                @foreach($lotes as $lote)
                    <option style="color: black;" value="{{ $lote->id }}">{{ $lote->lote_nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="animal_arete">ID del Animal (Arete)</label>
            <select name="animal_arete" id="animal_arete" class="form-control" required>
                <option style="color: black;" value="">Seleccione un Lote de Origen primero</option>
            </select>
        </div>
        <div class="form-group">
            <label for="lote_destino">Lote de Destino</label>
            <select name="lote_destino" id="lote_destino" class="form-control" required>
                <option style="color: black;" value="">Seleccione un Lote</option>
                @foreach($lotes as $lote)
                    <option style="color: black;" value="{{ $lote->id }}">{{ $lote->lote_nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Traspasar</button>
    </form>

    <h2>Resumen del Animal</h2>
    <table class="table table-bordered" id="animal-summary" style="display:none;">
        <tr><th>Arete</th><td id="summary-arete"></td></tr>
        <tr><th>Especie</th><td id="summary-especie"></td></tr>
        <tr><th>Género</th><td id="summary-genero"></td></tr>
        <tr><th>Peso Inicial</th><td id="summary-peso-inicial"></td></tr>
        <tr><th>Peso Final</th><td id="summary-peso-final"></td></tr>
        <tr><th>Valor de Compra</th><td id="summary-valor-compra"></td></tr>
        <tr><th>Valor de Venta</th><td id="summary-valor-venta"></td></tr>
        <tr><th>Fecha de Ingreso</th><td id="summary-fecha-ingreso"></td></tr>
        <tr><th>Consumo Total</th><td id="summary-consumo-total"></td></tr>
        <tr><th>Costo Total</th><td id="summary-costo-total"></td></tr>
        <tr><th>ID del Lote</th><td id="summary-id-lote"></td></tr>
    </table>
</div>

<script>
    document.getElementById('lote_origen').addEventListener('change', function () {
        var loteId = this.value;
        var animalSelect = document.getElementById('animal_arete');
    
        if (loteId) {
            fetch(`/api/lote/${loteId}/animales`)
                .then(response => response.json())
                .then(data => {
                    animalSelect.innerHTML = '<option style="color: black;" value="">Seleccione un Animal</option>';
                    data.forEach(animal => {
                        animalSelect.innerHTML += `<option style="color: black;" value="${animal.arete}">${animal.arete}</option>`;
                    });
                });
        } else {
            animalSelect.innerHTML = '<option style="color: black;" value="">Seleccione un Lote de Origen primero</option>';
        }
    });
    
    document.getElementById('animal_arete').addEventListener('change', function () {
        var animalArete = this.value;
    
        if (animalArete) {
            fetch(`/api/animal/${animalArete}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Animal data:', data); // Log para depuración
                    document.getElementById('summary-arete').innerText = data.arete;
                    document.getElementById('summary-especie').innerText = data.animal_especie;
                    document.getElementById('summary-genero').innerText = data.animal_genero;
                    document.getElementById('summary-peso-inicial').innerText = data.animal_peso_inicial;
                    document.getElementById('summary-peso-final').innerText = data.animal_peso_final;
                    document.getElementById('summary-valor-compra').innerText = data.animal_valor_compra;
                    document.getElementById('summary-valor-venta').innerText = data.animal_valor_venta;
                    document.getElementById('summary-fecha-ingreso').innerText = data.fecha_ingreso;
                    document.getElementById('summary-consumo-total').innerText = data.consumo_total;
                    document.getElementById('summary-costo-total').innerText = data.costo_total;
                    document.getElementById('summary-id-lote').innerText = data.animal_id_lote;
                    document.getElementById('animal-summary').style.display = 'table';
                });
        } else {
            document.getElementById('animal-summary').style.display = 'none';
        }
    });
</script>
@endsection

