 
 
<div class="container">
    <h1>Menús</h1>
    <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Crear Nuevo Menú</a>
    @if($menus->isEmpty())
        <p>No hay menús disponibles.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ruta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->nombre }}</td>
                    <td>{{ $menu->ruta }}</td>
                    <td>
                        <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
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
 
