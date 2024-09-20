
<?php include ('../intface/adm_topOuter.php'); 

//Variable to hold the no of records in which the display is splitted
?>
<script>

//Function to confirm user if he wants to delete the selected user(s) or not
    function confirmDelete()
    {

        var found = 0;
        if (document.deletestd.choice.length != null)
        {

            for (i = 0; i < document.deletestd.choice.length; i++)
            {
                if (document.deletestd.choice[i].checked)
                {
                    found = 1;
                    break;
                }
            }

            if (found == 0)
            {
                alertify.alert("Please select user(s) to delete.");
                return false;
            }
        } else
        {

            if (document.deletestd.choice.checked)
            {
                found = 1;
                //break;
            }
            if (found == 0)
            {
                alertify.alert("Please select user(s) to delete.");
                return false;
            }
        }



        if (document.deletestd.choice.length != null)
        {
            for (i = 0; i < document.deletestd.choice.length; i++)
            {
                if (document.deletestd.choice[i].checked)
                {
                    event.preventDefault(); // cancel submit
                    alertify.confirm("Are you sure you want to delete the selected users?", function (e) {
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
        } else
        {
            if (document.deletestd.choice.checked)
            {
                event.preventDefault(); // cancel submit
                alertify.confirm("Are you sure you want to delete the selected users?", function (e) {
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
        if (checked == false)
        {
            checked = true
        } else
        {
            checked = false
        }
        for (var i = 0; i < aa.elements.length; i++)
        {
            aa.elements[i].checked = checked;
        }
    }

    function showLog()
    {
        var winWd = 830;
        var winHt = 580;
        var winLeft = (screen.width - winWd) / 2;
        var winTop = (screen.height - winHt) / 2;
        var settings = 'left=' + winLeft + ',top=' + winTop + ',width=' + winWd + ',height=' + winHt + ',toolbar=no,menubar=no,resizable=no,statusbar=no,scrollbars=yes,location=no,directories=no';
        var fpath = "userlog.php";
        var logwin = window.open(fpath, 'logwin', settings);
        logwin.focus();
    }


//function to clear the input search fields
    function clearFields()
    {
        document.search.uname.value = "";
        document.search.utype.value = "";
        document.location.href = 'userlist.php';
    }


</script>

<?
$pageSplit = 10;
if (isset($_POST['uname'])) {
    $uname = trim($_POST['uname']);
    $utype = $_POST['utype'];
} else {
    $uname = trim($_GET['uname']);
    $utype = $_GET['utype'];
}

if ($uname != "" || $utype != "") {
    $searchmsg = '1';
} else {
    $searchmsg = '0';
}

$ugroup = $_REQUEST['ugroup'];

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
            <div class="panel-body nobot panelBg"  style="margin-top:20px">
                <div class="col-lg-12 col-md-12 col-sm-12 show-mon">
                    <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Feedback </strong></span> </div>
                </div>  
				</div>
				 <p> Your bug report / feedback has been sent to the Administrator. Click the Back link to report another bug or post another feedback. Click any of the links in the left panel to continue.
                
                </p>
             <div class="col-lg-12 col-sm-12 col-md-12 "  style="margin-top:20px;">
                    <div class="row">
                      
                            <div class="pull-right text-right searchbg" style="padding-left:10px">
                                <div class="search inline"> <span class="text-right">   <a onFocus='this.blur()' class="btn btn-lg btn-default bdrRadius20" onMouseOver='return showStatus();' href='feedback.php' title='Create another user'><i class="fa fa-question-circle icon"></i>  Back </a></span> </div>
                            </div>
                        
                    </div>
                </div>
          
        </section>
  
   <div style="clear"></div>
  		

  <?php include ('../intface/footer.php');
                                            ?>
