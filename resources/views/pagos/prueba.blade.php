@extends('adminlte::page')

@section('title', 'pagos')

@section('content')

<div class="container mt-5">
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 text-center">
                <h3>PagoFacil QR y Tigo Money</h3>
                <div class="card">
                    <form class="form-card" action="/consumirServicio" method="POST" target="QrImage">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Razon Social</label>
                                <input type="text" name="tcRazonSocial" placeholder="Nombre del Usuario">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">CI/NIT</label>
                                <input type="text" name="tcCiNit" placeholder="Número de CI/NIT">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Celular</label>
                                <input type="text" name="tnTelefono" placeholder="Número de Teléfono">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Correo</label>
                                <input type="text" name="tcCorreo" placeholder="Correo Electrónico">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Monto Total</label>
                                <input type="text" name="tnMonto" placeholder="Costo Total">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Tipo de Servicio</label>
                                <select name="tnTipoServicio" class="form-control">
                                    <option value="1">Servicio QR</option>
                                    <option value="2">Tigo Money</option>
                                </select>
                            </div>

                        </div>
                        <h5 class="text-center mt-4">Datos del Producto</h5>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Serial</label>
                                <input type="text" name="taPedidoDetalle[0][Serial]" placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Producto</label>
                                <input type="text" name="taPedidoDetalle[0][Producto]" placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Cantidad</label>
                                <input type="text" name="taPedidoDetalle[0][Cantidad]" placeholder="">
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Precio</label>
                                <input type="text" name="taPedidoDetalle[0][Precio]" placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Descuento</label>
                                <input type="text" name="taPedidoDetalle[0][Descuento]" placeholder="">
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Total</label>
                                <input type="text" name="taPedidoDetalle[0][Total]" placeholder="">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-6">
                                <button type="submit" class="btn-block btn-primary">Consumir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12 py-5">
                <div class="row d-flex justify-content-center">
                    <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
<div>
    @include('pagos.boton_pago_facil')
</div>


</div>
@stop

@push('scripts')
<script src="{{ asset('js/theme.js') }}"></script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
@endpush