<?php include ('../intface/adm_topOuter.php'); 
//Variable to hold the no of records in which the display is splitted
?>
<script>
//Function to confirm user if he wants to delete the selected user(s) or not
function confirmDelete() {

    var found = 0;
    if (document.deletestd.choice.length != null) {

        for (i = 0; i < document.deletestd.choice.length; i++) {
            if (document.deletestd.choice[i].checked) {
                found = 1;
                break;
            }
        }

        if (found == 0) {
            alertify.alert("Please select user(s) to delete.");
            return false;
        }
    } else {

        if (document.deletestd.choice.checked) {
            found = 1;
            //break;
        }
        if (found == 0) {
            alertify.alert("Please select user(s) to delete.");
            return false;
        }
    }



    if (document.deletestd.choice.length != null) {
        for (i = 0; i < document.deletestd.choice.length; i++) {
            if (document.deletestd.choice[i].checked) {
                event.preventDefault(); // cancel submit
                alertify.confirm("Are you sure you want to delete the selected users?", function(e) {
                    if (e) {
                        alertify.success("You've clicked OK");
                        document.deletestd.submit();
                        return true;
                    } else {
                        alertify.error("You've clicked Cancel");
                        return false;

                    }
                });

            }
        }
    } else {
        if (document.deletestd.choice.checked) {
            event.preventDefault(); // cancel submit
            alertify.confirm("Are you sure you want to delete the selected users?", function(e) {
                if (e) {
                    alertify.success("You've clicked OK");
                    document.deletestd.submit();
                    return true;
                } else {
                    alertify.error("You've clicked Cancel");
                    return false;

                }
            });
        }
    }
}

checked = false;

function checkedAll(frm1) {
    var aa = document.getElementById('deletestd');
    if (checked == false) {
        checked = true
    } else {
        checked = false
    }
    for (var i = 0; i < aa.elements.length; i++) {
        aa.elements[i].checked = checked;
    }
}

function showLog() {
    var winWd = 830;
    var winHt = 580;
    var winLeft = (screen.width - winWd) / 2;
    var winTop = (screen.height - winHt) / 2;
    var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt +
        ',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
    var fpath = "userlog.php";
    var logwin = window.open(fpath, 'logwin', settings);
    logwin.focus();
}


//function to clear the input search fields
function clearFields() {
    document.search.uname.value = "";
    document.search.utype.value = "";
    document.location.href = 'userlist.php';
}
</script>

<?php

function mysql_escape_mimic($inp) {

    if(is_array($inp))
    return array_map(__METHOD__, $inp);
    if(!empty($inp) && is_string($inp)) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);

    }
    return $inp;
}

$pageSplit = 10;
if (isset($_POST['uname'])) {
    $uname = trim(mysql_escape_mimic(htmlspecialchars($_POST['uname'])));
    $utype = mysql_escape_mimic(htmlspecialchars($_POST['utype']));
} else {
    $uname = trim(mysql_escape_mimic(htmlspecialchars($_GET['uname'])));
    $utype = mysql_escape_mimic(htmlspecialchars($_GET['utype']));
}

if ($uname != "" || $utype != "") {
    $searchmsg = '1';
} else {
    $searchmsg = '0';
}

$ugroup = mysql_escape_mimic(htmlspecialchars($_REQUEST['ugroup']));

$totalpg = $_GET['totalpg'];

if (!isset($_GET['currpage'])) {
    $currpage = 0;
} else {
    $currpage = $_GET['currpage'];
}

$startRecord = ($currpage * $pageSplit);

include("usersrch.php");
$totalPages = ceil($totalnum / $pageSplit);



/* if($totalPages<$totalpg && !$num)
  {
  $currpage=$currpage-1;
  }
  echo "----";
  echo $currpage;
  echo "/";
  echo $totalPages;
  echo "----"; */

