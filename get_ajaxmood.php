<?php	

/*File for get random mood of user */


	require_once("class.user.php");
	
	$mooduser = new USER();
	$stmt = $mooduser->runQuery("SELECT * FROM mood order by rand() limit 1");
	$stmt->execute();
	$mood = $stmt->fetch(PDO::FETCH_ASSOC);
	
	echo $mood['mood']; 
?>