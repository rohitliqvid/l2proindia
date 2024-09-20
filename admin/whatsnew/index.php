<?php include('../intface/adm_topOuter.php');

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
</script>

<?
$pageSplit = 10;
if (isset($_POST['id'])) {
    $uname = trim($_POST['id']);
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
include("postSearch.php");
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
function dtFormat($date)
{
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
                <div class="pull-left m-b-xs  coursetitle"> <span class="orange_heading"><strong>Posts</strong></span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 " style="margin-top:20px;">

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
           
        </div>

    </section>
    <div class="rightHead text-center ">
        <section class="col-md-12 col-sm-12">
            <div class="row m-l-none m-r-none bg-light lter">

                <div class="col-sm-4 col-md-4 padder-v  text-left"> <span class="pull-left m-r-sm  iconPadd"> </span>
                    <div class="clear" style="padding-top: 20px;"></div>
                    <a class="clear" href="#"> <span class="h3  m-t-xs"><strong>Total Post</strong></span> <small class="text-muted text-uc count">(
                            <? echo $totalnum ?>)
                        </small> </a>
                </div>
                <div class="col-sm-8 col-md-8 padder-v text-right">
                    <div class="clear" style="padding-top: 20px;"></div>

                    <a onFocus='this.blur()' class="btn btn-lg btn-default bdrRadius20" onMouseOver='return showStatus();' href='./insertPost.php' title='Create new post'>
                        <i class="fa fa-newspaper-o "></i> New Post
                    </a> 
                  
                    <br><br>
                    
                </div>
            </div>
        </section>
    </div>

    <div style="clear:both;"></div>

    <form name="deletestd" id="deletestd" onSubmit="return confirmDelete();" action="#" method="post" style="margin:0px;">

        <section class="panel panel-default  theadHeight">
          
            <div class="panel row teacher-student-wrap theadHeight">
                <div class="promo" id="promo">
                    <table class="table m-b-none dataTable table-fixed">
                        <thead class="fixedHeader">
                            <tr>
                                
                                <!-- <th class="col-xs-1 text-center" style="padding-left: 0px;"><input type='checkbox' name='checkall' onclick='checkedAll(deletestd);'></th> -->
                                
                                <th class="col-xs-5 text-left">Title</th>
                                <!--<th class="col-xs-2 text-left" >Client</th>-->
                                <!-- <th class="col-xs-2 text-left">Description</th> -->
                                <th class="col-xs-3 text-center">Date Published</th>
                                <th class="col-xs-2 text-center">Status</th>
                                <th class="col-xs-2 text-center">Edit</th>
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
                    if (!$totalnum) {
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
                            $rid = $row['id'];
                            $title = $row['title'];
                          
                            $postid = $row['id'];
                            $status = $row['status'];
                            $status = $row['status'];
                            $dt = $row['date'];
                           
                          ?>
                           <tr>
                             <!--   <td class="col-xs-1 text-center" style="padding-left: 1px;">
                                     <?php echo $i+1?>
                                    </td>-->
                                    <td class="col-xs-5 text-left"><a class='listitems' onFocus='this.blur()' onMouseOver='return showStatus();' href="./updatePost.php?id=<?php echo $row['id'];?>">
                                        <? echo ucfirst($title); ?>
                                    </a></td>
                                <!--<td  class="col-xs-2 text-left"><? echo TrimStringSmall($clientName); ?></td>-->
                                <!-- <td class="col-xs-2 text-left">
                                    <? //  echo substr($description, 0, 30)." ..."; ?>
                                    <?   //echo $description; ?>
                                </td> -->
                                <!--<td class="content"><? echo $userRole; ?></td>-->
                                <td class="col-xs-3 text-center">
                                    <? echo parseDate($dt); ?>
                                </td>
                                <td class="col-xs-2 text-center">
                                    <?php echo  $status=='Un-Approve'? '<span class="text-white" style="padding:5px 10px;background-color:red">Unpublished</span>': '<span class="text-white bg-success" style="padding:5px 10px;">Published</span>' ;?>
                                </td>
                                <td class="col-xs-2 text-center">
                                   <a href="./updatePost.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil"></i></a>
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
                                                <a onFocus='this.blur()' onMouseOver='return showStatus();' href="index.php?currpage=0" title="First page">First page</a>
                                            <?
                                            }
                                            ?>
                                            <?
                                            if ($currpage != 0) {
                                            ?>
                                                &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="index.php?currpage=<? echo $currpage - 1 ?>" title="Previous page">Previous page</a>
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
                                                        &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="index.php?currpage=<? echo $j - 1 ?>">
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
                                                &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="index.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=<? echo $currpage + 1 ?>" title="Next page">Next page</a>
                                            <?
                                            }
                                            ?>
                                            <?
                                            if ($currpage + 1 < $totalPages) {
                                            ?>
                                                &nbsp;&nbsp;<a onFocus='this.blur()' onMouseOver='return showStatus();' href="index.php?uname=<? echo $uname ?>&utype=<? echo $utype ?>&currpage=<? echo $totalPages - 1 ?>" title="Last page">Last page</a>
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
    <?php include('../intface/footer.php');
    ?>