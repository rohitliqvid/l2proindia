<?php include ('../intface/adm_top.php'); ?>

<title>Reply</title>
<?
$f_id=$_REQUEST['fid'];


$result = mysql_query ("SELECT * FROM tbl_feedback where Id=$f_id"); 

$num=mysql_numrows($result);

$F_SUBJECT=mysql_result($result,0,"F_SUBJECT");
$F_DESCRIPTION=mysql_result($result,0,"F_DESCRIPTION");
$F_BY=mysql_result($result,0,"F_BY");
$F_BY_ID=mysql_result($result,0,"F_BY_ID");
$F_DATE=mysql_result($result,0,"F_DATE");
$F_STATUS=mysql_result($result,0,"F_STATUS");


$query1="SELECT EMAIL FROM tbl_users where Id=\"".$F_BY_ID."\""; 
$result1 = mysql_db_query($database, $query1) or die("Failed Query of " . $query1);

$thisrow=mysql_fetch_row($result1);

if($thisrow)
{
	$TO_EMAIL=mysql_result($result1,0,"EMAIL");

}
else
{
echo "<span class='content'>This user account is already deleted!</span>&nbsp;&nbsp;<a href='javascript:self.close();' class='contentLink'>Close</a>";
exit();
}
//echo $TO_EMAIL;

?>

<script>
function setFocus()
{
document.getElementById("desc").focus();
}

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

function ValidateReplyInfo()	
	{ 	
	
		if(Trim(document.reply.subject.value)=="")
		{
			alert("Subject can not be empty!");
			document.reply.subject.value='';
			document.reply.subject.focus();
			return false;
		}
		if(Trim(document.reply.desc.value)=="")
		{
			alert("Message can not be empty!");
			document.reply.desc.value='';
			document.reply.desc.focus();
			return false;
		}
	}
</script>


<!-- breadcrumbs -->
<section class="panel panel-default text-sm doc-buttons">
  <div class="panel-body nobot panelBg">
		<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
		  <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Reply</strong></span> </div>
		 
		</div>
		<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
		<a onFocus='this.blur()' onMouseOver='return showStatus();' href="javascript:history.go(-1);" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a></div>
  </div>
  
  
</section>

  <section class="padder">
      <!-- ####### Show table Grid -->
 <form method="post" name="reply" action="reply_submit.php" onSubmit="return ValidateReplyInfo();" data-validate="parsley" autocomplete="off" enctype="multipart/form-data"  >
  <section class="scrollable padder">
     <div class="rightContent newcourse">
              
             

  <div class="row-centered">
  
       <div class="col-sm-12 col-xs-12"> 
	   
	   		 <div class="divider"></div>  
			 <div class="col-sm-12 col-xs-12 text-left">
				
				  <label class="control-label required" for="replyTo">Reply to:  <?=ucfirst($F_BY)?></label>
               
                </div>
				 <div class="divider"></div>
				 <div class="clear"></div>
				 <div class="col-sm-12 col-xs-12 text-left">
				
				  <label class="control-label required" for="replyTo">Subject:</label>
               <input type='text' class='form-control input-lg' id='subject' name='subject' value="Re: <?=ucfirst($F_SUBJECT)?>" />
                </div> <div class="divider"></div>
				 <div class="clear"></div>
				  <div class="col-sm-12 col-xs-12 text-left">
				
				  <label class="control-label required" for="userMsg">Message </label>
               
				 <label class="control-label required" for="userMsg">  (Maximum 1000 characters)</label>
                 <TEXTAREA onKeyDown="textCounter(this.form.description,this.form.remLen,1000);" onKeyUp="textCounter(this.form.description,this.form.remLen,1000);" NAME="desc" class='form-control input-lg textarea' id="desc" COLS=42 ROWS=6 maxlength="1000" style="height:100px" data-required="true"><?="\r\n\r\n\r\n-----------------------\r\n\r\n".$F_DESCRIPTION?></TEXTAREA>
				<label class="instructionlabel"></label>
                  <label class="required" id="userIdError"></label>
                <input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="1000">
              <input type='hidden' id='to_id' name='to_id' value='<?=$TO_EMAIL?>'>
                </div>
				  <div class="text-right">
			
			 <input type='button' class='btn btn-red'  id='close' title='Clear all fields to enter fresh information'  title="Close" name="close" value="Close" onClick="javascript:self.close();"/>
&nbsp;&nbsp;
				<button type="submit"  class=' btn btn-red'  id='submituser' title='Reply' title="Send reply" name="send"><i class="build fa fa fa-file-text-o"></i> Send reply</button>
          </div> <div class="divider"></div>    <div class="clear"></div>
	</div>
  </div>


</div>		
		
           </div>
			
      <!--end right  content bar -->
   
    

  <!--End Midlle container -->

</form>	

<?php
include ('../intface/footer.php');
?>

<!--Code to prevent the caching of page-->
<!--
<div class="col-lg-12 col-sm-12 col-md-12 ">
<body class='contentBG' topmargin="10" leftmargin="10" onload="setFocus();">

 <form method="post" name="reply" action="reply_submit.php" onSubmit="return ValidateReplyInfo();">

<table width="100%" border="0" cellpadding="3" cellspacing="0">
<tr bgcolor="#C5D3DC" height='25'><td class='contentBold'>Reply</td></tr>
<tr height='10'><td></td></tr>
<tr><td valign='top' width='100%' class='content'><span class='contentBold'>Reply to:</span> <?=ucfirst($F_BY)?></td><tr>
<tr><td class='contentBold'>Subject: <input type='text' class='inputcls' id='subject' name='subject' value="Re: <?=ucfirst($F_SUBJECT)?>" style="width:450px"></td></tr> 
<tr><td valign='top' width='100%' class='contentBold'>Message:</td><tr>
<tr><td valign='top' width='100%' class='content'><textarea name="desc" onKeyDown="textCounter(this.form.desc,this.form.remLen,2000);" onKeyUp="textCounter(this.form.desc,this.form.remLen,2000);" cols="10" class='inputcls' rows="11" wrap="VIRTUAL" style="width:500; vertical-align:top"><?="\r\n\r\n\r\n-----------------------\r\n\r\n".$F_DESCRIPTION?></textarea></td><tr>
<tr><td class='content' align='right'>(Maximum 1,000 characters) <input readonly style='visibility:hidden;border:0px' type=text name='remLen' size=2 maxlength=4 value="2000"></td></tr>
<tr><td align='center'><input type='hidden' id='to_id' name='to_id' value='<?=$TO_EMAIL?>'>&nbsp;</td></tr>
<tr><td align='center'>
<input type="submit" class='submit_button_normal' onMouseOver="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title="Send reply" name="send" value="Send reply">&nbsp;&nbsp;						
						<input type="button" class='submit_button_normal' onMouseOver="this.className='submit_button_over';" onmouseout ="this.className='submit_button_normal';" title="Close" name="close" value="Close" onClick="javascript:self.close();">
	
         </td></tr>
 </table>

</form>	-->				
