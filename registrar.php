<?php 
session_start();
$Idsesion = session_id();
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Kiosco Ya!">
    <meta name="description" content="">
    <title>Registrarse</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="Página-1.css" media="screen">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/WhatsAppImage2022-08-12at11.58.08AM.jpeg"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Página 1">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body u-xl-mode" data-lang="es">
	<header class="u-clearfix u-header u-sticky u-white u-header" id="sec-4442"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <a class="u-image u-logo u-image-1" data-image-width="500" data-image-height="500">
          <img src="images/WhatsAppImage2022-08-12at11.58.08AM.jpeg" class="u-logo-image u-logo-image-1">
        </a>
        <h2 class="u-custom-font u-font-merriweather u-text u-text-palette-5-dark-2 u-text-1">Kiosco Ya!</h2>
      </div></header>
	<?php

require_once "DBconect.php";

if(isset($_REQUEST['btn_register'])) 
{
	$nombre	= $_REQUEST['txt_nombre'];
	$apellido = $_REQUEST['txt_apellido'];
	$email		= $_REQUEST['txt_email'];		
	$curso		= $_REQUEST['txt_curso'];
	$telefono		= $_REQUEST['txt_telefono'];
	$modalidad		= $_REQUEST['txt_modalidad'];
	$contrasena	= $_REQUEST['txt_contrasena'];	
		
	if(empty($nombre)){
		$errorMsg[]="Ingrese su nombre";	
	}
	else if(empty($apellido)){
		$errorMsg[]="Ingrese su apellido";	
	}
	else if(empty($email)){
		$errorMsg[]="Ingrese su email";	
	}
	else if(empty($curso)){
		$errorMsg[]="Ingrese su curso";	
	}
	else if(empty($telefono)){
		$errorMsg[]="Ingrese su telefono";	
	}
	else if(empty($modalidad)){
		$errorMsg[]="Ingrese su modalidad";	
	}
	else if(empty($contrasena)){
		$errorMsg[]="Ingrese la contraseña";	
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorMsg[]="Ingrese email valido";	
	}
	else if(strlen($contrasena) < 6){
		$errorMsg[] = "contraseña minimo 6 caracteres";	
	}
	else 
	{	
		try
		{	
			$select_stmt=$db->prepare("SELECT telefono, email FROM Cliente 
										WHERE telefono=:utel OR email=:uemail"); 
			$select_stmt->bindParam(":utel",$telefono);   
			$select_stmt->bindParam(":uemail",$email);      
			$select_stmt->execute();
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	
			if($row["telefono"]==$telefono){
				$errorMsg[]="Este telefono ya esta registrado";	
			}
			else if($row["email"]==$email){
				$errorMsg[]="Este mail ya esta registrado";	
			}
			
			else if(!isset($errorMsg))
			{
				$insert_stmt=$db->prepare("INSERT INTO Cliente(Id_sesion, nombre,apellido,email,curso,telefono,modalidad,contrasena) VALUES(:ui,:unom,:uap,:uemail,:ucurso,:utel,:umod,:ucon)"); 		
				$insert_stmt->bindParam(":ui",$Idsesion);
				$insert_stmt->bindParam(":unom",$nombre);
				$insert_stmt->bindParam(":uap",$apellido);	
				$insert_stmt->bindParam(":uemail",$email);
				$insert_stmt->bindParam(":ucurso",$curso);	
				$insert_stmt->bindParam(":utel",$telefono); 
				$insert_stmt->bindParam(":umod",$modalidad); 		
				$insert_stmt->bindParam(":ucon",$contrasena);
				
				if($insert_stmt->execute())
				{
					$registerMsg="Registro exitoso: Esperar página de inicio de sesión"; 
					header("refresh:2;index.php"); 
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
		<?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong>INCORRECTO ! <?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($registerMsg))
		{
		?>
			<div class="alert alert-success">
				<strong>EXITO ! <?php echo $registerMsg; ?></strong>
			</div>
        <?php
		}
		?> 
<div class="login-form" align="center">  
<center><h2>Registrarse</h2></center>
<form method="post" class="form-horizontal">
    
<div class="form-group">
<label class="col-sm-9 text-left">Nombre</label>
<div class="col-sm-12">
<input type="text" name="txt_nombre" class="form-control" placeholder="Ingrese su nombre" />
</div>
</div>

<div class="form-group">
<label class="col-sm-9 text-left">Apellido</label>
<div class="col-sm-12">
<input type="text" name="txt_apellido" class="form-control" placeholder="Ingrese su apellido" />
</div>
</div>

<div class="form-group">
<label class="col-sm-9 text-left">Email</label>
<div class="col-sm-12">
<input type="text" name="txt_email" class="form-control" placeholder="Ingrese email" />
</div>
</div>

<div class="form-group">
<label class="col-sm-9 text-left">Curso</label>
<div class="col-sm-12">
<input type="text" name="txt_curso" class="form-control" placeholder="Ingrese su curso" />
</div>
</div>

<div class="form-group">
<label class="col-sm-9 text-left">Telefono</label>
<div class="col-sm-12">
<input type="text" name="txt_telefono" class="form-control" placeholder="Ingrese su telefono" />
</div>
</div>

<div class="form-group">
    <label class="col-sm-9 text-left">Seleccione modalidad</label>
    <div class="col-sm-12">
    <select class="form-control" name="txt_modalidad">
        <option value="" selected="selected"> - seleccione modalidad - </option>
        <option value="electronica">Electronica</option>
        <option value="multimedios">Multimedios</option>
		<option value="quimica">Quimica</option>
		<option value="infoa">Informatica A</option>
		<option value="infob">Informatica B</option>
		<option value="adoa">ADO A</option>
		<option value="adob">ADO B</option>
		<option value="notengo">No tengo modalidad</option>
    </select>
    </div>
</div>

<div class="form-group">
<label class="col-sm-9 text-left">Contraseña</label>
<div class="col-sm-12">
<input type="password" name="txt_contrasena" class="form-control" placeholder="Ingrese contrasena" />
</div>
</div>
    

<div class="form-group">
<div class="col-sm-12">
<input type="submit" name="btn_register" class="btn btn-primary btn-block" value="Registro">
<!--<a href="index.php" class="btn btn-danger">Cancel</a>-->
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
¿Tienes una cuenta? <a href="index.php"><p class="text-info" class="u-border-active-palette-2-base u-border-hover-palette-1-base u-btn u-button-style u-login-control u-login-forgot-password u-none u-text-grey-40 u-text-hover-palette-3-light-1 u-btn-2">Inicio de sesión</p></a>		
</div>
</div>
    
</form>
</div><!--Cierra div login-->
		</div>
		
	</div>
			
	</div>





    <footer class="u-align-center u-clearfix u-footer u-palette-3-light-1 u-footer" id="sec-7d8a"><div class="u-align-left u-clearfix u-sheet u-sheet-1">
        <p class="u-large-text u-text u-text-default u-text-variant u-text-1">Contacto: 115151555</p>
        <p class="u-large-text u-text u-text-default u-text-variant u-text-2">@Instagram</p>
        <p class="u-large-text u-text u-text-default u-text-variant u-text-3">@Facebook</p>
      </div></footer>
</body></html>