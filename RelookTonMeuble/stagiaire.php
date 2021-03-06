<?php session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Galerie d'images</title>
		<link rel="icon" type="image/png" href="img/logo.png" />
       	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		 <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		  <!-- Bootstrap 3.3.7 -->
		  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		  <!-- jvectormap -->
		  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		  <!-- AdminLTE Skins. Choose a skin from the css/skins
		       folder instead of downloading all of them to reduce the load. -->
		  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		  <link rel="stylesheet" href="css/perso_custom.css">


		  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		  <![endif]-->

		  <!-- Google Font -->
		  <link rel="stylesheet"
		        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include "menu.php"; ?>


  <!-- Content Wrapper. Contains page content -->
 		<div class="content-wrapper">
 			   <!-- Content Header (Page header) -->
 			<section class="content-header">
 			     <h1>
 			           Galerie d'images de <?php echo $_SESSION['login'];?>
 			     </h1>
 			     <ol class="breadcrumb">
 			       <li><a href="index.php"><i class="fa fa-home"></i> Accueil</a></li>
 			       <li class="active"><a href="#">Galerie d'images de <?php echo $_SESSION['login'];?></a></li>
 			     </ol>
		    </section>
			<!-- Main content -->
		    <section class="content">
				<input type="button" value="Déconnection" OnClick="window.location.href='logout.php'"/>
				<br />
				<br/>
				<br/>
				<br/>
				<center>
					<?php

						include'connection_bd.php';

					//structure de base de la requète
						$req="SELECT id_img,img, nom, description FROM images where auteur='".$_SESSION['login']."'";
						$reponse = $bdd->query($req);
					//affichage des images

	    				while($result = $reponse->fetch()) {

						$prompt='';
					//affiche les photos des meubles
						$prompt='
						<div>
							<img style="border:solid 5px Sienna;" src="'.$result['img'].'" alt="'.$result['nom'].'" title="'.$result['nom'].'" />
						<br/>
						<br/>
						<b><p>Description : '.$result["description"].'</p></b></div><br/>
						<br/>';
						$direction="window.location.href='detail.php?message=".$result["id_img"]."'";
						$direction2="window.location.href='efface.php?id=".$result["id_img"]."'";
						echo $prompt;
	   				}
	    			$reponse->closeCursor();
				?>
				</center>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.2.1
    </div>
    <strong>Copyright &copy; 2019 <a href="#">Relook' ton meuble</a>.</strong> Tous droits réservés.
  </footer>

  <!-- Control Sidebar -->

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>


<script type="text/javascript">
    $(".rating-box").show().css('left',$(".rating-n li").eq(0).offset().left);
    $(".rating-n").mouseenter(function() {
      $(".rating-box").show();
    }).mouseleave(function() {
      //$(".rating-box").hide();
    });
    $(".rating-n li").mouseenter(function() {
    var offset = $(this).offset();
      $(".rating-box").stop().animate({'left':offset.left});
      var index = $(this).index();
      $(".rating-preview").stop().animate({'margin-top':(index*50)*-1});
    });
    // Animation preview
    $('.rating-preview').delay(500).animate({
      'margin-top': -50
      }, 500, function() {
    $('.rating-preview').delay(500).animate({
      'margin-top': -100
      },500);
      });
    $('.rating-box').delay(500).animate({
      'left':"+=45"
      }, 500, function() {
    $('.rating-box').delay(500).animate({
      'left':"+=45"
      }, 500)
    });



</script>

	</body>
</html>