//Change the date format to dd/mm/yyyy
function dtFormat($date) {
    list($year, $month, $day) = split('[/.-]', $date);
    echo $day . "/" . $month . "/" . $year;
}

?>

<!-- mid section -->
<section class="panel panel-default  padder">
    <!-- breadcrumbs -->
    <section>
        <div class="panel-body nobot panelBg" style="margin-top:20px">
            <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Users</strong></span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 " style="margin-top:20px;">

            <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>

            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:20px;clear:both">
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?> <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <form name="search" action="userlist.php" method="post">
                    <div class="pull-right text-right searchbg" style="padding-left:10px">
                        <div class="search inline"> <span> Search by Name:&nbsp;
                                <input name="uname" class="input-sm form-control  searchbtn" placeholder="Search"
                                    type="text" id="uname" size="25" value="<?= htmlspecialchars($uname) ?>" maxlength="30">
                                User ID:&nbsp;
                                <input name="utype" class="input-sm form-control  searchbtn" type="text" id="utype"
                                    size="25" value="<?php echo htmlspecialchars($utype) ?>" maxlength="30">
                                <!--<i class="fa fa-search"></i>-->
                                <button type="submit" id='Go' title='Search users matching specified criteria' name="Go"
                                    class="btn btn-sm btn-blue searchButton">Search</button>
                                <input type='button' class='btn btn-sm btn-blue searchButton' id='showall'
                                    title='Show all users' value='&nbsp;Show all users&nbsp;' onclick='clearFields();'>
                            </span> <span class="text-right"> <a href="userlist.php"
                                    class="btn  btn-blue btn-reset">Refresh</a> </span> </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
    <div class="rightHead text-center ">
        <section class="col-md-12 col-sm-12">
            <div class="row m-l-none m-r-none bg-light lter">

                <div class="col-sm-4 col-md-4 padder-v  text-left"> <span class="pull-left m-r-sm  iconPadd"> </span>
                    <div class="clear" style="padding-top: 20px;"></div>
                    <a class="clear" href="#"> <span class="h3  m-t-xs"><strong>Total users</strong></span> <small
                            class="text-muted text-uc count">(
                            <? echo $totalnum ?>)
                        </small> </a>
                </div>
                <div class="col-sm-8 col-md-8 padder-v text-right">
                    <div class="clear" style="padding-top: 20px;"></div>

                    <a onFocus='this.blur()' class="btn btn-lg btn-default bdrRadius20"
                        onMouseOver='return showStatus();' href='../crtuser/userinfo.php' title='Create new user'>
                        <i class="fa fa-user"></i> New user
                    </a>&nbsp;&nbsp;&nbsp;
                    <a onFocus='this.blur()' class="btn btn-lg btn-default bdrRadius20"
                        onMouseOver='return showStatus();' href='bulkupload.php' title='Bulk Upload'>
                        <i class="fa fa-upload"></i> Bulk Upload
                    </a>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-lg btn-default bdrRadius20" onFocus='this.blur()'
                        onMouseOver='return showStatus();' href='#' onclick='showLog();' title='User activity log'>
                        <i class="fa fa-cog"></i> Activity log
                    </a>
                    <br><br>
                    <a class="btn btn-lg btn-default bdrRadius20 pt-1" onFocus='this.blur()' href='../crtuser/exportusers.php?export_type=email_for_marketing' title='User activity log'>
                        <i class="fa fa-file-excel"></i> Export Subscribers
                    </a>

                    <a class="btn btn-lg btn-default bdrRadius20 pt-1" onFocus='this.blur()'
                         href='../crtuser/exportusers.php?export_type=email_for_campaign' title='User activity log'>
                        <i class="fa fa-file-excel"></i> Export Non Subscribers
                    </a>
                </div>
            </div>
        </section>
    </div>

    <div style="clear"></div>

    <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post"
        style="margin:0px;">

        <section class="panel panel-default  theadHeight">
            <?php
    if ($perms == 1) {
        ?>
            <!--  <div class="text-right deleteDiv" style="padding-top:10px;apdding-bottom:10px">
                                <input type='submit'  class='btn'  id='deleteuser' title='Delete user' value='&nbsp;Delete&nbsp;' >
                            </div>-->
            <?
    }
    ?>
            <div class="panel row teacher-student-wrap theadHeight">
                <div class="promo" id="promo">
                    <table class="table m-b-none dataTable table-fixed">
                        <thead class="fixedHeader">
                            <tr>
                                <?php
                    if ($perms == 1 || $perms == 'user') {
                        ?>
                                <!--<th width="5%"><input type='checkbox' name='checkall' onclick='checkedAll(deletecourse);'></th>-->
                                <?
                        }
                        ?>
                                <th class="col-xs-1 text-center" style="padding-left: 0px;"><input type='checkbox'
                                        name='checkall' onclick='checkedAll(deletestd);'></th>
                                <th class="col-xs-3 text-left">Name</th>
                                <!--<th class="col-xs-2 text-left" >Client</th>-->
                                <th class="col-xs-3 text-left">User ID</th>
                                <th class="col-xs-3 text-center">Date enrolled</th>
                                <th class="col-xs-2 text-center">Status</th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>

        <section class="panel panel-default panelgridBg">
            <div class="panel row teacher-student-wrap">
                <!--Responsive grid table -->
                <div class="table-responsive promo courseGroup table-responsiveWindow" style=" padding-top: 5px; ">
                    <? 
