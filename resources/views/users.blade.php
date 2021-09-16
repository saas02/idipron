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
                            <h4 class="mb"><i class="fa fa-user"></i> Listar Usuarios</h4>

                            <div class="row mt">
                                <div class="col-md-12">
                                    <div class="content-panel">
                                        <table class="table table-striped table-advance table-hover">                                                                                                
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-bullhorn"></i> Nombre</th>
                                                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Email</th>
                                                    <th><i class=" fa fa-edit"></i> Estado</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="users-data-table">                                                
                                                
                                            </tbody>
                                        </table>
                                    </div><!-- /content-panel -->
                                </div><!-- /col-md-12 -->
                            </div><!-- /row -->                             
                            @include('error')  
                            @include('preloader')  
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

