<!--footer-->

<div class="footer">
          <div class="container">
            <div class="row">
              <div id="footer-copyright" class="col-md-6"> </div>
              <!-- /span6 -->
              <div id="footer-terms" class="col-md-6"><a >Powered by LIQVID</a>. </div>
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
		
<div id="loaderDiv" class="loadBg">
    <div id="overlayBlur"></div>
    <div class="loadDiv">
        <img src="../../images/default.svg" class="loadImg text-center"/>
        <div class="loadText">Please wait<span>.</span><span>.</span><span>.</span>
        </div>
    </div>
</div>

 <?php
if (strpos($_SERVER['REQUEST_URI'], 'courses.php') !== false) {
?>
<script>
$("#custCourse").addClass('active');
$("#home").removeClass('active');
</script>
<?php
}elseif(strpos($_SERVER['REQUEST_URI'], 'feedback_submitted.php') !== false || strpos($_SERVER['REQUEST_URI'], 'feedback.php') !== false){
?>
<script>
$("#fb").addClass('active');
$("#home").removeClass('active');
</script>
<?php }else{
?>
<script>
$("#home").addClass('active');
</script>
<?php
}
?> 



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50000623-2', 'auto');
  ga('send', 'pageview');

</script>
</body></html>