<!DOCTYPE html>
<html style="font-size: 16px;" lang="es"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Kiosco Ya!">
    <meta name="description" content="">
    <title>Kiosco Ya!</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="login.css" media="screen">
    <meta name="generator" content="Nicepage 4.16.0, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Merriweather:300,300i,400,400i,700,700i,900,900i">
    
    
    
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
  <body>
  <?php
require_once 'DBconect.php';
session_start();

if(isset($_REQUEST['btn_login']))	
{
	$email		=$_REQUEST["txt_email"];	
	$contrasena	=$_REQUEST["txt_contrasena"];		
		
	if(empty($email)){						
		$errorMsg[]="Por favor ingrese Email";	
	}
	else if(empty($contrasena)){
		$errorMsg[]="Por favor ingrese contrasena";	
	}
	else if($email AND $contrasena)
	{
		try
		{
			$select_stmt=$db->prepare("SELECT email,contrasena FROM Cliente
										WHERE
										email=:uemail AND contrasena=:ucon "); 
			$select_stmt->bindParam(":uemail",$email);
			$select_stmt->bindParam(":ucon",$contrasena);
			$select_stmt->execute();	
					
			while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))	
			{
				$dbemail	=$row["email"];
				$dbcontrasena	=$row["contrasena"];
			}
			if($email!=null AND $contrasena!=null)	
			{
				if($select_stmt->rowCount()>0)
				{
					if($email==$dbemail and $contrasena==$dbcontrasena and $dbemail!="kiosco@gmail.com")
					{		
						header("refresh:3;tienda/index.php");	
		
					}
					else if($dbemail=="kiosco@gmail.com")
					{		
						header("refresh:3;tiendaadmin/index.php");	
		
					}
				}
					
				}
				else
				{
					$errorMsg[]="correo electrónico o contraseña o rol incorrectos";
				}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}		
	}
	else
	{
		$errorMsg[]="correo electrónico o contraseña o rol incorrectos";
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
					<strong><?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($loginMsg))
		{
		?>
			<div class="alert alert-success">
				<strong>ÉXITO ! <?php echo $loginMsg; ?></strong>
			</div>
        <?php
		}
		?> 


  </body>
  <body data-home-page="KioscoYa.html" data-home-page-title="Kiosco Ya!" class="u-body u-xl-mode" data-lang="es"><header class="u-clearfix u-header u-header" id="sec-4442"><div class="u-clearfix u-sheet u-sheet-1">
        <a class="u-image u-logo u-image-1" data-image-width="500" data-image-height="500">
          <img src="images/WhatsAppImage2022-08-12at11.58.08AM.jpeg" class="u-logo-image u-logo-image-1">
        </a>
        <h2 class="u-custom-font u-font-merriweather u-text u-text-palette-5-dark-2 u-text-1">Kiosco Ya!</h2>
      </div></header>
    <section class="u-align-center u-clearfix u-section-1" id="sec-2e37">
      <img class="u-image u-image-1" src="images/adf75b0a829e1ec2e4a6d231f15fe132d82d80957cdf82450bff936c07ccbce2460aadcc6ca199852d24182ea287de587516290f2dd1e512f8d559_1280.jpg" data-image-width="960" data-image-height="1280">
      <div class="u-align-center u-container-style u-group u-radius-50 u-shape-round u-white u-group-1">
        <div class="u-container-layout u-container-layout-1">
          <h3 class="u-custom-font u-font-montserrat u-text u-text-default u-text-1">Iniciar sesión</h3>
          <div class="u-form u-login-control u-white u-form-1">
           <form method="post" class="form-horizontal" class="u-clearfix u-form-custom-backend u-form-spacing-20 u-form-vertical u-inner-form" source="custom" name="form" style="padding: 30px;">
             <div class="form-group">
                <div class="u-form-group u-form-name u-align-center">
                  <label class="col-sm-6 text-left">Email</label>
                  <div class="col-sm-12">
                   <input type="text" name="txt_email" class="form-control" class="u-grey-5 u-input u-input-rectangle u-input-1" placeholder="Ingrese email" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="u-form-group u-form-password u-align-center">
                  <label class="col-sm-6 text-left">Contraseña</label>
                   <div class="col-sm-12">
                     <input type="password" name="txt_contrasena" class="form-control" class="u-grey-5 u-input u-input-rectangle u-input-2" placeholder="Ingrese contraseña" />
                   </div>
                </div>
              </div>
              <div class="form-group">
               <div class="col-sm-12">
                 <div class="u-align-center u-form-group u-form-submit">
                   <input type="submit" name="btn_login" class="btn btn-success btn-block" class="u-border-none u-btn u-btn-submit u-button-style u-palette-3-light-1 u-btn-1" value="Ingresar">
                 </div>
                </div>
             </div>
            </form>
          </div>
          <a href="registrar.php" class="u-border-active-palette-2-base u-border-hover-palette-1-base u-border-none u-btn u-button-style u-login-control u-login-create-account u-none u-text-grey-40 u-text-hover-palette-3-light-1 u-btn-3">¿No tienes una cuenta?</a>
        </div>
      </div>
    </section>
    <section class="u-clearfix u-section-2" id="sec-07b4">
      <div class="u-clearfix u-sheet u-sheet-1">
        <img class="u-image u-image-default u-image-1" src="images/47b0d763ae4bdaaebd4cf8c20e3b9d8bc576c8ec2f94d836d6da07c5dd128c835a2975061d414c290716354dc4b83a78171285e8265ea7599a983e_1280.jpg" alt="" data-image-width="1280" data-image-height="851">
        <h2 class="u-align-center u-text u-text-default u-text-1">Acerca de nosotros</h2>
        <p class="u-align-center u-text u-text-2"> Kiosco Ya! te permite reservar tu pedido antes del horario de recreo, para ahorrarte la fila y optimizar tu&nbsp;<br>tiempo de descanzo!<br>Pedí productos del Kiosco y del buffet antes del recreo!
        </p>
      </div>
    </section>
    <footer class="u-align-center u-clearfix u-footer u-palette-3-light-1 u-footer" id="sec-7d8a"><div class="u-align-left u-clearfix u-sheet u-sheet-1">
        <p class="u-large-text u-text u-text-default u-text-variant u-text-1">Contacto: 115151555</p>
        <p class="u-large-text u-text u-text-default u-text-variant u-text-2">Instagram: @buffetmurialdino</p>
        <p class="u-large-text u-text u-text-default u-text-variant u-text-3">Facebook: @buffet murialdino</p>
      </div></footer>
  
</body></html>