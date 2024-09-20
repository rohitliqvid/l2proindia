<?
header("Last-Modified: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Expires: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("pragma: no-cache");
session_start();
if (!isset($_SESSION['sess_uid'])) 
{
echo "The session is expired. Please re-login!";
exit();
}
$from_page=$_REQUEST['from_page'];
set_time_limit(4800);

$currpage=trim($_GET['cp']);
$totalPages=trim($_GET['tp']);
?>
<?php include ('../intface/adm_top.php'); ?>

<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>
<script>

window.onload = function(){
	setPageTitle('Add a course');
}

</script>
<script>

 function Trim(s) 
{
  // Remove leading spaces and carriage returns
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }

  // Remove trailing spaces and carriage returns
  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}

function ValidateInfo()	
{ 	
	
	if(Trim(document.docInfo.file_n.value)=="")
	{
		alertify.alert("Please select a File!");
		document.docInfo.file_n.value='';
		document.docInfo.file_n.focus();
		return false;
	}
	if(document.docInfo.file_n.value!="")
	{
		var flag=check_file_type(document.docInfo.file_n.value,'1');
		
		//alert (flag);
		if (flag=='false')
		{
			alertify.alert("File Type mismatch. Please select a valid file type!");
			document.docInfo.file_n.focus();
			return false;
		}
	}

}

function check_file_type(filename,fileType)
{
	var arr;
	arr=filename.lastIndexOf(".");
	var varExt=filename.substring(arr+1,filename.length);
//	arr=filename.split(".");
//	var varExt=String(arr[1]);
	varExt=varExt.toLowerCase();

	switch(fileType)
	{
		
		case '1':
			if (varExt!='zip')
			{
				return 'false';
			}
			break;


	}
	return 'true';
}

</script>


	<script type="text/javascript" language="javascript">
	//////////////////////////////////AJAX//////////////////////////////
	

//////////////////////////////////AJAX//////////////////////////////

function showTypes(num)
{
	if(num=='1')

	{
	document.getElementById('sType').innerHTML="<span class='contentBold'>Supported File Types: </span> .zip";
	}
	else if(num=='2')

	{
	document.getElementById('sType').innerHTML="<span class='contentBold'>Supported File Types: </span> .zip";
	}
	else
	{
	document.getElementById('sType').innerHTML="";
	}
}
	
	</script>

<!-- mid section -->
		
<section id="content" class="rightside rightContenBg">
<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg"/>
  <div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
</div>
<section class="padder topMenuContent">
<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Country </strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
			<a onFocus='this.blur()' onMouseOver='return showStatus();' href="waiting_documents.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
			</div>
		
  </div>
  
  
</section>
</section>
    <!-- ####### Show table Grid -->

   
<form   name="docInfo" action="submit_upload_form.php?upload=yes" onSubmit="return ValidateInfo();" method="post"  data-validate="parsley" autocomplete="off" enctype="multipart/form-data">
	<input type="hidden" name="MAX_file_size" value="315000000" />
	<section class="scrollable padder mTop">
            <div class="rightContent newcourse">
              
              <div class="stepBg">
                <p> Select the file to upload. After the file is completely copied to the server, you will be redirected to the Add a course page where you can enter the details for this course.
                
                </p><p><b>Supported File Types:</b> .zip (Max Size: 50 MB)</p>
              </div>

  <div class="row-centered">
  
  
      <div class="col-sm-4 col-xs-4 col-centered vTop">
	   
				 <div class="divider"></div> 
				  <label class="control-label required" for="userId"> File: <span class="required">*</span></label>
                <input name="file_n" type="file" class='form-control input-lg' size="30" data-required="true">
				
					  	<label class="instructionlabel">(Maximum 50 MB)</label>
                  <label class="required" id="userIdError"></label>
                
              
                </div>
				    <div class="clear"></div>
		
</div>
</div>		
 </div>
			
      <!--end right  content bar -->
   
    <!--start save  -->
      <section class="hbox stretch"> 
      <section class="vbox">
        <section class="marginBottom">
          <div class="text-right">
    <input type='button' class='btn btn-red' name="cancle" value="Cancel" title='Cancel upload' value='&nbsp;Cancel&nbsp;' onClick="javascript:history.go(-1);" >&nbsp;&nbsp;
			
				<button type="submit"  name="upload" class=' btn btn-red'  id='submituser' title='Upload file'><i class="build fa fa upload"></i> Upload</button>
          </div>
        </section>
      </section>
      <!--end save  -->
    </section>


  <!--End Midlle container -->


 </form>
<?php
include ('../intface/footer.php');
?>
