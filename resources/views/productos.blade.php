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
                                                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> Código</th>
                                                    <th><i class="fa fa-bookmark"></i> Cantidad</th>
                                                    <th><i class="fa fa-usd"></i> Precio Compra</th>
                                                    <th><i class="fa fa-usd"></i> Precio Venta</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="inventory-data-table">                                                

                                            </tbody>
                                            <tr>
                                                <td align="center" colspan="5">
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination justify-content-center">
                                                            <li class="page-item disabled">
                                                                <a class="page-link" href="#" aria-label="Previous">
                                                                    <span aria-hidden="true">&laquo;</span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" aria-label="Next">
                                                                    <span aria-hidden="true">&raquo;</span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </td>
                                            </tr>
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

