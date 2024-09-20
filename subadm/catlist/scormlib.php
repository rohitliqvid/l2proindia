<?php
/*require_once("../include/config.inc.php");
page_open(array("sess" => "Example_Session", "auth" => "Example_Challenge_Crypt_Auth", "perm" => "Example_Perm"));
$user=$auth->auth["uname"];
$uid=$auth->auth["uid"];*/

function scorm_parse($pkgdir,$pkgtype,$scormid,$courseId)
{
if ($pkgtype == 'SCORM') 
	{
	if (file_exists($pkgdir.'/imsmanifest.xml'))
		{
        delete_records('tls_scorm_sco','scorm',$scormid);
	    delete_records('tls_scorm_sco_tracking','scormid',$scormid);
		return scorm_parse_scorm($pkgdir.'/imsmanifest.xml',$scormid);
		}
	else
		{
		cleanBadUpload($scormid,$courseId);
		header("Location:upload_error.php?errtype=1");
		exit;
		}
    }
}

function cleanBadUpload($scormid,$courseId)
{
delete_records('tls_scorm','id',$scormid);
//delete_chapter($courseId);
}

function scorm_add_instance($scrCourseId,$scrName,$scrSummary,$scrFileName,$width,$height) {

	$pkgtype='SCORM';
	$pkgDir="../../courses/".$scrCourseId;
	$version='SCORM_1.2';
	$maxgrade=100;
	$grademethod=1;
	$launch=0;
	$browsemode=0;
	$auto=0;
	$width=$width;
	$height=$height;
	///update tls_scorm table - add the scorm instance
	$sql="insert into tls_scorm (`course`,`name`,`reference`,`version`,`maxgrade`,`grademethod`,`launch`,`summary`,`browsemode`,`auto`,`width`,`height`) VALUES ('".$scrCourseId."','".$scrName."','".$scrFileName."','".$version."','".$maxgrade."','".$grademethod."','".$launch."','".$scrSummary."','".$browsemode."','".$auto."','".$width."','".$height."')";
	mysql_query($sql);
	//$db->query($sql);
	$scrId=mysql_insert_id();
	$parseResult=scorm_parse($pkgDir,$pkgtype,$scrId,$scrCourseId);

}

function scorm_delete_instance($id) {

/// Given an ID of an instance of this module,
/// this function will permanently delete the instance
/// and any data that depends on it.

    ////require('../config.php');

    if (! $scorm = get_record('scorm', 'id', $id)) {
        return false;
    }

    $result = true;

    # Delete any dependent files #
    scorm_delete_files($CFG->dataroot.'/'.$scorm->course.'/moddata/scorm/'.$scorm->id);

    # Delete any dependent records here #
    if (! delete_records('scorm_scoes_track', 'scormid', $scorm->id)) {
        $result = false;
    }
    if (! delete_records('scorm_scoes', 'scorm', $scorm->id)) {
        $result = false;
    }
    if (! delete_records('scorm', 'id', $scorm->id)) {
        $result = false;
    }

    return $result;
}


function scorm_get_resources($blocks) {
    foreach ($blocks as $block) {
        if ($block['name'] == 'RESOURCES') {
            foreach ($block['children'] as $resource) {
                if ($resource['name'] == 'RESOURCE') {
                    $resources[addslashes($resource['attrs']['IDENTIFIER'])] = $resource['attrs'];
                }
            }
        }
    }
    return $resources;
}

