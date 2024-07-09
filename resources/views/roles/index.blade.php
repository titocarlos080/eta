 
<div class="container">
    <h1>Roles</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Crear Nuevo Rol</a>
    @if($roles->isEmpty())
        <p>No hay roles disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->nombre }}</td>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
