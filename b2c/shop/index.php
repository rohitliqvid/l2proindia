<?php
require './util.php';
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title>EnglishEdge Shop</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="./assests/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="./assests/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="./assests/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="./assests/css/font.css" type="text/css" />
  <link rel="stylesheet" href="./assests/css/landing.css" type="text/css" />
  <link rel="stylesheet" href="./assests/css/app.css" type="text/css" />
  <!--[if lt IE 9]>
    <script src="./assests/js/ie/html5shiv.js"></script>
    <script src="./assests/js/ie/respond.min.js"></script>
    <script src="./assests/js/ie/excanvas.js"></script>
  <![endif]-->
  
  <style>
	.showClass{
		display : block;
	}
	.hideClass{
		display : none;
	}
  </style>

<script>

function setText(text){
	document.getElementById("detailText").innerHTML = text;
}

function showHideButton(div , what){

document.getElementById(div).className = what;

	
}

</script>  
  
</head>
<body onresize="setGround()" onload="setGround();">
  	
  <!-- header -->
  <? //include('top.php'); ?>
  <!-- / header -->
	<section id="content">
	  <div class="bg-dark lt">
      
    </div>
    
    <div class="container">
     	 
      <div class="clearfix">
        <div class="row m-b-xl">
          
          <div class="col-sm-4 animated fadeInUp" style="width:100%;margin-top:20px;">
            <section class="panel b-primary ">
              <header class="panel-heading bg-primary">
                <h3 class="m-t-sm text-center">EnglishEdge Shop</h3>
               
              </header>
              <ul class="list-group">
                <li class="list-group-item bg-light lt">
                  <div class="padder-v">
                   
				   <div class="slimScrollDiv" id = "slimScrollDiv1" style="position: relative; overflow: hidden; width: auto;">
				  
				 <div class="orange_heading"></div>
								 
				 <div class="text-center m-b-lg">
				 <!--
          <h1 class="h text-white animated fadeInDownBig">HIE</h1> -->
        </div>
					<p class = "text-center" style="font-size:16px;margin-top:10px;">
		
					<div id = 'loadingDivImg' class="text-center" style = "display:block;">
					<!--
					<img id  = "loadingDivImgg" src = 'assests/images/loading.gif' height = '150px'> 
					-->
					<br>
					<span id = 'detailText' style="font-size:16px;margin-top:10px;"></div>
					
					<div class="text-center">
					<form method="post" action="./payment/Checkout.php">
					<input type="text" name="Redirect_Url" value="http://learn.englishedge.in/b2c/shop/payment/redirecturl.php" hidden>
					<INPUT id = "buttonHolder" class="btn btn-s-md btn-default disabled" TYPE="submit" value="Make Payment">
					</form>
					</div>
					</div>
					
					 </p>
				   </div>
				   
                  </div>
                </li>
                
              </ul>
             
			 
            
            </section>
			
			<!-- footer starts-->
			 <? //include('footer.php'); ?>
			 <!-- footer ends-->
			 
          </div>
         
        </div>
      </div>  
	  
    </div>
   
	</section>
  
  <?php
  session_start();
if (isset($_POST['fromGateWay']))
	{
	$status = $_POST['payment_status'];
	$order_id = $_POST['payment_status_order_id'];
	if ($status == 1)
		{
		$re->order_num = $order_id;
		$cobj = new BasicObject('','buyclass',$re);
		$res2 = $cobj->sendToServer();
		print_r($res2);
		if ($res2->retCode == 'SUCCESS')
			{
				echo "<script> setText('Successfull. Please close the browser and return to app.'); </script>";
			}else{
				echo "<script> setText('Some error occured. Please contact English-Edge'); </script>";
			}
		}else{
			echo "<script> setText('Payment Not SuccessFull.'); </script>";
		}
	  
	}
  else
	{
	
	
	$obj = $_REQUEST['obj'];
	$obj = urldecode($obj);
	$obj = rc4("p1^bil",$obj);
	
	$obj = json_decode($obj);
		
	$token = $obj->token;
	$class = $obj->edge_id;
	
	/*
	$lgparams = new LoginParams('learner26961', '123456');
	$bobj = new BasicObject(null, 'login', $lgparams);
	$res = $bobj->sendToServer();
	$token = $res->retVal->token;
	$class = 15938;
	*/

	if ($token != '' || $class != '')
		{
		$mkorderreq->edge_id = $class;
		$mkorderreq->order_prefix="abr";
		$bobj = new BasicObject($token,'mkclassorder',$mkorderreq);
		$res2 = $bobj->sendToServer();
		print_r($res2);
		if ($res2->retCode == 'SUCCESS')
			{
			$order_num = $res2->retVal->order_num;
			$amount = $res2->retVal->amount;
			$_SESSION['order_num'] = $order_num;
			$_SESSION['amount'] = $amount;
			echo "<script> setText('Please click Buy button.'); </script>";
			echo "<script> showHideButton('buttonHolder' , 'btn btn-s-md btn-info'); </script>";
			echo "<script> showHideButton('loadingDivImgg' , 'hideClass'); </script>";
			}
		  else
			{
			echo "<script> setText('Invalid Token'); </script>";
			echo "<script> showHideButton('buttonHolder' , 'btn btn-s-md btn-default disabled'); </script>";
			echo "<script> showHideButton('loadingDivImgg' , 'hideClass'); </script>";
			}
		}
	  else
		{
		echo "<script> setText('Invalid Link'); </script>";
		}
	}
 
  
  ?>
  
  
  <!-- header -->
 
  <!-- / header -->
  <!-- / footer -->  <script src="./assests/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="./assests/js/bootstrap.js"></script>
  <!-- App -->
  <script src="./assests/js/app.js"></script>
  <script src="./assests/js/app.plugin.js"></script>
  <script src="./assests/js/slimscroll/jquery.slimscroll.min.js"></script>
  
  <script src="./assests/js/appear/jquery.appear.js"></script>
  <script src="./assests/js/scroll/smoothscroll.js"></script>
  <script src="./assests/js/landing.js"></script>
<script>
  function confirmCancel(){
  
  var r=confirm("Are you sure you you want to quit English Edge Setup");
if (r==true) {
   top.open('','_self',''); top.close();
} else {
   
}
  }
  </script>
</body>
</html>