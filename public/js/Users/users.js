/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import { _fetchService } from "./../General/general.js"; 


function _usersDashboard () {    
    const DOMitems = document.querySelector('#users-data-table');
    document.addEventListener("DOMContentLoaded",()=>{
        
        let token = document.getElementById('_token').value;
        let headers ={
          'Accept': 'application/json',
          'Content-Type': 'application/json'         
        }
        let params = JSON.stringify({_token: token});
        const response = _fetchService(api_url+"get/usuarios", params, headers).then(response => {
            document.getElementById('loader').style.display = 'none';
            if (response.code != 200) {
                document.getElementById('error').textContent = response.message;
                document.getElementById('error-element').style.display = 'block';
            } else {
                
                response.message.forEach(function (user) {                    
                    const miNodoTr = document.createElement('tr');
                        const miNodoTd = document.createElement('td');                    
                        const miNodoA = document.createElement('a');
                            miNodoA.setAttribute('href', 'basic_table.html#')
                            miNodoA.textContent = user.name;
                            const miNodoTdEmail = document.createElement('td');
                                miNodoTdEmail.classList.add('hidden-phone');
                                miNodoTdEmail.textContent = user.email;
                                
                                   
                            const miNodoTdStatus = document.createElement('td');
                            const miNodoSpan = document.createElement('span');
                                let status = (user.status == 1) ? 'Activo': 'Inactivo';
                                let labelInfo = (user.status == 1) ? 'label-info': 'label-warning';
                                miNodoSpan.classList.add('label', labelInfo, 'label-mini');
                                miNodoSpan.textContent = status;
                                miNodoTdStatus.appendChild(miNodoSpan);
                                
                             const miNodoTdButton = document.createElement('td');
                                const buttonEdit = document.createElement('button');
                                    buttonEdit.classList.add('btn', 'btn-success', 'btn-xs');
                                    const iEdit = document.createElement('i');
                                        iEdit.classList.add('fa', 'fa-edit');                                        
                                        buttonEdit.appendChild(iEdit);
                                        miNodoTdButton.appendChild(buttonEdit);                                        
                                        
                                const buttonDelete = document.createElement('button');
                                    buttonDelete.classList.add('btn', 'btn-danger', 'btn-xs');
                                    const iDelete = document.createElement('i');
                                        iDelete.classList.add('fa', 'fa-trash-o');
                                        buttonDelete.appendChild(iDelete);
                                        miNodoTdButton.appendChild(buttonDelete);

                        miNodoTd.appendChild(miNodoA);
                        miNodoTr.appendChild(miNodoTd);
                        miNodoTr.appendChild(miNodoTdEmail);
                        miNodoTr.appendChild(miNodoTdStatus);
                        miNodoTr.appendChild(miNodoTdButton);
                                                
                    DOMitems.appendChild(miNodoTr);
                });                
            }
        });
    });
}


function _createUser(event) {
    event.preventDefault();
    
    let token = document.getElementById('_token').value;
        
    let headers ={
      'Accept': 'application/json',
      'Content-Type': 'application/json'      
    }  
    
    let partner = (typeof (document.getElementById('partner')) != 'undefined' && document.getElementById('partner') != null) ? 0 : 1;

    let params = JSON.stringify({
        email: document.getElementById('email').value,
        password: document.getElementById('email').value,
        name: document.getElementById('name').value,        
        partner: partner,
        _token: token
    });
    
    document.getElementById('error').textContent = '';
    document.getElementById('error-element').style.display = 'none';
    document.getElementById('loader').style.display = 'block';
      
    const response = _fetchService(api_url+"creacion/usuarios", params, headers).then(response => {
        document.getElementById('loader').style.display = 'none';
        if (response.code != 200) {
            document.getElementById('error').textContent = response.message;
            document.getElementById('error-element').style.display = 'block';
        } else {
            window.location = users_view_url;
        }
    });
    
}


export {
    _usersDashboard,
    _createUser
};


