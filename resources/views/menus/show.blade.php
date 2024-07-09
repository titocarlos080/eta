 
<div class="container">
    <h1>Detalles del Menú</h1>
    <div class="mb-3">
        <strong>Nombre:</strong> {{ $menu->nombre }}
    </div>
    <div class="mb-3">
        <strong>Ruta:</strong> {{ $menu->ruta }}
    </div>
    <a href="{{ route('menus.index') }}" class="btn btn-primary">Volver a la lista</a>
</div>
 
