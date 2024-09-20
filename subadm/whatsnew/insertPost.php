<?php include('../intface/adm_top.php'); ?>

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
						document.getElementById("isApproved").innerHTML = "";
						mailExists = 0;
					} else {
						document.getElementById("isApproved").innerHTML = "";
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
			makeRequest('combo.php?action=chkMail&val=' + val, "check_list", val);
		} else {
			document.getElementById("isApproved").innerHTML = "";
		}
	}

	function enableType() {
		window.location.href = window.location.href;
		//document.userInfo.ugroups.disabled=false;
	}
</script>


<!-- mid section -->
<section id="content" class="">
	<div id="loaderDiv" class="loadBg"><img src="../graphics/default.svg" class="loadImg" />
		<div class="loadText">Please Wait<span>.</span><span>.</span><span>.</span></div>
	</div>
	<section class="padder ">
		<!-- breadcrumbs -->
		<section class="panel panel-default text-sm doc-buttons">
			<div class="panel-body nobot panelBg" style="margin-top:20px">
				<div class="col-lg-5 col-md-5 col-sm-5 show-mon">
					<div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>New Post </strong></span> </div>

				</div>
				<div class="col-lg-7 col-sm-7 col-md-7 tablegrid">
					<a onFocus='this.blur()' href="./index.php" target="_self" title="Go back" class="btn pull-right m-b-xs">Back</a>
				</div>

			</div>


		</section>
		<br>
		<?php if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") { ?>

			<div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:20px;clear:both">
				<div <?php
						if ($_SESSION['msg'] == 'New Post created successfully.') { ?> class="alert alert-success" <?php
																									} else {
																										?> class="alert alert-danger" <?php
																									}
													?> role="alert">
					<?php echo $_SESSION['msg'];
					unset($_SESSION['msg']); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		<?php } ?>
	</section>
	<!-- ####### Show table Grid -->

	<!-- ####### Show table Grid -->

	<form  action="submit_post.php" method="post" data-validate="parsley" autocomplete="off" enctype="multipart/form-data">

		<section class="scrollable padder mTop">
			<div class="rightContent newcourse">

				<div class="stepBg">
					<p> Enter the new post information in the relevant fields and click the Submit button.<br /> To cancel all the details you have entered and type fresh information, click the Reset button. To return to the Users page,<br />click the Back link.

					</p>
				</div>

				<div class="divider"></div>
				<div class="row-centered" >
					<div class="col-sm-12 col-xs-12">

						<div class="col-sm-12 col-xs-12 text-left">

							<label class="control-label required" for="userId">Title<span class="required">*</span></label>

							<input class='form-control input-lg' name="title" type="text" id="title" maxlength="65" data-required="true" data-minlength="[2]" data-maxlength="[65]" data-regexp="" data-regexp-message="First name cannot be empty." autocomplete="title" value="<?php echo $_REQUEST['title']; ?>">

							<label class="instructionlabel">(Maximum 65 characters)</label>
							<label class="required" id="userIdError"></label>
						</div>
						
						
						<div class="col-sm-12 col-xs-12 text-left">

							<div class="divider"></div>
							<label class="control-label required" for="userId"> Description<span class="required">*</span></label>

							<textarea class='form-control input-lg' name="description" type="text" id="description" onKeyPress="javascript:editKeyBoard(this,keybAlphaNumeric)" data-required="true" data-minlength="[2]" autocomplete="last-name" data-regexp="" data-regexp-message="Description Cannot be Empty" style="height:100px;"></textarea>
							<label class="required" id="userIdError"></label>


						</div>
						<div class="col-sm-12 col-xs-12 text-left">

							<label class="control-label required" for="#approved">Status<span class="required">*</span></label>
							<select id="approved" name="status" class='form-control input-lg'>
								<option name="status" value="Approve">Publish</option>
								<option name="status" selected value="Un-Approve">Unpublish</option>
							</select>
							<label class="required" id='isApproved' name='isApproved'></label>

						</div>
						<div class="divider"></div>



						<input type="hidden" name="utype" value="User" />


						<!--start save  -->
						<div class="text-right">
							<!-- <a  class="btn btn-red confirModal" id="btnBack" href="dashboard.php"  data-confirm-title="Confirmation Message" data-confirm-message="Are you sure you want to leave this page?" > <i class="build fa fa-arrow-circle-left"></i> Back</a>
         -->
							<input type="hidden" name="obj1" id="obj1" value="">
							<input type='button' class='btn btn-red' id='reset' title='Clear all fields to enter fresh information' onclick='enableType();' value='&nbsp;&nbsp;Reset&nbsp;&nbsp;'>&nbsp;&nbsp;<input type="hidden" name="uclient" value="5" />

							<button type="submit" class=' btn btn-red' title='Submit bug / feedback details'><i class="build fa fa fa-file-text-o"></i> Save</button>
						</div>
						<!--end save  -->
						<div class="col-sm-4 col-xs-4 col-centered">&nbsp;</div>
					</div>
				</div>
			</div>
			<!--end right  content bar -->
			<!--End Midlle container -->

	</form>
	<?php
	include('../intface/footer.php');
	?>