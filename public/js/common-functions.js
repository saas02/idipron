import { _fetchService } from "./General/general.js"; 
import { _usersDashboard, _createUser } from "./Users/users.js"; 
import { _inventoryData, _createInventory, _obtainInventoryData } from "./Inventory/inventory.js"; 
import { _postLogin } from "./Login/login.js"; 


var form_login = document.getElementById('form-login');
var form_create_user = document.getElementById('form-create-user');
var form_create_partner = document.getElementById('form-create-partner');
var users_data_table = document.getElementById('users-data-table');
var form_create_inventory = document.getElementById('form-create-inventory');
var inventory_data_table = document.getElementById('inventory-data-table');

if (typeof (form_login) != 'undefined' && form_login != null) {
    form_login.addEventListener('submit', _postLogin);
}

if (typeof (form_create_user) != 'undefined' && form_create_user != null) {
    form_create_user.addEventListener('submit', _createUser);
}

if (typeof (form_create_partner) != 'undefined' && form_create_partner != null) {
    form_create_partner.addEventListener('submit', _createUser);
}

if (typeof (form_create_inventory) != 'undefined' && form_create_inventory != null) {        
        
    form_create_inventory.addEventListener('submit', _createInventory);        
    
    document.getElementById('code').addEventListener('blur', function() {
        let code = document.getElementById('code').value;   
        
        if (typeof (code) != 'undefined' && code != null && code != "") {            
            _obtainInventoryData(code);            
        }else{
            document.getElementById('loader').style.display = 'none';
            document.getElementById('error').textContent = 'Producto no encontrado';
            document.getElementById('error-element').style.display = 'block';
            document.getElementById("form-create-inventory").reset();
        }
    });
}

if (typeof (users_data_table) != 'undefined' && users_data_table != null) {    
    _usersDashboard();
}

if (typeof (inventory_data_table) != 'undefined' && inventory_data_table != null) {
    _inventoryData();
}





