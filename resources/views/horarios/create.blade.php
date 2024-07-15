<form action="{{ route('horarios.store') }}" method="POST">
   
    @csrf
    <div class="form-group">
        <label for="hora_inicio">Hora de Inicio</label>
        <input type="time" name="hora_inicio" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="hora_fin">Hora de Fin</label>
        <input type="time" name="hora_fin" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
