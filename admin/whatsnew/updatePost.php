<?php include('../intface/adm_top.php'); ?>

<SCRIPT language="JavaScript" src="validate.js"></SCRIPT>



<?php
$uRowId = $_REQUEST['id'];
//echo "-->".$uRowId;
//function to display the correct date format
//echo "SELECT * FROM tbl_users where id='$uid'";




$query1 = "SELECT * FROM tbl_whatsnew_post where id=" . $uRowId . "";
$result = mysqli_query($con,$query1);
$totalnum=mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$userid=$row['userid'];
$title=$row['title'];
$orgdescription=$row['description'];
$description=str_replace("<br/>","\r\n",$orgdescription);
$uid=$row['id'];
$postStatus=$row['status'];

/*
$result = mysql_query("SELECT * FROM tbl_whatsnew_post where id=" . $uRowId . "");
$num = mysql_numrows($result);

$userid = mysql_result($result, 0, "id");
$title = mysql_result($result, 0, "title");

$orgdescription = mysql_result($result, 0, "description");
$description=str_replace("<br/>","\r\n",$orgdescription);
$uid = mysql_result($result, 0, "id");
$postStatus = mysql_result($result, 0, "status");
*/

?>
<!--Code to prevent the caching of page-->

<script type="text/javascript" language="javascript">
	var mailExists = 0;
	var http_request = false;
	var tempTxt;
	var varid;

	function makeRequest(url, txt, ids) {
		http_request = false;
		tempTxt = txt;
		varid = ids;
		if (window.XMLHttpRequest) { // Mozilla, Safari,...
			http_request = new XMLHttpRequest();
			if (http_request.overrideMimeType) {
				http_request.overrideMimeType('text/xml');
				// See note below about this line
			}
		} else if (window.ActiveXObject) { // IE
			try {
				http_request = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					http_request = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			}
		}

		if (!http_request) {
			alertify.alert('Giving up :( Cannot create an XMLHTTP instance');
			return false;
		}

		http_request.onreadystatechange = alertContents;
		http_request.open('GET', url, true);
		http_request.send(null);

	}

	function alertContents() {
		if (http_request.readyState == 4) {
			if (http_request.status == 200) {


				if (tempTxt == "check_list") {

					if (http_request.responseText == "1") {
						document.getElementById("isMail").innerHTML = "Email address already exists!";
						mailExists = 1;
					} else {
						document.getElementById("isMail").innerHTML = "";
						mailExists = 0;
					}
				}
			} else {
				alertify.alert('There was a problem with the request.');
			}
		}
	}


	function checkMail(val) {
		if (Trim(val) != "" && echeck(val) != false) {
			var usrid = document.getElementById('usid').value;
			makeRequest('../crtuser/combo.php?action=chkUserMail&usid=' + usrid + '&val=' + val, "check_list", val);
		} else {
			document.getElementById("isMail").innerHTML = "";
		}
	}
</script>
<section id="content" class="">
	<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg" />
		<div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
	</div>
	<section class="padder">
		<!-- breadcrumbs -->
		<section class="panel panel-default text-sm doc-buttons">
			<div class="panel-body nobot panelBg">
				<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
					<div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Edit post </strong></span> </div>

				</div>
				<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
					<a onFocus='this.blur()' onMouseOver='return showStatus();' href="index.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
				</div>

			</div>


		</section>
		<br>
		<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") { ?>

			<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:20px;clear:both">
				<div class="alert alert-success" role="alert">
					<?php echo $_SESSION['msg'];
					unset($_SESSION['msg']); ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		<?php } ?>
	</section>
	<!-- ####### Show table Grid -->



	<form action="updwhatsnewpost.php" method="post" data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

		<section class="scrollable padder  mTop">
			<div class="rightContent newcourse">

				<div class="stepBg">
					<p> Type the new details for this user in the relevant fields and click the Update button. To return to the Users page, click the Back link. To cancel all the details you have entered and return to the Users page, click the Cancel button.

					</p>
				</div>

				<div class="row-centered">
					<div class="col-sm-12 col-xs-12">
						<div class="divider"></div>

						<div class="col-sm-12 col-xs-12 text-left">

							<div class="divider"></div>
							<label class="control-label required" for="userId"> Title<span class="required">*</span></label>

							<input name="id" type="hidden" value="<?php echo $_GET['id']; ?>" />

							<input class='form-control input-lg' name="title" type="text" id="title" maxlength="50" data-required="true" data-minlength="[2]" data-maxlength="[65]" data-regexp="" data-regexp-message="Title should not be Empty." autocomplete="title" value="<?= ucfirst($title) ?>">

							<label class="instructionlabel">(Maximum 65 characters; No special or numeric characters)</label>
							<label class="required" id="userIdError"></label>


						</div>
						<div class="col-sm-12 col-xs-12 text-left">
							<div class="divider"></div>
							<label class="control-label required" for="description">Description<span class="required">*</span></label>

							<textarea class='form-control input-lg' name="description" type="text" id="description" data-required="true" data-minlength="[2]" autocomplete="description" data-regexp="" data-regexp-message="description should not be empty." rows="20" cols="50" onchange="checkText()" style="height:150px;white-space: pre-wrap;"><?php echo ucfirst($description); ?></textarea>
							
							<label class="required" id="userIdError"></label>
						</div>
						<div class="divider"></div>
						<div class="col-sm-12 col-xs-12 text-left">

							<label class="control-label required" for="userId">Status<span style="color:red">*</span></label>

							<select id='post' name='approved' class='form-control input-lg'>
								<option value='Approve' <? if ($postStatus == 'Approve') {
															echo 'selected';
														} else {
															echo '';
														} ?>>Published</option>
								<option value='Un-Approve' <? if ($postStatus == 'Un-Approve') {
																echo 'selected';
															} else {
																echo '';
															} ?>>Unpublished</option>
							</select>
							<label class="instructionlabel"></label>
							<label class="required" id="userIdError"></label>

						</div>
						<div class="divider"></div>




						<label class="instructionlabel"></label>
						<label class="required" id="userIdError"></label>


					</div>

					<div class="divider"></div>
					<div class="divider"></div>

					<div class="text-right">
						
						<input type="hidden" name="obj1" id="obj1" value="">
						<input type="hidden" name="uclient" value="5" />
						<input type='button' class='btn btn-red' id='reset' title='Cancel changes to user details and return to Users page' value='&nbsp;Cancel&nbsp;' onClick="javascript:history.go(-1);">&nbsp;&nbsp;
						<button type="submit" class=' btn btn-red' id='submituser' title='Replace old details with new'><i class="build fa fa fa-file-text-o"></i> Update</button><input type='hidden' name='uid' id='uid' value=<?= $uRowId ?>><input type='hidden' name='usernameid' id='usernameid' value=<?= $uid ?>>
					</div>

					
					<div class="col-sm-12 col-xs-12 col-centered">&nbsp;</div>
				</div>
			</div>
			</div>

		</section>
	</form>
	<?php
	include('../intface/footer.php');
	?>