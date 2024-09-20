<?php
include "connect.php";
$con=createConnection();
require_once "./header/frontHeader.php";
?>
<style>
#loading {
    background-color: #3252cd;
    height: 100%;
    width: 100%;
    position: absolute;
    z-index: 999999;
    margin-top: 0px;
    top: 0px;
}

#loading-center {
    width: 100%;
    height: 100%;
    position: relative;
}

#loading-center-absolute {
    position: absolute;
    left: 50%;
    top: 50%;
    height: 200px;
    width: 200px;
    margin-top: -100px;
    margin-left: -100px;
    display: flex;
    justify-content: center;
    align-items: center;

}
.panel-body {
    color: #000;
    line-height:25px
}
@media only screen and (max-width:600px){
    #inner-row{
        display:flex;
        flex-wrap: wrap;
        flex-direction: column-reverse;
    }
    #whatsnew_twitterFeed{
        margin-right: 0px !important;
        margin-left: 0px !important;
        width:100%;
    }
}
.panel-title a i{
    color:#3252cd !important;
    font-weight: bold;
}

.panel-title a {
    display: block;
    font-size: 2rem;
    padding: 10px 4px;
    text-transform: capitalize;
} 
.twitter-timeline-rendered{
    display: none;
}
</style>

<!-- loading animation ends here -->
<div class="container-fluid" style="min-height:80vh;padding:0">
    <nav class="navbar navbar-default navbar-sticky navbar-scrollspy divinnav" data-minus-value-desktop="58"
        data-minus-value-mobile="55" data-speed="1000">
        <div class="container">
            <div class="navbar-header page-scroll " style="margin-top:0;padding:0">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#home" style="margin-top:0 !important;padding:0;display:flex">
                <img src="images/l2pro_welcome.png" style="height:56px; margin-top: 0;" class="logo" alt="">
                <img src="assets/images/logonew.png" style="height: 56px;margin-top: 0;max-width: 270px;" class="logo" alt="">
            </a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="navbar-menu" style="width: inherit;">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php#home">Home</a></li>
                    <li><a href="index.php#about">About L2PRO</a></li>
                    <li><a href="index.php#partners">Partners</a></li>
                    <li><a href="index.php#media">Media</a></li>
                    <li><a href="index.php#contactus">Contact us</a></li>
                    <li class=""><a href="index.php#mobileapp">Mobile App</a></li>
                    <li class="active scroll"><a href="whatsnew.php">What's New</a></li>
                    <!--<li ><a href="#team-section">Team</a></li>
                    <li class="scroll"><a href="#testimonial">Testimonial</a></li>
                    <li class="scroll"><a href="#blog">Blog</a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- End top area -->
    <div class="clearfix"></div>
    <!-- img background contaienr here -->
    <div class="container-fluid"
        style="background: url('./images/loginBg.jpg');background-size: cover;background-position: top left;background-repeat: no-repeat;min-height: 100%;height:auto;display: flex;align-items: center;padding:0;">
        <div class="row" style="height:100%;width: 100%;padding:0;margin:0;backdrop-filter: blur(20px);" id="inner-row">
            <!-- left column -->
            <div class="col-12 col-sm-12 col-md-6 mx-auto dart-headingstyle" id="whatsnew_twitterFeed" style="background-color: rgb(0 0 0 / 65%);
    min-height: 743px;    height: 100%; padding-top:46px;   max-height: 743px;  overflow-y: scroll;">
    <!--  -->
    <div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
             <p style="font-size: 30px; color: #fff; text-transform: uppercase;">
                Loading <i class="fa fa-twitter" aria-hidden="true"></i>
            </p>
        </div>
    </div>
</div>
    <!--  -->
                <a class="twitter-timeline dart-heading" id="tweeta" data-tweet-limit="4"></a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                <script>
                    $(document).ready(()=>{
                        $('#tweeta').attr('href','https://twitter.com/TwitterDev?ref_src=twsrc%5Etfw');
                        $.ajax({
                            url: 'https://platform.twitter.com/widgets.js',
                            dataType: "script",
                            cache:true,
                            success: function(){
                                $("#loading").delay(2000).fadeOut(500);
                                $(".twitter-timeline-rendered").css("display","block !important");
                            }
                            });
                    })
                </script>

            </div>
            <!-- right column -->
            <div class="col-12 col-sm-12 col-md-6 mx-auto dart-headingstyle" style="
       background-color: rgb(0 0 0 / 65%);padding: 0 30px;color: white;line-height: 2.5;backdrop-filter: blur(50px); max-height:743px;overflow:hidden;" id="whatsnew_rightColumn">
                <h2 style="margin:50px 0; color:white;font-weight:bold ">Latest From L2PRO INDIA</h2>
                <div style="height: 610px;overflow-y: scroll;" id="whatsnew_rightColumn_inner">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                       <!--  -->
                       <?php

$sql = "SELECT * FROM `tbl_whatsnew_post` WHERE `status` = 'Approve' ORDER BY id DESC;";
$result = $con->query($sql);
$counter=0;
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class='panel panel-default' id='<?php echo "pid_".$row['id'] ?>'>
      <div class='panel-heading' role='tab' id='<?php echo  "acc".$row['id']?>'>
          <h4 class='panel-title'>
              <a role='button' data-toggle='collapse' title=<?php echo '"'.$row['title'].'"'?> data-parent='#accordion' href='<?php echo  "#colaps".$row['id'] ?> '
                  aria-expanded='false' aria-controls='<?php echo "colaps".$row['id']?>'>
                  <i class='fa fa-newspaper-o' aria-hidden='true'></i> 
                  <?php echo strlen($row['title']) > 30 ? substr($row['title'],0,30)."..." : $row['title'];?>
                  <?php  //echo $row['title'];?>
              </a>
          </h4>
      </div> 
      <div id='colaps<?php echo $row['id']?>' class='panel-collapse collapse 
      <?php 
      if($counter==0){ echo 'in';}
      else{
        echo '';
      }
      ?>' role='tabpanel'
          aria-labelledby='acc<?php echo $row['id']?>'>
          <div class='panel-body'>
            <p style="text-align:right;margin:0;padding:0"> Published On: &nbsp; <?php echo date("d-m-Y", strtotime($row['date']));?> </p>  

             <? echo $row['description'] ?>
            
          </div>
      </div>
  </div>
 <?php 
 $counter++;
}

} else {
    echo "0 results";
}
?>
                       <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once './footer/frontFooter.php';
?>