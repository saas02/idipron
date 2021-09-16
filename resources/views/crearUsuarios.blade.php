@extends('base')


@section('content')
    <section id="container" >
        @csrf
        @include('header')  
        @include('nav')  

        <section id="main-content">
            <section class="wrapper">
                <h3><i class="fa fa-users"></i> Usuarios</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb"><i class="fa fa-user"></i> Crear Usuario</h4>
                            <form class="form-horizontal style-form" id="form-create-user" action="/creacion/usuarios" method="POST">
                                
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" required id="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" required id="name" name="name" class="form-control">
                                    </div>
                                </div>
                                                                                              
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label"></label>
                                    <div class="col-sm-4">
                                        <button class="btn btn-success btn-block" type="submit"><i class="fa fa-plus-circle"></i> Crear</button>
                                    </div>
                                </div>                                
                                   
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
