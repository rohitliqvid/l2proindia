
<title>Users > New user</title>

<?
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
header("Location: ../");
exit();
}
?>



<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg paddingTOPBottom0">
		<div class="col-lg-3 col-md-3 col-sm-3 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users > New user </strong></span> </div>
		 
		</div>
		
		<div class="col-lg-9 col-sm-9 col-md-9 tablegrid">
      <div class="row">
	 
      

          <div class="col-sm-1"></div>
          <div class="pull-right text-right">
            <div class="search inline">
			
			 <span class="text-right"><a href='../userlist/userlist.php' class='btn ' title='Back'> Back </a> </span> 
			</div>
          </div>
     
      </div>
    </div>
		
  </div>
  
  
</section>
<section class="panel panel-default">
		   <div class="rightHead text-center">
		   <div class="stepBg">
                <p> New user created successfully with 
            the following information:</p>
              </div>
			  <section class="panel panel-default col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
				  <div class="col-sm-2 col-md-2 padder-v b-light"></div>
                
				  <div class="col-sm-6 col-md-6 padder-v b-light text-center">
                    
					<div class="clear" style="padding-top: 20px;"></div>
                   <a onFocus='this.blur()' class="btn btn-lg btn-default" onMouseOver='return showStatus();' href='userinfo.php' title='Create another user'><i class="fa fa-user"></i>  Create another user</a>
                  </div>
                </div>
              </section>
			  <section class="panel panel-default col-md-12 col-sm-12">
                <div class="row m-l-none m-r-none bg-light lter">
				  <div class="col-sm-2 col-md-2 padder-v b-light"></div>
                   <div class="col-sm-4 col-md-4 padder-v b-light text-left">
                    <span class="fa-stack fa-2x pull-left m-r-sm  iconPadd">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    </span>
					<div class="clear" style="padding-top: 20px;"></div>
                    <a class="clear" href="#">
                      <span class="h3  m-t-xs"><strong><?=ucfirst($uid) ?></strong></span>
                      <small class="text-muted text-uc">User ID</small>
                    </a>
                  </div>
				  <div class="col-sm-4 col-md-4 padder-v   b-l  b-light text-right">
                    <span class="fa-stack fa-2x m-r-sm  iconPadd">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-check fa-stack-1x text-white"></i>
                    </span>
				
                    <a class="clear pull-right " href="#" style="padding-top: 20px;">
                      <span class="h3  m-t-xs"><strong>Learner</strong></span>
                      <small class="text-muted text-uc">User Type</small>
                    </a>
					
                </div>
				</div>
              </section>
			  <div class="col-md-12 col-sm-12 buildcourse text-center marginBottom20" >
			
  

         
          
       
		
</div>
		   
			 </div>
			 
	
	<!--Responsive grid table -->

  <section class="panel panel-default  theadHeight">
			
			  <div class="panel row teacher-student-wrap theadHeight">
 
               <div class="promo" id="promo">
			 <!-- <table class="table m-b-none dataTable table-fixed" style="margin-bottom: 0px;">
                   <thead  class="fixedHeader">   
				   <tr>
<th class="col-xs-6 text-left">User ID:</th>
<th class="col-xs-6 text-center">User type:</th>

   
                      </tr>
                    </thead>
					
					</table>--></div></div>	
					
 </section> 


	
	
	 </section>

</section>

  <div class="scrollable padder userList" style="height: 180px;">&nbsp;</div>
  <section class="scrollable padder">

  <section class="panel panel-default panelgridBg">
    <div class="panel row teacher-student-wrap">
      <!--Responsive grid table -->
      <div class="table-responsive promo courseGroup table-responsiveTopPad40">



<!--<table class="table m-b-none dataTable">
<tr>

<td class="col-xs-6 text-left"></td>
<td class="col-xs-6 text-left">Learner</td>

</tr>


</table>-->
</div></div></section>

