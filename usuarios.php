<?php
	require_once("dao/connection.php");
	require_once("bo/Usuarios/Usuarios.php");
	$usuarios= new Usuarios();
	$usuarios->getUsuarios();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet/css" href="css/bootstrap.css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="js/jQueryTableSorterConPaging/_assets/themes/yui/style.css" rel="stylesheet" type="text/css" />        
    <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" />        
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/jQueryTableSorterConPaging/_assets/js/jquery.tablesorter-2.0.3.js" type="text/javascript"></script>
    <script src="js/jQueryTableSorterConPaging/_assets/js/jquery.tablesorter.filer.js" type="text/javascript"></script>
    <script src="js/jQueryTableSorterConPaging/_assets/js/jquery.tablesorter.pager.js" type="text/javascript"></script>
	<script src="js/jquery.alerts.js" type="text/javascript"></script>
	<script type="text/javascript">    
    
    $(document).ready(function() {  
           $("#tableOne").tablesorter({ debug: false, sortList: [[1, 0]], widgets: ['zebra'] })
                            .tablesorterPager({ container: $("#pagerOne"), positionFixed: false })
                            .tablesorterFilter({ filterContainer: $("#filterBoxOne"),
                                filterClearContainer: $("#filterClearOne"),
                                filterColumns: [0, 1, 2],
                                filterCaseSensitive: false
                            });
    });
    </script>    
<script type="text/javascript" language="Javascript">
function changeStatus(usuarioId,status)
{
	if(status=='Activo'){Nstatus='Inactivo';}else{Nstatus='Activo';}
			$.ajax({
				type: "POST",
				url: "dao/crudForm.php",
				data: "estado="+Nstatus+"&formAction=update&formTable=usuarios&condition=id="+usuarioId,
				async:true,
				beforeSend: function(objeto){
					$('#result').html("<img src='img/ajax-loader.gif'>&nbsp;&nbsp;Un momento, estamos actualizando la informacion...");
				},
				success: function(datos){
					if(datos=='OK')
					{
						window.location.href="usuarios.php";
					}else{
						image="<img src='img/no.png'> ";					
						$('#result').html(image+" Los datos no fueron actualizados, por favor intente de nuevo, se presento el siguiente error, si el problema persiste contactea soporte tecnico.<br />ERROR: "+datos);
					}
				},
				timeout: 300000
			});
}
function deleteRow(id)
{
	jConfirm('Realmente desea eliminar el usuario?', 'Eliminar Usuario', function(r) {
	if(r==true)
	{
			$.ajax({
				type: "POST",
				url: "dao/crudForm.php",
				data: "formAction=delete&formTable=usuarios&condition=id="+id,
				async:true,
				success: function(datos){
					if(datos=='OK')
					{
						jAlert(datos, 'El usuario ha sido eliminado');
						window.location.href="usuarios.php";												
					}else{
						jAlert(datos, 'No se pudo eliminar el usuario');												
					}
				},
				timeout: 300000
			});		
	}
});

}
function redirect(url)
{
	window.location.href=url;
}
</script>
</head>
<body>
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Mintcoders</a>
        </div>
      </div>
    </div>
 <!---->
 <div class="container">
    <div class="content">
      <div class="page-header">
        <h1><br />Listado de usuarios</h1>
        <small id="result"></small>
      </div>
<table width="100%" class="yui" id="tableOne">
  <thead>
    <tr>
      <td colspan="4" align="right" class="tableHeader"><span class="rowElem"> </span>
        <table width="100%" border="0">
          <tr>
            <td width="61%"><a href="index.php" class="btn btn-warning">Agregar nuevo usuario</a></td>
            <td width="39%" align="right"><span class="rowElem">Buscar:
                <input id="filterBoxOne" value="" maxlength="30" size="30" type="text" />
            </span></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <th width="25%"><a href='#' title="Click para ordenar">Nombre</a></th>
      <th width="20%"><a href='#' title="Click para ordenar">Email</a></th>
      <th width="16%"><a href='#' title="Click para ordenar">Estado</a></th>
      <th width="20%"><a href='#' title="Click para ordenar">Acci&oacute;n</a></th>
</tr>
</thead>
<tbody>
    <?php for($i=0;$i<count($usuarios->dataQuery);$i++){ ?>
<tr>
  <td><?php print $usuarios->dataQuery[$i]->nombre;?></td>
  <td><?php print $usuarios->dataQuery[$i]->email;?></td>
  <td>Estado Actual: <?php if($usuarios->dataQuery[$i]->estado=='Activo'){?><img src="img/yes.png" width="16" height="16" border="0" /><?php }  if($usuarios->dataQuery[$i]->estado=='Inactivo'){?> <img src="img/cancel.png" width="16" height="16" border="0" /><?php } print $usuarios->dataQuery[$i]->estado;?></td>
  <td><a href="javascript:void(0);" onclick="redirect('editarUsuario.php?usuarioId=<?php echo $usuarios->dataQuery[$i]->id;?>');">
      <div id="vermas" name="vermas" type="button" class="formButton"><span><span><img src="img/edit.png" width="16" height="16" border="0" />Modificar Usuario</span></span></div></a><?php if($usuarios->dataQuery[$i]->estado=='Activo'){?><a href="#" onclick="changeStatus('<?php echo $usuarios->dataQuery[$i]->id; ?>','<?php echo $usuarios->dataQuery[$i]->estado; ?>');"><div id="vermas" name="vermas" type="button" class="formButton"><span><span><img src="img/cancel.png" width="16" height="16" border="0" />Desactivar</span></span></div></a><?php }  if($usuarios->dataQuery[$i]->estado=='Inactivo'){?> <a href="#" onclick="changeStatus('<?php echo $usuarios->dataQuery[$i]->id; ?>','<?php echo $usuarios->dataQuery[$i]->estado; ?>');"><div id="vermas" name="vermas" type="button" class="formButton"><span><span><img src="img/yes.png" width="16" height="16" border="0" />Activar</span></span></div></a><?php } ?>
      <a href="#" onclick="deleteRow('<?php echo $usuarios->dataQuery[$i]->id; ?>');">
      <div id="vermas" name="vermas" type="button" class="formButton"><span><span><img src="img/delete.png" width="16" height="16" border="0" />Borrar</span></span></div></a></td>
</tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr id="pagerOne">
      <td colspan="4"><img src="js/jQueryTableSorterConPaging/_assets/img/first.png" class="first"/> <img src="js/jQueryTableSorterConPaging/_assets/img/prev.png" class="prev"/>
        <input type="text" class="pagedisplay"/>
        <img src="js/jQueryTableSorterConPaging/_assets/img/next.png" class="next"/> <img src="js/jQueryTableSorterConPaging/_assets/img/last.png" class="last"/>
        <select name="select" class="pagesize">
          <option selected="selected"  value="10">10</option>
          <option value="20">20</option>
          <option value="30">30</option>
          <option  value="40">40</option>
        </select></td>
    </tr>
  </tfoot>
</table>
</div>
</div>   
</body>
</html>