function scorm_get_manifest($blocks,$scoes) {
    static $parents = array();
    static $resources;

    static $manifest;
    static $organization;

    if (count($blocks) > 0) {
        foreach ($blocks as $block) {
            switch ($block['name']) {
                case 'METADATA':
                    if (isset($block['children'])) {
                        foreach ($block['children'] as $metadata) {
                            if ($metadata['name'] == 'SCHEMAVERSION') {
                                if (empty($scoes->version)) {
                                    if (preg_match("/^(1\.2)$|^(CAM )?(1\.3)$/",$metadata['tagData'],$matches)) {
                                        $scoes->version = 'SCORM_'.$matches[count($matches)-1];
                                    } else {
                                        $scoes->version = 'SCORM_1.2';
                                    }
                                }
                            }
                        }
                    }
                break;
                case 'MANIFEST':
                    $manifest = addslashes($block['attrs']['IDENTIFIER']);
                    $organization = '';
                    $resources = array();
                    $resources = scorm_get_resources($block['children']);
                    $scoes = scorm_get_manifest($block['children'],$scoes);
                    if (count($scoes->elements) <= 0) {
                        foreach ($resources as $item => $resource) {
                            if (!empty($resource['HREF'])) {
                                $sco = new stdClass();
                                $sco->identifier = $item;
                                $sco->title = $item;
                                $sco->parent = '/';
                                $sco->launch = addslashes($resource['HREF']);
                                $sco->scormtype = addslashes($resource['ADLCP:SCORMTYPE']);
                                $scoes->elements[$manifest][$organization][$item] = $sco;
                            }
                        }
                    }
                break;
                case 'ORGANIZATIONS':
                    if (!isset($scoes->defaultorg)) {
                        $scoes->defaultorg = addslashes($block['attrs']['DEFAULT']);
                    }
                    $scoes = scorm_get_manifest($block['children'],$scoes);
                break;
                case 'ORGANIZATION':
                    $identifier = addslashes($block['attrs']['IDENTIFIER']);
                    $organization = '';
                    $scoes->elements[$manifest][$organization][$identifier]->identifier = $identifier;
                    $scoes->elements[$manifest][$organization][$identifier]->parent = '/';
                    $scoes->elements[$manifest][$organization][$identifier]->launch = '';
                    $scoes->elements[$manifest][$organization][$identifier]->scormtype = '';

                    $parents = array();
                    $parent = new stdClass();
                    $parent->identifier = $identifier;
                    $parent->organization = $organization;
                    array_push($parents, $parent);
                    $organization = $identifier;

                    $scoes = scorm_get_manifest($block['children'],$scoes);
                    
                    array_pop($parents);
                break;
                case 'ITEM':
                    $parent = array_pop($parents);
                    array_push($parents, $parent);
                    
                    $identifier = addslashes($block['attrs']['IDENTIFIER']);
                    $scoes->elements[$manifest][$organization][$identifier]->identifier = $identifier;
                    $scoes->elements[$manifest][$organization][$identifier]->parent = $parent->identifier;
                    if (!isset($block['attrs']['ISVISIBLE'])) {
                        $block['attrs']['ISVISIBLE'] = 'true';
                    }
                    $scoes->elements[$manifest][$organization][$identifier]->isvisible = addslashes($block['attrs']['ISVISIBLE']);
                    if (!isset($block['attrs']['PARAMETERS'])) {
                        $block['attrs']['PARAMETERS'] = '';
                    }
                    $scoes->elements[$manifest][$organization][$identifier]->parameters = addslashes($block['attrs']['PARAMETERS']);
                    if (!isset($block['attrs']['IDENTIFIERREF'])) {
                        $scoes->elements[$manifest][$organization][$identifier]->launch = '';
                        $scoes->elements[$manifest][$organization][$identifier]->scormtype = 'asset';
                    } else {
                        $idref = addslashes($block['attrs']['IDENTIFIERREF']);
                        $scoes->elements[$manifest][$organization][$identifier]->launch = addslashes($resources[$idref]['HREF']);
                        if (empty($resources[$idref]['ADLCP:SCORMTYPE'])) {
                            $resources[$idref]['ADLCP:SCORMTYPE'] = 'asset';
                        }
                        $scoes->elements[$manifest][$organization][$identifier]->scormtype = addslashes($resources[$idref]['ADLCP:SCORMTYPE']);
                    }

                    $parent = new stdClass();
                    $parent->identifier = $identifier;
                    $parent->organization = $organization;
                    array_push($parents, $parent);

                    $scoes = scorm_get_manifest($block['children'],$scoes);
                    
                    array_pop($parents);
                break;
                case 'TITLE':
                    $parent = array_pop($parents);
                    array_push($parents, $parent);
                    $scoes->elements[$manifest][$parent->organization][$parent->identifier]->title = addslashes($block['tagData']);
                break;
                case 'ADLCP:PREREQUISITES':
                    if ($block['attrs']['TYPE'] == 'aicc_script') {
                        $parent = array_pop($parents);
                        array_push($parents, $parent);
                        $scoes->elements[$manifest][$parent->organization][$parent->identifier]->prerequisites = addslashes($block['tagData']);
                    }
                break;
                case 'ADLCP:MAXTIMEALLOWED':
                    $parent = array_pop($parents);
                    array_push($parents, $parent);
                    $scoes->elements[$manifest][$parent->organization][$parent->identifier]->maxtimeallowed = addslashes($block['tagData']);
                break;
                case 'ADLCP:TIMELIMITACTION':
                    $parent = array_pop($parents);
                    array_push($parents, $parent);
                    $scoes->elements[$manifest][$parent->organization][$parent->identifier]->timelimitaction = addslashes($block['tagData']);
                break;
                case 'ADLCP:DATAFROMLMS':
                    $parent = array_pop($parents);
                    array_push($parents, $parent);
                    $scoes->elements[$manifest][$parent->organization][$parent->identifier]->datafromlms = addslashes($block['tagData']);
                break;
                case 'ADLCP:MASTERYSCORE':
                    $parent = array_pop($parents);
                    array_push($parents, $parent);
                    $scoes->elements[$manifest][$parent->organization][$parent->identifier]->masteryscore = addslashes($block['tagData']);
                break;
            }
        }
    }

    return $scoes;
}

