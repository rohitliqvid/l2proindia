<?php

$app->get('/users', 'getUsers');
$app->get('/users/:id','getUser');
$app->post('/users', 'signUpUser');
$app->put('/users/:id', 'updateUser');
$app->delete('/users/:id',	'deleteUser');

$app->run();

function getUsers() {
	$sql = "select * FROM tbl_users ORDER BY id LIMIT 10";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		// echo '{"note": ' . json_encode($users) . '}';
		echo json_encode($users);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getUser($id) {
	$sql = "SELECT * FROM tbl_users WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$user = $stmt->fetchObject();
		$db = null;
		echo json_encode($user); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function signUpUser() {
	$request = Slim::getInstance()->request();
	$users = json_decode($request->getBody());
	$sql = "INSERT INTO tbl_users (firstname, lastname, mobile, sex, email, password, education, learn_from, profession, allow_email_for_marketing	,allow_email_for_campaign) VALUES (:firstname, :lastname, :mobile,:sex,:email,:password,:education,:learn_from,:profession,:allow_email_for_marketing,:allow_email_for_campaign)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("firstname", $request->params('firstname'));
		$stmt->bindParam("lastname", $users->lastname);
		$stmt->bindParam("mobile", $users->mobile);
		$stmt->bindParam("email", $users->email);
		$stmt->bindParam("username", $users->email);
        $stmt->bindParam("sex", $users->sex);
		$stmt->bindParam("password", md5($users->password));
		$stmt->bindParam("education", $users->education);
        $stmt->bindParam("profession", $users->profession);
		$stmt->bindParam("learn_from", $users->learn_from);
		$stmt->bindParam("allow_email_for_marketing	", $users->email_marketing);
        $stmt->bindParam("allow_email_for_campaign", $users->email_campaign);

		$stmt->execute();
		$users->id = $db->lastInsertId();
		$db = null;
		echo json_encode($users); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateUser($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$note = json_decode($body);
	$sql = "UPDATE note SET name=:name, description=:description, date=:date WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $note->name);
		$stmt->bindParam("description", $note->description);
		$stmt->bindParam("date", $note->date);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($note);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteUser($id) {
	$sql = "DELETE FROM note WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

?>