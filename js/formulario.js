function validateGeneral()
{
cont = 0;			
result = '';
    if($("#nombre").val()=='')
    {
        cont++;
        result = "<img src='img/no.png'> Debe ingresar el nombre<br />";
    }
    if($("#pass1").val()=='')
    {
        cont++;
        result = result+"<img src='img/no.png'> Debe ingresar una contraseña<br />";
    }else
    {
        if($("#pass1").val()==$("#pass2").val())
        {}else{
            cont++;
            result = result+"<img src='img/no.png'> La contraseña del primer campo no coincide con el segundo<br />";
        }
    }
    if($("#email").val()=='')
    {
        cont++;
        result = result+"<img src='img/no.png'> Debe ingresar el email<br />";
    }else
    {
        if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1)
        {
            cont++;
            result = result+"<img src='img/no.png'> El email que ha ingresado parece incorrecto<br />";
        }
    }
    if(cont>0)
    {
        $("#result").html(result);
    }else{
        $("#result").html("<img src='img/yes.png'> Los datos ingresados son correctos");
        $.ajax({
            type: "POST",
            url: "dao/crudForm.php",
            data: "nombre="+$("#nombre").val()+"&password="+$("#pass1").val()+"&email="+$("#email").val()+"&estado=Activo"+"&formAction=insert"+"&formTable=usuarios",
            async:true,
            beforeSend: function(objeto){
                $('#result').html("<img src='img/ajax-loader.gif'>&nbsp;&nbsp;Un momento, se esta creando el usuario...");
            },
            success: function(datos){
                if(datos=='OK')
                {
                    window.location.href="usuarios.php";
                }else{
                    image="<img src='images/no.png'> ";					
                    $('#result').html(image+" Los datos no fueron guardados, por favor intente de nuevo, se presento el siguiente error, si el problema persiste contactea soporte tecnico.<br />ERROR: "+datos);
                }
            },
            timeout: 300000
        });				
    }
}

function updateValidateGeneral()
{
	alert="entro";
cont = 0;			
result = '';
    if($("#nombre").val()=='')
    {
        cont++;
        result = "<img src='img/no.png'> Debe ingresar el nombre<br />";
    }
    if($("#email").val()=='')
    {
        cont++;
        result = result+"<img src='img/no.png'> Debe ingresar el email<br />";
    }else
    {
        if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1)
        {
            cont++;
            result = result+"<img src='img/no.png'> El email que ha ingresado parece incorrecto<br />";
        }
    }
    if($("#pass1").val()=='')
    {
		if(cont>0)
		{
			$("#result").html(result);
		}else{
			$("#result").html("<img src='img/yes.png'> Los datos ingresados son correctos");
			$.ajax({
				type: "POST",
				url: "dao/crudForm.php",
				data: "formAction=update&formTable=usuarios&nombre="+$("#nombre").val()+"&email="+$("#email").val()+"&condition=id="+$("#userId").val(),
				async:true,
				beforeSend: function(objeto){
					$('#result').html("<img src='img/ajax-loader.gif'>&nbsp;&nbsp;Un momento, se estan actualizando los datos...");
				},
				success: function(datos){
					if(datos=='OK')
					{
						window.location.href="usuarios.php";
					}else{
						image="<img src='images/no.png'> ";					
						$('#result').html(image+" Los datos no fueron guardados, por favor intente de nuevo, se presento el siguiente error, si el problema persiste contactea soporte tecnico.<br />ERROR: "+datos);
					}
				},
				timeout: 300000
			});
		}
	}else{
        if($("#pass1").val()==$("#pass2").val())
        {
			$("#result").html("<img src='img/yes.png'> Los datos ingresados son correctos");
			$.ajax({
				type: "POST",
				url: "dao/crudForm.php",
				data: "formAction=update&formTable=usuarios&nombre="+$("#nombre").val()+"&password="+$("#pass1").val()+"&email="+$("#email").val()+"&condition=id="+$("#userId").val(),
				async:true,
				beforeSend: function(objeto){
					$('#result').html("<img src='img/ajax-loader.gif'>&nbsp;&nbsp;Un momento, se estan actualizando los datos...");
				},
				success: function(datos){
					if(datos=='OK')
					{
						window.location.href="usuarios.php";
					}else{
						image="<img src='images/no.png'> ";					
						$('#result').html(image+" Los datos no fueron guardados, por favor intente de nuevo, se presento el siguiente error, si el problema persiste contactea soporte tecnico.<br />ERROR: "+datos);
					}
				},
				timeout: 300000
			});
		}else{
            cont++;
            result = result+"<img src='img/no.png'> La contraseña del primer campo no coincide con el segundo<br />";
        }
	}
	
		

}