function scorm_parse_scorm($manifestfile,$scormid) {
    
	$launch = 0;

    if (is_file($manifestfile)) {
        $xmlstring = file_get_contents($manifestfile);
        $objXML = new xml2Array();
        $manifests = $objXML->parse($xmlstring);
            
        $scoes = new stdClass();
        $scoes->version = '';
        $scoes = scorm_get_manifest($manifests,$scoes);

        if (count($scoes->elements) > 0) {
            foreach ($scoes->elements as $manifest => $organizations) {
                foreach ($organizations as $organization => $items) {
                    foreach ($items as $identifier => $item) {
                        $item->scorm = $scormid;
                        $item->manifest = $manifest;
                        $item->organization = $organization;
    					$id = insert_record('scorm_sco',$item);
                           if (($launch == 0) && ((empty($scoes->defaultorg)) || ($scoes->defaultorg == $identifier))) {
                            $launch = $id;
                        }
                    }
                }
            }
           set_field('tls_scorm','version','SCORM 1.2',$scormid);
        }
    } 
    
    return $launch;
}

function delete_records($vTable,$vField,$id)
{
	global $db;
	$sql="delete from $vTable where $vField=".$id;
	mysql_query($sql);
	//$db->query($sql);
}

function set_field($table, $field, $value, $id)
{
	global $db;
	$sql="update $table set $field='".$value."' where id=".$id;
	mysql_query($sql);
}

function insert_record($table, $dataobject, $returnid=true, $primarykey='id') 
{
	global $db;
	//table tls_scorm_sco_parameters
	$scorm=$dataobject->scorm;
	$manifest=$dataobject->manifest;
	$organization=$dataobject->organization;
	$parent=$dataobject->parent;
	$identifier=$dataobject->identifier;

	$launch=$dataobject->launch;
	$parameters=$dataobject->parameters;
	$scormtype=$dataobject->scormtype;
	$title=$dataobject->title;
	$prequisites=$dataobject->prequisites;
	$maxtimeallowed=$dataobject->maxtimeallowed;
	$timelimitaction=$dataobject->timelimitaction;
	$datafromlms=$dataobject->datafromlms;
	$masteryscore=$dataobject->masteryscore;
	$next=0;
	$previous=0;
	//till here
	if($launch!="")
	{
	$sql="insert into tls_scorm_sco (`scorm`,`manifest`,`organization`,`parent`,`identifier`,`launch`,`parameters`,`scormtype`,`title`,`prerequisites`,`maxtimeallowed`,`timelimitaction`,`datafromlms`,`masteryscore`,`next`,`previous`) VALUES ('".$scorm."','".$manifest."','".$organization."','".$parent."','".$identifier."','".$launch."','".$parameters."','".$scormtype."','".$title."','".$prequisites."','".$maxtimeallowed."','".$timelimitaction."','".$datafromlms."','".$masteryscore."','".$next."','".$previous."')";
	mysql_query($sql);
	$id=mysql_insert_id();
	}
	return (integer)$id;
}
?>