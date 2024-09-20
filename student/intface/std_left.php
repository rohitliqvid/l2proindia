    <nav class="navbar navbar-dark navbar-expand-lg py-0">
               <a href="index.html" class="navbar-brand">
               <img src="../../assetsnewdesign/images/l2pro.png" alt="logo"> <img src="../../assetsnewdesign/images/logonew.png" alt="logo">
               </a>
               <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                  <div class="navbar-nav ms-auto mx-xl-auto p-0">
                     <a href="../intface/index.php" class="nav-item nav-link active text-secondary">Home</a>
                     <a href="../mydtls/mydtls.php" class="nav-item nav-link"> My Profile</a>
                     <a href="../catlist/courses.php" class="nav-item nav-link">Course</a>
                     <a href="../feedback/feedback.php" class="nav-item nav-link">Feedback</a>
                  </div>
               </div>
               <div class="dropdown my-n2">
                  <a class="btn btn-link d-inline-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="avatar avatar-sm avatar-status avatar-status-success me-3">
                  <img class="avatar-img" src="../../assetsnewdesign/images/mask-group@2x.png" alt="...">
                  </span>
                  <?php echo ucfirst($fname)?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                     <!-- <li> <a class="dropdown-item" href="#">Account</a></li> -->
                     <!-- <li><a class="dropdown-item" href="#">Change password</a></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li> -->
                     <li> <a class="dropdown-item" onclick="call_logout()" href="#">Sign out</a></li>
                  </ul>
               </div>
            </nav>
            <style>.parsley-error-list{color: red;}</style>
	<script>
function call_logout()
{
	if(confirm("Are you sure that you want to exit from LMS?"))
	{
		top.location="../../pages/helpers/logout.php";
	}
}
	</script>