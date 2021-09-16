/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var LANGUAGE = "en-US";
var CASH = "COP";
var _formatPrice = new Intl.NumberFormat(LANGUAGE, {
    style:"currency", 
    currency:CASH,
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
});

async function _fetchService(url, params, header = false) {
    
    var headers = new Headers();
    if (!header) {
        headers.append('Content-Type', 'application/json');
        headers.append('Accept', 'application/json');  
    }else{
        headers = header;
    }

    const response = await fetch(url, {
        mode: 'cors',        
        method: 'POST',
        headers: headers,
        body: params
    });
    
    if (!response.ok) {
        const message = `An error has occured: ${response.status}`;        
        document.getElementById('error').textContent = response.message
        document.getElementById('error-element').style.display = 'block';
        //throw new Error(message);                
    }

    const result = await response.json();
    
    if(result.message == 'Expired token'){
        window.location = close_url;
    }    
    
    return result;
    
}

function _validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


export {
    _fetchService,
    _formatPrice,
    _validateEmail
};