if (empty($totalnum)) {
    ?>
                    <div class="noRecordeTable">
                        <?
    if ($searchmsg == '1') {
        echo "<h4>No results found! Search again.</h4>";
    } else {
        echo "<h4>Users not found!</h4>";
    }
    ?>
                    </div>
                    <?
//exit();
}
?>
                    <table class="table m-b-none dataTable table-fixed">

                        <?

//echo "<pre>";print_r($result);exit;
$i = 0;
while ($i < $num) {

    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    $rid = $row['id'];
    $fnm = $row['firstname'];
    $lnm = $row['lastname'];
    $uid = $row['username'];
    $ustype = $row['usertype'];
    $userRole = $row['usertype'];
    $userStatus = $row['userregistered'];
    $client = $row['client'];
	
    $countCourses = getUserCourses($uid);
 
    if ($client == "") {
        $clientName = "NA";
    } else {
       $clientName = getClientNameFromID($client);
		//echo "<pre>";print($clientName);exit;
    }

    if ($userStatus == '0') {
        $uStatus = "<font color='red'>Inactive</font>";
    } else {
        $uStatus = "<font color='green'>Active</font>";
    }

    
	$companyName = "SELECT A.company_name FROM tbl_company AS A, tbl_company_user AS B WHERE  A.id=B.company_id AND B.user_id='$rid'";
	$compResult = mysqli_query($con,$companyName);
	$companyNum=mysqli_num_rows($compResult);

	//$companyName = mysql_query("SELECT * FROM tbl_company AS A, tbl_company_user AS B WHERE  A.id=B.company_id AND B.user_id='$rid'");
   // $companyNum = mysql_numrows($companyName);
    if ($companyNum) {
        $comp_name = 'All';
    } else {
        if ($ustype == 1) {
            $comp_name = "All";
        } else {
            $comp_name = "None";
        }
    }

    if ($ustype == 1) {
        $ustype = "Administrator";
    }
    if ($ustype == 2) {
        $ustype = "Country Admin";
    } else {
        $ustype = "Learner";
    }

    if ($userRole == '1') {
        $userRole = "Administrator";
    }
    if ($userRole == '2') {
        $userRole = "Country Admin";
    }
    if ($userRole == '0') {
        $userRole = "Learner";
    }

    $dt = $row['DTENROLLED'];

    if ($i % 2 == 0)
        $bgc = "row1";
    else
        $bgc = "row2";
    ?>
                        <tr>
                            <?
                                if ($ustype == "Administrator" && $userid <> 'admin') {
                                    ?>
                            <td class="col-xs-1 text-center" style="padding-left: 1px;">
                                <? echo "<input type='checkbox' id='choice' name='choice[]' value='$rid' DISABLED>" ?>
                            </td>
                            <?
                                } else {
                                    ?>
                            <td class="col-xs-1 text-center" style="padding-left: 1px;">
                                <? echo "<input type='checkbox' id='choice' name='choice[]' value='$rid'>" ?>
                            </td>
                            <?
                                }
                                ?>
                            <td class="col-xs-3 text-left"><a class='listitems' onFocus='this.blur()'
                                    onMouseOver='return showStatus();' href="userdtls.php?uid=<?= $rid ?>"
                                    title="<?= ucfirst($fnm) . ' ' . ucfirst($lnm); ?>">
                                    <? echo TrimString(ucfirst($fnm) . " " . ucfirst($lnm)); ?>
                                </a></td>
                            <!--<td  class="col-xs-2 text-left"><? echo TrimStringSmall($clientName); ?></td>-->
                            <td class="col-xs-3 text-left">
                                <?php echo $uid; ?>
                            </td>
                            <!--<td class="content"><? echo $userRole; ?></td>-->
                            <td class="col-xs-3 text-center">
                                <? echo parseDate($dt); ?>
                            </td>
                            <td class="col-xs-2 text-center">
                                <? echo $uStatus; ?>
                            </td>
                        </tr>
                        <?
                                $i++;
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row-centered">
                        <div class="col-sm-12 col-xs-12 col-centered">
                            <div class="text-center">
                                <table width="100%" cellspacing="0" cellpadding="3">
                                    <tr height='5px'>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td align='center' class='contentBold'>
                                            <?
                            if ($currpage != 0) {
                                ?>
                                            <a onFocus='this.blur()' onMouseOver='return showStatus();'
                                                href="userlist.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=0"
                                                title="First page">First page</a>
                                            <?
                            }
                            ?>
                                            <?
                            if ($currpage != 0) {
                                ?>
                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();'
                                                href="userlist.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=<? echo $currpage - 1 ?>"
                                                title="Previous page">Previous page</a>
                                            <?
                            }
                            ?>
                                            <?
                            if ($totalPages > 1) {
                                $pagenum;
                                $temp = ceil(($currpage + 1) / 5);
                                $tempstart = 5 * ($temp - 1) + 1;
                                $tempend;

                                if ($tempstart + $pageSplit > $totalPages) {
                                    $tempend = $totalPages;
                                } else {
                                    $tempend = $tempstart + $pageSplit;
                                }

                                for ($j = $tempstart; $j <= $tempend; $j++) {
                                    if ($j == $currpage + 1) {
                                        $pagenum = "<font color='#666666'>" . $j . "</font>";
                                        ?>
                                            &nbsp;&nbsp;
                                            <? echo $pagenum ?>
                                            <?
        } else {
            $pagenum = $j;
            ?>
                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();'
                                                href="userlist.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=<? echo $j - 1 ?>"
                                                title="<?= $pagenum ?>">
                                                <? echo $pagenum ?>
                                            </a>
                                            <?
                                }
                                ?>
                                            <?
                            }
                        }
                        ?>
                                            <?
if ($currpage + 1 < $totalPages) {
    ?>
                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();'
                                                href="userlist.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=<? echo $currpage + 1 ?>"
                                                title="Next page">Next page</a>
                                            <?
}
?>
                                            <?
if ($currpage + 1 < $totalPages) {
    ?>
                                            &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();'
                                                href="userlist.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=<? echo $totalPages - 1 ?>"
                                                title="Last page">Last page</a>
                                            <?
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row end here -->
        </section>

    </form>
    <?php include ('../intface/footer.php');
                                            ?>