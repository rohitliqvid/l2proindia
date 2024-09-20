<?php 

class cert{
    
    public $_con;
    public function __construct($con){
        $this->_con = $con;
    }
    
    
    public function getDataForCert($user_id){
        
        $sub_sql = empty($user_id) ? '' : " AND user_id = '$user_id' "; 
        
        $data = array();
        $sql = "SELECT user_id, chapter_edge_id , group_concat(DISTINCT `component_type`) FROM "
                . "`tbl_component_progress` WHERE 1 = 1 $sub_sql group by user_id, chapter_edge_id";
        $stmt = $this->_con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($user_id, $chap_edge_id, $comp_types);
        while($stmt->fetch()){
            $data[$user_id][$chap_edge_id] = explode(",",$comp_types);
        }
        $stmt->close();
        return $data;
    }
    
    
    public function getUserLevels($user_id){
        
        $data = array();
        $sql = "SELECT user_id, level FROM `tbl_cert` WHERE user_id = '$user_id' ";
        $stmt = $this->_con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($user_id, $level);
        while($stmt->fetch()){
            $data[] = $level;
        }
        $stmt->close();
        return $data;
    }
    
    public function getUserInfo($user_id){
        
        $data = array();
        $sql = "SELECT u.user_id, u.first_name, u.last_name, u.email_id, uc.loginid "
                . "FROM user u JOIN user_credential uc ON u.user_id = uc.user_id AND u.user_id = '$user_id' ";
        $stmt = $this->_con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($user_id, $fname, $lname, $email, $loginid);
        while( $stmt->fetch() ){
            $data = array('user_id' => $user_id, 'fname' => $fname, 'lname' => $lname, 'email' => $email, 'loginid' => $loginid );
            break;
        }
        $stmt->close();
        return $data;
    }
    
    public function insertUserLevel($arr){
        
        $sql = "INSERT INTO tbl_cert (user_id, level, cert_path, created_date, modified_date ) VALUES (?,?,?, NOW(), NOW() ) ";
        $stmt = $this->_con->prepare($sql);
        $stmt->bind_param('iis', $arr['user_id'], $arr['level'], $arr['cert_path'] );
        $stmt->execute();
        
        $stmt->close();
        return $data;
    }

	public function insertUserPercentage($user_id, $per){
        
        $sql = "INSERT INTO tbl_cert_per (user_id, per, created_date, modified_date ) VALUES (?,?, NOW(), NOW() ) ON DUPLICATE KEY UPDATE per = ?, modified_date = NOW() ";
        $stmt = $this->_con->prepare($sql);
        $stmt->bind_param('iii', $user_id, $per, $per );
        $stmt->execute();
        
        $stmt->close();
        return $data;
    }
    
    public function insertUserChapterCount($user_id, $chap_count){
        
        $sql = "INSERT INTO tbl_cert_per (user_id, chap_count, created_date, modified_date ) VALUES (?,?, NOW(), NOW() ) ON DUPLICATE KEY UPDATE chap_count = ?, modified_date = NOW() ";
        $stmt = $this->_con->prepare($sql);
        $stmt->bind_param('iii', $user_id, $chap_count, $chap_count );
        $stmt->execute();
        
        $stmt->close();
        return $data;
    }
    

	public function getUserPercentage($user_id){
        
        
        $sql = "SELECT per "
                . "FROM tbl_cert_per WHERE user_id = '$user_id' ";
        $stmt = $this->_con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($per);
		$stmt->fetch();
        $stmt->close();
		
		if( empty($per) ){
			$per = 0;
		}

		if($per > 100){
			$per = 100;
		}

        return $per;
    }
    
    
    public function getCourseStructFROMDB($course_id) {
        
        $sql = "SELECT struct_str FROM tbl_course_struct_str WHERE course_id = '$course_id' ";
        $stmt = $this->_con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($str);
		$stmt->fetch();
        $stmt->close();
		
        if( empty($str) ){
            return array();
        }
        
		return $str;
    }
    
    
    public function deleteCertificates($user_id){
        
        $sql = "DELETE FROM tbl_cert WHERE user_id = ? ";
        $stmt = $this->_con->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
    }

}