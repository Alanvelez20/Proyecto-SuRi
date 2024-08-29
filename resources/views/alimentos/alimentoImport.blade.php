@extends('components.miLayout')

@section('content')
<h1>Importar Alimentos</h1><br>

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

<form method="POST" action="{{ route('alimentos.import') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="row" >
            <div class="col-sm-4">
                <label class="btn btn-primary btn-block" id="fileLabel" for="file">Selecciona un archivo (CSV, XLSX):</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <div class="col-sm-4">
                <a href="{{ route('alimentos.import.form') }}" class="btn btn-primary btn-block">Reiniciar filtros</a>
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
          <h3  class="modal-title" id="exampleModalLabel">Imagen de Ejemplo</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="{{ asset('mainlayout/img/EjemploExcelAlimento.jpg') }}" class="img-fluid" alt="Imagen de Ejemplo">
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
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Costo</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
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

            // Iterar sobre las filas a partir del índice 1 (omitir encabezados)
            jsonData.forEach((row, index) => {
                if (index > 0) {
                    const tr = document.createElement('tr');
                    row.forEach((cell) => {
                        tr.innerHTML += `<td>${cell !== null && cell !== undefined ? cell : '0'}</td>`;
                    });
                    previewTable.appendChild(tr);
                }
            });

            if (jsonData.length > 1) {
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
