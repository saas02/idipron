/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import { _fetchService, _validateEmail } from "./../General/general.js"; 


function _postLogin(event) {
    event.preventDefault();

    document.getElementById('error').textContent = '';
    document.getElementById('error-element').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    let user = document.getElementById('user').value;
    let pass = document.getElementById('pass').value;
    let token = document.getElementById('_token').value;

    if (user == '') {
        document.getElementById('error').textContent = 'El email esta vacio';
        document.getElementById('error-element').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
    } else if (pass == '') {
        document.getElementById('error').textContent = 'La contraseña esta vacia';
        document.getElementById('error-element').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
    } else {
        if (_validateEmail(user)) {
            let params = JSON.stringify({email: user, password: pass, _token: token});
            const response = _fetchService(api_url+"auth/login", params)
                .then(response => {
                    console.log(response);
                    document.getElementById('loader').style.display = 'none';
                    if (response.code != 200) {
                        document.getElementById('error').textContent = response.message;
                        document.getElementById('error-element').style.display = 'block';
                    } else {                        
                        document.getElementById("form-login").submit();
                    }
            });            
        } else {
            document.getElementById('error').textContent = 'Formato de correo incorrecto'
            document.getElementById('error-element').style.display = 'block';
        }
    }
}

export {
    _postLogin
}


