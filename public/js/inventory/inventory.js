/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import { _fetchService, _formatPrice } from "./../General/general.js"; 


function _inventoryData(){
    const DOMitems = document.querySelector('#inventory-data-table');
    document.addEventListener("DOMContentLoaded",()=>{
        let token = document.getElementById('_token').value;
        
        let headers ={
          'Accept': 'application/json',
          'Content-Type': 'application/json'         
        }       

        let params = JSON.stringify({_token: token});
        
        const response = _fetchService(api_url+"get/productos", params, headers).then(response => {
            document.getElementById('loader').style.display = 'none';
            if (response.code != 200) {
                document.getElementById('error').textContent = response.message;
                document.getElementById('error-element').style.display = 'block';
            } else {
                
                response.message.forEach(function (inventory) {                    
                    const miNodoTr = document.createElement('tr');
                        const miNodoTd = document.createElement('td');                    
                        const miNodoA = document.createElement('a');
                            miNodoA.setAttribute('href', 'basic_table.html#')
                            miNodoA.textContent = inventory.name;
                            const miNodoTdCode = document.createElement('td');
                                miNodoTdCode.classList.add('hidden-phone');
                                miNodoTdCode.textContent = inventory.code;
                                
                            const miNodoTdQuantity = document.createElement('td');                                
                                miNodoTdQuantity.textContent = inventory.total_quantity;
                                
                            const miNodoPurchasePrice = document.createElement('td');                                
                                miNodoPurchasePrice.textContent = _formatPrice.format(inventory.purchase_price);
                                
                            const miNodoSalesPrice = document.createElement('td');
                                miNodoSalesPrice.textContent = _formatPrice.format(inventory.sale_price);                                

                        miNodoTd.appendChild(miNodoA);
                        miNodoTr.appendChild(miNodoTd);
                        miNodoTr.appendChild(miNodoTdCode);
                        miNodoTr.appendChild(miNodoTdQuantity);
                        miNodoTr.appendChild(miNodoSalesPrice);
                        miNodoTr.appendChild(miNodoPurchasePrice); 
                                                
                    DOMitems.appendChild(miNodoTr);
                });
            }
        });
    });
}

function _createInventory(event) {
    event.preventDefault();
    
    let token = document.getElementById('_token').value;
        
    let headers ={
      'Accept': 'application/json',
      'Content-Type': 'application/json'         
    }
    
    let concept_inventoy = (typeof (document.getElementById('concepto')) != 'undefined' && document.getElementById('concepto') != null) ? document.getElementById('concepto').value : null;
    let quantity = document.getElementById('quantity').value;
    
    if(concept_inventoy > 2){
        document.getElementById('error').textContent = 'Concepto no encontrado';
        document.getElementById('error-element').style.display = 'block';
    }else if(quantity < 1){
        document.getElementById('error').textContent = 'Cantidad Incorrecta';
        document.getElementById('error-element').style.display = 'block';
    }else{
        let params = JSON.stringify({
            name: document.getElementById('name').value,
            code: document.getElementById('code').value,
            quantity: quantity,
            sale_price: document.getElementById('sale_price').value,
            purchase_price: document.getElementById('purchase_price').value,
            concepto : concept_inventoy,
            _token: token,
            details:{
                description : document.getElementById('description').value
            }        
        });

        document.getElementById('error').textContent = '';
        document.getElementById('error-element').style.display = 'none';
        document.getElementById('loader').style.display = 'block';

        const response = _fetchService(api_url+"creacion/productos", params, headers).then(response => {
            document.getElementById('loader').style.display = 'none';
            if (response.code != 200) {
                document.getElementById('error').textContent = response.message;
                document.getElementById('error-element').style.display = 'block';
                document.getElementById('buttonform').style.display = 'none';
            } else {
                window.location = inventory_view_url;                
            }
        });
    }
    
    
    
}

async function _obtainInventoryData(code){
    const dataInventory = await _obtainInventoryId(code);        
    let concept_inventoy = (typeof (document.getElementById('concepto')) != 'undefined' && document.getElementById('concepto') != null) ? document.getElementById('concepto').value : null;
    
    if (dataInventory.code != 200 || dataInventory.message.length == 0) {
        document.getElementById("form-create-inventory").reset();
        document.getElementById('loader').style.display = 'none';
        document.getElementById('error').textContent = (dataInventory.message.length == 0) ? 'El producto no se encuentra' : dataInventory.message;
        document.getElementById('error-element').style.display = 'block';
        document.getElementById('buttonform').disabled = false;
        //document.getElementById('quantity').readOnly = true;
        document.getElementById('code').value = code;
    } else {        
        document.getElementById('loader').style.display = 'none';
        document.getElementById('name').value = dataInventory.message[0].name;
        document.getElementById('purchase_price').value = dataInventory.message[0].purchase_price;
        document.getElementById('sale_price').value = dataInventory.message[0].sale_price;
        document.getElementById('quantity').value = dataInventory.message[0].total_quantity;
        document.getElementById('description').value = JSON.parse(dataInventory.message[0].details).description;
        let readonlyQuantity = false;
        let disableButton = false;
        if(dataInventory.message[0].total_quantity < 1){
            readonlyQuantity = (concept_inventoy > 1) ? true: false;
            disableButton = (concept_inventoy > 1) ? true: false;
        }
        document.getElementById('quantity').readOnly = readonlyQuantity;
        document.getElementById('quantity').min = 0
        if(concept_inventoy > 1){
            document.getElementById('quantity').max = dataInventory.message[0].total_quantity            
        }        
        
        document.getElementById('buttonform').disabled = disableButton;
        document.getElementById('buttonform').style.display = 'block';
    }
}

async function _obtainInventoryId(code) {    
    
    let token = document.getElementById('_token').value;
        
    let headers ={
      'Accept': 'application/json',
      'Content-Type': 'application/json'         
    }        

    let params = JSON.stringify({
        code: code,
        _token: token               
    });
    
    document.getElementById('error').textContent = '';
    document.getElementById('error-element').style.display = 'none';
    document.getElementById('loader').style.display = 'block';
    let result = null;
    await _fetchService(api_url+"obtener/productos", params, headers).then(response => {        
        result = response
    });
    
    return result;
}


export {
    _inventoryData,
    _createInventory,
    _obtainInventoryData
}


