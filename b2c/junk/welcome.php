 
<? 
include ("../connect.php");
include('lock.php');

$static_url = $_SERVER['SERVER_NAME'] . '/online/student/catlist/b2client.php?token=';
$courses['name'] = array();

$date = date_create();
$todayDate = date_timestamp_get($date);


$curdate=date('Y-m-d');
$userip=$_SERVER['REMOTE_ADDR'];


$result4 = mysql_query("SELECT * FROM tbl_b2client where username = '$login_session'") or die("1Failed Query of " . mysql_error());
		$i=0;
		$flag = 0;
		while($row = mysql_fetch_array($result4)){
		
			if ($flag == 0){
			$username = $row['username'];
			mysql_query("INSERT INTO tbl_b2client_entry_log (username, user_ip, user_entry) VALUES ('$username', '$userip','$curdate')");
			$flag++;
			}
			
			$courses['token'][$i] = $row['token'];
				
			if($todayDate > strtotime($row['expiry_date'])){
			$courses['expiry'][$i] = 0;
			}else{
			$courses['expiry'][$i] = 1;
			}
			$cid = $row['course_id']; 
					
			$result5 = mysql_query("SELECT name FROM tls_scorm where course = '$cid'") or die("1Failed Query of " . mysql_error());
			$cResult = mysql_fetch_array($result5);
			$courses['name'][$i] = $cResult['name'];
			$i++;
			
		}
		
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>English-Edge</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
	
	<link rel="stylesheet" href="./assets/table.css" type="text/css" />
	
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
                      <a href="welcome.php"  >
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
if(sizeof($courses['name']) < 1){
echo "<h1 align = center>Invalid Link<h1>";
}else{
?>
<table class="bordered" align = "center">
    <thead>
	<tr>
        <th>Courses</th>
        <th>Link</th>
    </tr>
    </thead>
	<tbody>
	<?
for($i = 0 ; $i < sizeof($courses['name']) ; $i++){
echo "<tr><td>" . $courses['name'][$i] . "</td>";

if ($courses['expiry'][$i] == 1){
echo "<td><a href = javascript:launch_content('" .$courses['token'][$i] ."')>Click Here</a></td></tr>";
}else{
echo "<td>Course Expired</td></tr>";
}
}
}
?>
</tbody></table>
					  
					  
					  
					 
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
  
  <script>

function launch_content(token) 
{

var width = 1024;
var height = 768;

var w = width;
var h = height;
var winl = (screen.width-w)/2;
var wint = (screen.height-h)/2;
if (winl < 0) winl = 0;
if (wint < 0) wint = 0;
windowprops = "height="+h+",width="+w+",top="+ wint +",left="+ winl +",location=no,"+ "scrollbars=no,menubars=no,toolbars=no,resizable=no,status=no,directories=no";
path="../student/catlist/b2client.php?token="+token;
	var con_window=window.open(path,"win",windowprops);	
	con_window.focus();
}

</script>
  
</body>
</html>