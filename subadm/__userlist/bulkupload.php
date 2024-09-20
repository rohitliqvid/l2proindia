<?php include ('../intface/adm_top.php'); ?>
<?php
//mysql_query("delete from tbl_users_bulkstatus");
$con=createConnection();
$query = "delete from tbl_users_bulkstatus";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->close();
closeConnection($con);
?>

<script>
function chk1()
{
		if(stripSpaces(document.frmprofile.userfile.value)=="")
		{
			alert("Please select an input file in .xls format!");
			document.frmprofile.userfile.focus();
			return false;
		}

		if(document.frmprofile.userfile.value!="")
		{
		arr=document.frmprofile.userfile.value.lastIndexOf(".");
		var varExt=document.frmprofile.userfile.value.substring(arr+1,document.frmprofile.userfile.value.length);

		varExt=varExt.toLowerCase();
		//alert (flag);
			if (varExt!='xls')
			{
				alert("File Type mismatch. Please select an .xls file!");
				document.frmprofile.userfile.focus();
				return false;
			}
		}
}

function stripSpaces(theStr) {
  if (!theStr) theStr = "";  //ensure its not null
  theStr = theStr.replace(/^\s*/,""); //strip leading
  theStr = theStr.replace(/\s*$/,""); //strip trailing
  return theStr;
}
</script>

<!-- mid section -->
		
<section id="content">
<div id="loaderDiv" class="loadBg"><img src="images/saving.gif" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users > Bulk Upload </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="sample.xls" target="_blank" title="Download Sample File"  class="btn pull-right m-b-xs">Download Sample File</a>&nbsp;&nbsp;&nbsp;
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="userlist.php" target="_self" title="Go back"  class="btn pull-right m-b-xs">Back</a></div>
		
  </div>
  
  
</section>
<br>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
					
			   <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:20px;clear:both">
                  <div  <?php if($_SESSION['danger']=='No'){?>class="alert alert-success" <?php }else{?>class="alert alert-danger" <?php }?> role="alert">
				<?php echo $_SESSION['msg']; ?>  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
				</div>
                </div>  
				<?php 
				
				
				unset($_SESSION['danger']);
				unset($_SESSION['msg']);
				
				} ?>	

</section>
  
<form  action="bulkuploadsubmit.php" name="frmprofile" id="frmprofile" onSubmit="return chk1();" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
	<input type="hidden" name="MAX_file_size" value="315000000" />
	<section class="scrollable padder mTop">
            <div class="rightContent newcourse" style="min-height:400px">
              
              <div class="stepBg">
                <p> You can create multiple users in this section. To create multiple users, select the input file (xls) and click the Submit button.
                
                </p>
              </div>

  <div>
  
  
      <div class="col-sm-4 col-xs-4 text-left">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId">Select input file: <span class="required">*</span></label>
				<input type="file" name="userfile" id="userfile" class='form-control input-lg' data-required="true">
					  	<label class="instructionlabel">(Maximum 8 MB)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
		
		
		  <!--start save  -->
		   <div class="divider"></div> 
		   <div class="divider"></div> 
	 
	 <div class="col-sm-8 col-xs-8 text-left">
	   <div class="text-right"><!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
		  <input type='button' class='btn btn-red' name="cancle" value="Cancel" title='Cancel upload'onClick="javascript:history.go(-1);" >&nbsp;&nbsp;
			
			<input type="hidden" name="client_id" value="5" />
				<button type="submit"  name="upload" class=' btn btn-red'  id='submituser' title='Upload file'><i class="build fa fa upload"></i> Upload</button>
          </div>
        </div>
         <!--end save  -->
		
</div>
</div>		
 </div>
			
      <!--end right  content bar -->
   
   


  <!--End Midlle container -->

 </form>
<?php
include ('../intface/footer.php');
?>
