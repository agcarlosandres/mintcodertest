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
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/formulario.js"></script>    
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
        <h1><br />
        Crear usuario</h1>
        <small id="result"></small>
      </div>
  <form>
    <div class="clearfix">
        <label for="txtFoo">Nombre</label>
      <div class="input">
      	<input name="nombre" type="text" id="nombre" />
      </div>
    </div>
    <div class="clearfix">
        <label for="txtFoo">Contrase&ntilde;a</label>
      <div class="input">
      	<input name="pass1" type="password" id="pass1" />
      </div>
    </div>
    <div class="clearfix">
        <label for="txtFoo">Verificar contraseña</label>
      <div class="input">
      	<input name="pass2" type="password" id="pass2" onChange="validatePass();" />
      </div>
    </div>
    <div class="clearfix">
        <label for="txtFoo">Email</label>
      <div class="input">
      	<input name="email" type="text" id="email" />
      </div>
    </div>
    
  <div class="clearfix">
    <div class="input">
      <input name="Botón" type="button" class="btn btn-primary" onClick="validateGeneral();" value="Aceptar" />
      <a href="usuarios.php" class="btn btn-warning">Cargar el Listado</a>
    </div>
  </div>
  </form>
</div>
</div>   
</body>
</html>
