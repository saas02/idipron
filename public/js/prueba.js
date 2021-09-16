var getCities = function () {
    $("#id_ciudad").empty();
    $.ajax({            
        data: { "departamento" : $("#id_departamento").val(), "_token": $('#token').val() },            
        type: "POST",            
        dataType: "json",            
        url: "/ciudades",
    })
        .done(function( data, textStatus, jqXHR ) {
            if ( console && console.log ) {
                console.log( data );
                if(data.code == 200){                    
                    if(data.message){
                    $dataOption = '';
                    data.message.forEach(function(info, index) {
                        $('#id_ciudad').append($('<option />', {
                            text: info.nombre,
                            value: info.id,
                        }));                            
                    });
                    }else{
                    console.log( "La solicitud a fallado: " +  data.code);         
                    }
                
                }else{
                console.log( "La solicitud a fallado: " +  data.code);    
                }
            }
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
            }
    });
};

$( document ).ready(function() {

    if($('#id_departamento').val() != '' && $('#id_departamento').val() != 0){
        getCities();
    }
    
    $('#id_departamento').change(function(){
        getCities();
    });
        
    $("#login").validate({
        rules: {            
            user: {
                required: true,
                maxlength: 255,
                email: true
            }, 
            password: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            user: {
                required : "Este campo es obligatorio.",
            },
            password: {
                required : "Este campo es obligatorio.",
            }
        }
    });

    $( "#formButton" ).click(function() {        
        $( "#login" ).valid();
    });  
    
    
    

});