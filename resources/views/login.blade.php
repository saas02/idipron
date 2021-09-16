@if (session()->has('message'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session()->get('message') }}</li>
        </ul>
    </div>            
@endif

<div class="title">
    <h2>Login</h2>            
</div>

<form id="login" name="login" action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}            
    <div class="form-group row">
        <label for="inputvehiculo" class="col-sm-2 col-form-label">Usuario</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputvehiculo" class="col-sm-2 col-form-label">Contraseña</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
        </div>
    </div>
                        
    <div class="form-group row">
        <div class="col-sm-10">
        <button id="formButton" name="formButton" type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
</form>