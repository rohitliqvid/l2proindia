<!--footer-->

<div class="footer">
          <div class="container">
            <div class="row">
              <div id="footer-copyright" class="col-md-6"> </div>
              <!-- /span6 -->
              <div id="footer-terms" class="col-md-6"><a><!--Powered by LIQVID--></a>. </div>
              <!-- /.span6 -->
            </div>
            <!-- /row -->
          </div>
          <!-- /container -->
</div>
<!--end footer-->
	     </section>
    </section>
  </section>
</section>	
		
<!--<div id="loaderDivCommon" class="loadBg">
    <div id="overlayBlur"></div>
    <div class="loadDiv"> <img src="../graphics/default.svg" class="loadImg text-center"/>
        <div class="loadText">Please wait<span>.</span><span>.</span><span>.</span>
        </div>
    </div>
</div>-->

	
	<?php
if(strpos($_SERVER['REQUEST_URI'], 'client/client.php')!== false || strpos($_SERVER['REQUEST_URI'], 'client/create.php') !== false) {
?>
<script>
$("#clientActive").addClass('active');
$(".home_menu").removeClass('active');
</script>
<?php
}else if(strpos($_SERVER['REQUEST_URI'], 'userlist/userlist.php')!== false || strpos($_SERVER['REQUEST_URI'], 'userlist/userinfo.php') !== false || strpos($_SERVER['REQUEST_URI'], 'userlist/bulkupload.php') !== false || strpos($_SERVER['REQUEST_URI'], 'userlist/bulkusercrtd.php') !== false) {
?>
<script>
$("#usersActive").addClass('active');
$(".home_menu").removeClass('active');
</script>
<?php
}else if(strpos($_SERVER['REQUEST_URI'], 'catlist/waiting_documents.php')!== false || strpos($_SERVER['REQUEST_URI'], 'catlist/upload_form.php') !== false || strpos($_SERVER['REQUEST_URI'], 'catlist/courses.php') !== false) {
?>
<script>
$(".courses_menu").addClass('active');
$(".home_menu").removeClass('active');
</script>
<?php
}else if(strpos($_SERVER['REQUEST_URI'], 'reports/index.php')!== false)  {
?>
<script>
$("#reportsActive").addClass('active');
$(".home_menu").removeClass('active');
</script>
<?php
}else if(strpos($_SERVER['REQUEST_URI'], 'feedback/feedback.php')!== false || strpos($_SERVER['REQUEST_URI'], 'feedback/feedback_report.php') !== false || strpos($_SERVER['REQUEST_URI'], 'feedback/feedback_submitted.php') !== false)  {
?>
<script>
$(".feedback_menu").addClass('active');
$(".home_menu").removeClass('active');
</script>
<?php
}else if((strpos($_SERVER['REQUEST_URI'], 'mydtls/mydtls.php')!== false) || (strpos($_SERVER['REQUEST_URI'], 'mydtls/chgpwd.php')!== false) || (strpos($_SERVER['REQUEST_URI'], 'mydtls/modify.php')!== false) || (strpos($_SERVER['REQUEST_URI'], 'mydtls/chgmsg.php')!== false))  {
?>
<script>
$(".my_details_menu").addClass('active');
$(".home_menu").removeClass('active');
</script>
<?php
}else{
?>
<script>
$(".home_menu").addClass('active');
</script>
<?php
}
?> 
</body></html>