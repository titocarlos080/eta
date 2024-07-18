@extends('adminlte::page')
@section('title', 'Pagar Carrera')

@section('content')
<section class="content">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Mostrar mensajes de éxito y error -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            

                <div class="text-center mt-4">
                    <a href="/carrera_estudiantes" class="btn btn-primary">Volver a la Lista de Estudiantes</a>
                </div>
                @else
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Mostrar mensajes de validación de errores -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Realizar Pago</h4>
                    </div>
                    <div class="card-body">
                        <form id="formPago" action="/pagos_carrera" method="post" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label for="id">Código Estudiante:</label>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $materiaEstudiante->id }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="concepto">Concepto:</label>
                                <textarea id="concepto" name="concepto" class="form-control" rows="4" readonly>
PAGO DE CARRERA COMPLETA: {{ $materiaEstudiante->carrera->descripcion }} 
a nombre de estudiante: {{ $materiaEstudiante->estudiante->nombre }}, 
con cédula de identidad: {{ $materiaEstudiante->estudiante->ci }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="monto">Monto:</label>
                                <input type="text" class="form-control" id="monto" name="monto" placeholder="Ingrese el monto">
                            </div>

                            <div class="form-group text-right">
                                <button type="button" onclick="imprimirRecibo()" class="btn btn-primary" id="btnImprimir">Imprimir Recibo</button>
                                <button type="button" class="btn btn-success" id="btnRealizarPago">Realizar Pago</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>PAGAR CON SERVICIO PAGO FACIL</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de la pasarela de pagos -->
                        <form class="form-card" action="/consumirServicio" method="POST" target="QrImage">
                        @csrf
                        <div hidden class="row justify-content-between text-left">
                            <div   class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Razon Social</label>
                                <input  type="text" name="tcRazonSocial" placeholder="Nombre del Usuario">
                            </div>
                            <div   class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">CI/NIT</label>
                                <input type="text" name="tcCiNit" placeholder="Número de CI/NIT">
                            </div>
                        </div>
                        <div hidden class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Celular</label>
                                <input type="text" name="tnTelefono" placeholder="Número de Teléfono">
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label px-3">Correo</label>
                                <input type="text" name="tcCorreo" placeholder="Correo Electrónico">
                            </div>
                        </div>
                        <div hidden class="row justify-content-between text-left">
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
                        <input hidden type="text" class="form-control" id="id" name="id" value="{{ $materiaEstudiante->id }}" readonly>
                        <textarea hidden id="concepto" name="concepto" class="form-control" rows="4" readonly>
PAGO DE CARRERA COMPLETA: {{ $materiaEstudiante->carrera->descripcion }} 
a nombre de estudiante: {{ $materiaEstudiante->estudiante->nombre }}, 
con cédula de identidad: {{ $materiaEstudiante->estudiante->ci }}
                                </textarea>
                        <h5 class="text-center mt-4">Datos del Producto</h5>
                        <div   class="row justify-content-between text-left">
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
                        <div  class="row justify-content-between text-left">
                            <div   class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3">Precio</label>
                                <input type="text" name="taPedidoDetalle[0][Precio]" placeholder="">
                            </div>
                            <div   class="form-group col-sm-4 flex-column d-flex">
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
                    <div>
                    <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
                </div>
                </div>
                @endif
              
            </div>
        </div>
   
    </div>
</section>
@stop
