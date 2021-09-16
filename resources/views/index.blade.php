@extends('base')


@section('content')        
    <div id="login-page">
        <div class="container">

            <form class="form-login" id="form-login" action="/home" method="POST">
                @csrf
                <h2 class="form-login-heading"><i class="fa fa-user"></i> Login</h2>
                <div class="login-wrap">
                    <input type="email" required class="form-control" id="user" name="user" placeholder="Usuario" autofocus>
                    <br>
                    <input type="password" required id="pass" name="pass" class="form-control" placeholder="Contraseña">
                    <input type="hidden" id="token" name="token" value="">
                    <label class="checkbox">
                        <span class="pull-right">
                            <a data-toggle="modal" href="login.html#myModal"> Recordar Contraseña?</a>
                        </span>
                    </label>                                        
                    <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                    <hr>
                    @include('error') 
                    @include('preloader')                                          
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Forgot Password ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                <button class="btn btn-theme" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->
            </form>	  	
        </div>
    </div>

@stop
