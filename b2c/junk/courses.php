
<? 
include ("../connect.php");
include('lock.php');



function getmessage($err){

if($err == 0){
$msg = 'Successfully Added..!!';
}else{
$msg = 'Some Error Occured';
}
return $msg;
}


$result_bundle = mysql_query("SELECT * FROM tbl_b2client_bundle where client_id=2") or die("1Failed Query of " . mysql_error());
$courses[] = '';
$i=0;

while($row = mysql_fetch_array($result_bundle)){
	$courses[$i] =  $row['bundle'];
	$i++;
}


?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>English-Edge | Admin</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
    <section class="hbox stretch">
    <!-- .aside -->
    <aside class="bg-dark aside-md" id="nav">        
      <section class="vbox">
        <header class="header dker navbar navbar-fixed-top-xs">
              <div class="navbar-header">
                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
                  <i class="fa fa-bars"></i>
                </a>
                <a href="#" class="navbar-brand" data-toggle="fullscreen">
                  <img src="images/logo.png" class="m-r-sm">
                  <span class="hidden-nav-xs">LiqVid</span>
                </a>
                <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
                  <i class="fa fa-cog"></i>
                </a>
              </div>
            </header>
            <section class="w-f scrollable">
              <!-- nav -->
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="7px" data-railOpacity="0.2">
                <div class="clearfix wrapper bg-primary nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-r-sm">
                        <img src="images/avatar.jpg">
                      </span>
                      <span class="hidden-nav-xs clear">
                        <strong>Admin</strong> <b class="caret caret-white"></b>
                        <span class="text-muted text-xs block">Administrator</span>
                      </a>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      <span class="arrow top hidden-nav-xs"></span>
                      <li>
                        <a href="#">Settings</a>
                      </li>
                      <li>
                        <a href="#">Profile</a>
                      </li>
                      <li>
                        <a href="#">
                          <span class="badge bg-danger pull-right">3</span>
                          Notifications
                        </a>
                      </li>
                      <li>
                        <a href="#">Help</a>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="logout.php" data-toggle="ajaxModal" >Logout</a>
                      </li>
                    </ul>
                  </div>
                </div>
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li >
                      <a href="admin.php"  >
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Home</span>
                      </a>
                    </li>
					<li >
                      <a href="courses.php"  >
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Courses</span>
                      </a>
                    </li>
                    
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
              <!-- / nav -->
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      John <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No contacts in your lists.</p>
                      <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              
            </footer>
      </section>
    </aside>
    <!-- /.aside -->
    <section id="content">
      <section class="vbox">
            <section>
              <section class="hbox stretch">
                <section>
                  <section class="vbox">
                    <header class="header bg-white b-b b-light">
                      <p>This is a header</p>
                    </header>
                    <section class="scrollable wrapper">
                      <p class="h4">Courses</p>
					  <br><br>
					 
					<?
						if(ISSET($_GET['err_code'])){
						if($_GET['err_code'] == 0){
						echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-ok-sign"></i><strong>Well done!</strong>&nbsp;&nbsp;&nbsp;Bundle Successfully Added</div>';
						}else{
						echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><i class="fa fa-ban-circle"></i><strong>Oh snap!</strong>&nbsp;&nbsp;&nbsp;Change a few things up and try submitting again.</div>';
				  		}
						}
					?>
				  
					<form data-validate="parsley" action = "buyCourse.php" method = "post">
					<table width = '50%'><tr><td>
					<div class="form-group">
                      <label class="col-sm-2 control-label">Bundle</label></td><td>
                      <div class="col-sm-10">
                        <select name="bundle" class="form-control m-b">
                          
						  <?
						  for($i=0;$i<sizeof($courses);$i++){
						  echo "<option value =$courses[$i]>$courses[$i]</option>";
						  }
						  ?>
                        </select>
                       
                      </div></td>
                    </div></tr>
					<tr><td>
					<div class="form-group">
                           <label class="col-sm-2 control-label">Email</label></td><td>
						  <div class="col-sm-10">
						  <input type="text" name = "email" class="form-control" data-type="email" data-required="true" style = "width:100%">
                          </div>
						  </div></td></tr><tr><td></td><td>
					    <div class="form-group">
						 <div class="col-lg-10">
						<button type="submit" class="btn btn-success btn-s-xs" style = "margin-top:15px">Submit</button>
						</div>
						</div>
						</td></tr>
						<tr><td>
						
						
						
						</td></tr>
						</table>
                        
					  </form>
					  
					  
					  
					 
                    </section>                    
                    <footer class="footer bg-white b-t b-light">
                      <p>This is a footer</p>
                    </footer>
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
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  
  <script src="js/parsley/parsley.min.js"></script>
<script src="js/parsley/parsley.extend.js"></script>
  
</body>
</html>