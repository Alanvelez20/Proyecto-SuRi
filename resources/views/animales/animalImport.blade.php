@extends('components.miLayout')

@section('content')
<h1>Importar Animales</h1><br>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<form method="POST" action="{{ route('animales.import') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="row" >
            <div class="col-sm-4">
                <label class="btn btn-primary btn-block" id="fileLabel" for="file">Selecciona un archivo (CSV, XLSX):</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <div class="col-sm-4">
                <a href="{{ route('animales.import.form') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-info btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Ver Imagen de Ejemplo
                </button>
            </div>
        </div>
    </div>


    <button type="button" id="previewButton" class="btn btn-primary">Previsualizar</button>
    <button type="submit" id="confirmImport" class="btn btn-success" style="display: none;">Importar</button>
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 style="color: black" class="modal-title" id="exampleModalLabel">Imagen de Ejemplo</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="{{ asset('mainlayout/img/EjemploExcelAnimal.jpg') }}" class="img-fluid" alt="Imagen de Ejemplo">
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <span>¡Si no se previsualiza correctamente, revisa tu excel!</span>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

<div id="preview" style="display: none;">
    <h2>Previsualización</h2>
    <table class="table" id="previewTable">
        <thead>
            <tr>
                <th>Arete</th>
                <th>Especie</th>
                <th>Género</th>
                <th>Peso</th>
                <th>Valor de compra</th>
                <th>Fecha de ingreso</th>
                <th>Corral</th>
                <th>Lote</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    document.getElementById('file').addEventListener('change', function() {
        const fileInput = document.getElementById('file');
        const fileLabel = document.getElementById('fileLabel');
        const file = fileInput.files[0];
        if (file) {
            fileLabel.textContent = `Archivo seleccionado: ${file.name}`;
        } else {
            fileLabel.textContent = 'Selecciona un archivo (CSV, XLSX):';
        }
    });

    document.getElementById('previewButton').addEventListener('click', function() {
        const fileInput = document.getElementById('file');
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                const firstSheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[firstSheetName];
                const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

                const previewTable = document.getElementById('previewTable').querySelector('tbody');
                previewTable.innerHTML = ''; // Limpiar tabla
                jsonData.forEach((row, index) => {
                    if (index >= 0) { // Asegúrate de que haya datos
                        let date = row[5];
                        // Convertir el formato de fecha
                        if (typeof date === 'string') {
                            if (moment(date, 'YYYY-MM-DD', true).isValid()) {
                                date = moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
                            } else if (moment(date, 'DD/MM/YYYY', true).isValid()) {
                                date = moment(date, 'DD/MM/YYYY').format('DD/MM/YYYY');
                            } else {
                                date = 'Formato de fecha inválido';
                            }
                        } else if (typeof date === 'number') {
                            date = moment(XLSX.SSF.parse_date_code(date)).format('DD/MM/YYYY');
                        }

                        const tr = document.createElement('tr');
                        tr.innerHTML = `<td>${row[0] !== undefined ? row[0] : ''}</td>
                                        <td>${row[1] !== undefined ? row[1] : ''}</td>
                                        <td>${row[2] !== undefined ? row[2] : ''}</td>
                                        <td>${row[3] !== undefined ? row[3] : ''}</td>
                                        <td>${row[4] !== undefined ? row[4] : ''}</td>
                                        <td>${date !== undefined ? date : ''}</td>
                                        <td>${row[6] !== undefined ? row[6] : ''}</td>
                                        <td>${row[7] !== undefined ? row[7] : ''}</td>`;
                        previewTable.appendChild(tr);
                    }
                });
                if (jsonData.length > 0) {
                    document.getElementById('preview').style.display = 'block';
                    document.getElementById('confirmImport').style.display = 'inline-block';
                } else {
                    document.getElementById('preview').style.display = 'none';
                    document.getElementById('confirmImport').style.display = 'none';
                }
            };
            reader.readAsArrayBuffer(file);
        }
    });
</script>

@endsection
