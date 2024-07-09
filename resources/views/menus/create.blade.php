 
<div class="container">
    <h1>Crear Menú</h1>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="ruta">Ruta</label>
            <input type="text" name="ruta" id="ruta" class="form-control" value="{{ old('ruta') }}" required>
            @error('ruta')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
 