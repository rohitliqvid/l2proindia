
<? 
include ("../../../connect.php");
include('../helpers/lock.php');

?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>English-Edge | Admin</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../../css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../../css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../../css/font.css" type="text/css" />
    <link rel="stylesheet" href="../../css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
    <section class="hbox stretch">
	
    <!-- left panel starts -->
   <? include('left-panel.php'); ?>
    <!-- left-panel ends -->
	
    <section id="content">
      <section class="vbox">
            <section>
              <section class="hbox stretch">
                <section>
                  <section class="vbox">
				  
                     <!-- top panel starts -->
					<? include('top-panel.php'); ?>
					<!-- top panel ends -->
					
					<!-- main panel starts -->
					<? include('./meat/assignCourses-meat.php'); ?>
					<!-- main panel ends -->
					
					<!-- bottom panel starts -->
					<? include('bottom-panel.php'); ?>
					<!-- bottom panel ends -->
					
                  </section>
                </section>
                <aside class="bg-light lter b-l aside-md">

                </aside>
              </section>              
            </section>
          </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
  </section>
  <script src="../../js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../../js/app.js"></script>
  <script src="../../js/app.plugin.js"></script>
  <script src="../../js/slimscroll/jquery.slimscroll.min.js"></script>
  
</body>
</html>