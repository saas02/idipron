@extends('base')


@section('content')
    <section id="container" >
        @csrf
        @include('header')  
        @include('nav')  

        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-users"></i> Inventarios</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            @if ($concepto == 1) 
                                @php
                                    $readonly = '';
                                    $tittle = 'Crear Producto';
                                    $message = 'Crear';
                                    $button = 'success';
                                @endphp
                                
                                @elseif ($concepto == 2)
                                @php
                                    $readonly = 'disabled';
                                    $tittle = 'Descontar Producto';
                                    $message = 'Descontar';
                                    $button = 'warning';
                                @endphp
                                
                            @endif
                            <h4 class="mb"><i class="fa fa-user"></i> {{ $tittle }}</h4>
                            <form class="form-horizontal style-form" id="form-create-inventory" action="/crear/productos" method="POST">
                                
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Código</label>
                                    <div class="col-sm-10">
                                        <input type="text" required id="code" name="code" class="form-control">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Nombre Producto</label>
                                    <div class="col-sm-10">
                                        <input type="text" {{ $readonly }}  required id="name" name="name" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-10">
                                        <input type="text"  {{ $readonly }} required id="description" name="description" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Cantidad</label>
                                    <div class="col-sm-10">
                                        <input type="number"  min="0" required id="quantity" name="quantity" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Precio de Compra</label>
                                    <div class="col-sm-10">
                                        <input type="text" {{ $readonly }}  required id="sale_price" name="sale_price" placeholder="$" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Precio de venta</label>
                                    <div class="col-sm-10">
                                        <input type="text" {{ $readonly }} required id="purchase_price" name="purchase_price" placeholder="$" class="form-control">
                                    </div>
                                </div>
                                                             
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <button class="btn btn-{{ $button }} btn-block" {{ $readonly }} type="submit" id="buttonform"><i class="fa fa-plus-circle"></i> Guardar </button>
                                    </div>
                                </div>   
                                <input type="hidden" name="concepto" id="concepto" value="{{ $concepto }}">

                                @include('error')  
                                @include('preloader')                                            
                            </form>
                        </div>
                    </div><!-- col-lg-12-->      	
                </div><!-- /row -->
            </section>
        </section>

        <!--main content end-->
        <!--footer start-->
        @include('footer')     
        <!--footer end-->
    </section>
@stop
