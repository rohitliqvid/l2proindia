<?php
include("../include/config.inc.php");
include("../nocacheofpage.php");
include("../include/mylocal.inc");
include("../TrimString.php");
$scoid=$_REQUEST['scoid'];
$userid=$_REQUEST['userid'];
$clsId=$_REQUEST['clsId'];
$subjectId=$_REQUEST['subjectId'];
$cid=$_REQUEST['cid'];



function getUserName($id)
{
	global $db;
	$query="select * from auth_user_md5 where id=".$id;
	$db->query($query);

	if ($db->num_rows()>0)
	{
	$db->next_record();
	$f_name=$db->f("f_name");
	$m_name=$db->f("m_name");
	$l_name=$db->f("l_name");

	$tempName=$f_name;
	if($m_name!='')
	{
	$tempName=$tempName." ".$m_name;
	}
	$tempName=$tempName." ".$l_name;
	echo ucwords($tempName);
	}
	else
	{
	echo "Not Available";
	}

}

function getSubjectName($subjectId)
{
global $db;
$sql="select * from subjects where id=".$subjectId;
$db->query($sql);
	if ($db->num_rows()>0)
	{
	$db->next_record();
	$subject_name =	$db->f("sub_name");
	echo ucwords($subject_name);
	}
	else
	{
	echo "Not Available";
	}
}


function getClassName($classId)
{
global $db;
$sql = "select a.class_name as class, b.stream as stream, c.section_name as section from class_names a, stream b, class_sections c, classes d ";
$sql.= " where a.id=d.cls_name_id and b.id=d.cls_stream_id and c.id=d.cls_sec_id and d.id='" . $classId . "'";
$db->query($sql);
	if ($db->num_rows()>0)
	{
	$db->next_record();
	
	$strClassName=ucfirst($db->f('class'));
	if($db->f('section')!='NA')
	{
	$strClassName=$strClassName.' - '.ucfirst($db->f(section));
	}

	if($db->f('stream')!='General')
	{
	$strClassName = $strClassName.' ('.ucfirst($db->f(stream)).')'; 
	}
	echo ucfirst($strClassName);
	}
	else
	{
	echo "Not Available";
	}
}


function getChapterName($id)
{
global $db;
$query="select * from chapters where id=".$id;
$db->query($query);
	if ($db->num_rows()>0)
	{
	$db->next_record();
	$cTitle=$db->f("title");
	echo TrimStringLarge(ucfirst($cTitle));
	}
	else
	{
	echo "Not Available";
	}
}


///Get Data from scorm_sco table
function getTopicTitle($scoid)
{
	global $db;
	$sql="select * from tls_scorm_sco where id=".$scoid;
	$db->query($sql);
    if ($db->num_rows()>0)
	{
	$db->next_record();
	$scormid=$db->f('scorm');
	$scotitle=$db->f('title');
	echo TrimStringLarge(ucfirst($scotitle));		
	}
	else
	{
	echo "Not Available";
	}
}

//
function getProgressData($scoid,$userid)
{
	global $db;
	$sql="select * from tls_scorm_sco_tracking where scoid=".$scoid." and userid=".$userid;
	$db->query($sql);
    if ($db->num_rows()>0)
	{
	$db->next_record();
	for ($i=0;$i<$db->num_rows();$i++)
		{
			$scorm_sco_track[$i]['id']=$db->f('id');
			$scorm_sco_track[$i]['userid']=$db->f('userid');
			$scorm_sco_track[$i]['scormid']=$db->f('scormid');
			$scorm_sco_track[$i]['scoid']=$db->f('scoid');
			$scorm_sco_track[$i]['element']=$db->f('element');
			$scorm_sco_track[$i]['value']=$db->f('value');
			$scorm_sco_track[$i]['timemodified']=$db->f('timemodified');
			$db->next_record();
		}
	return $scorm_sco_track;
	}
	else
	{
	return false;
	}

}
$scorm_track_data=getProgressData($scoid,$userid);

function getCompletionStatus($scorm_data)
{

if($scorm_data)
{
for ($i=0;$i<count($scorm_data);$i++)
{
if ($scorm_data[$i]['element']=='cmi.core.lesson_status')
{
echo ucfirst($scorm_data[$i]['value']);
}
}
}
else
{
echo "Not Started";
}
}

function getScore($scorm_data)
{
if($scorm_data)
{
for ($i=0;$i<count($scorm_data);$i++)
{
if ($scorm_data[$i]['element']=='cmi.core.score.raw')
{
echo $scorm_data[$i]['value']."%";
}
}
}
else
{
echo "--";
}
}

function getElapsedTime($scorm_data)
{
if($scorm_data)
{
for ($i=0;$i<count($scorm_data);$i++)
{
if ($scorm_data[$i]['element']=='cmi.core.total_time')
{
$tempTime=$scorm_data[$i]['value'];
$tempTimeArr=explode('.',$tempTime);
echo $tempTimeArr[0];
}
}
}
else
{
echo "--";
}
}

?>
<HTML>
<HEAD>
<TITLE>Progress Report</TITLE>
<link href="<?echo APATH?>/menustyle.php" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</HEAD>
<BODY  class='bodycolor'>
<div id='box' name='box' style="position:absolute;width:380px;border:1pxalign:center;z-index:-1"></div>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
		<tr height="22">
		<td align="center" class="popuptop">Progress Report</td>
		</tr>
           		      <tr class="content"> 
                 		 <td valign="top">
               		         <table width="100%" border="0" cellspacing="0" cellpadding="3">
			 			 <tr><td height="20">&nbsp;</td></tr>
                          <tr class="content">
                             <td colspan="4"></td>
                           </tr>
                           <tr class="content">
                             <td width="31%"  valign="top" class="contnetTitle">Name</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td width="69%" valign="top" class="content"><?php getUserName($userid);?> </td>
                             
                           </tr>
                           <tr class="content">
                             <td valign="top" class="contnetTitle">Subject</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td valign="top"  class="content"><?php getSubjectName($subjectId)?> for <?php getClassName($clsId);?> </td>
                           </tr>
                           <tr class="content">
                             <td valign="top" class="contnetTitle">Chapter Title</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td valign="top" class="content"><?php  
					      echo getChapterName($cid); ?></td>
                           </tr>
						   <tr class="content">
                             <td valign="top" class="contnetTitle">Topic Title</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td valign="top" class="content"><?php getTopicTitle($scoid);?> </td>
                           </tr>
                           <tr class="content">
                             <td valign="top" class="contnetTitle">Completion Status</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td valign="top" class="content"><?php getCompletionStatus($scorm_track_data); ?></td>
							 </tr>
							 <tr class="content">
                             <td valign="top" class="contnetTitle">Score</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td valign="top" class="content"><?php getScore($scorm_track_data); ?></td>
							 </tr>
							 <tr class="content">
                             <td valign="top" class="contnetTitle">Time Elapsed</td>
							 <td width="5%"  valign="top" align='center' class="content">:</td>
                             <td valign="top" class="content"><?php getElapsedTime($scorm_track_data); ?></td>
							 </tr>
                             </table>
						</td>
               		 </tr>
	  </tr>			   

</table>   

</BODY>
</HTML>