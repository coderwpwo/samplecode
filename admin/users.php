<?php

	require_once("session.php");
	
	require_once("class.admin.php");
	$auth_user = new ADMIN();
	
	
	$user_id = $_SESSION['user_admin_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users");
	$stmt->execute();
	
	$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r($userRow); die;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - Admin</title>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="moods.php">Mood Manager</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' Admin&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">welcome : Admin</label>
        <hr />
        
        <h1>
        <a href="#"><span class="glyphicon glyphicon-home"></span> User Manager</a> &nbsp; 
        </h1>
       	<hr />
        
        <p class="h4">Users</p> 
        
        <div class="col-md-10 col-sm-10 col-xs-12">
		<table class="table-responsive">
        <thead>
        <th width="10%;">Sr.No</th>
        <th width="20%;">User Name</th>
        <th width="20%;">User Email</th>
        <th width="20%;">Added Date</th>
        <th width="20%;">Operations</th>
        </thead>
        <tbody>
        <?php $sr=1; ?>
		<?php foreach($userRow as $users){?>
		<tr>
        <td width="10%;"><?php echo $sr; ?></td>
        <td width="20%;"><?php echo $users['user_name'] ?></td>
        <td width="20%;"><?php echo $users['user_email'] ?></td>
        <td width="20%;"><?php echo $users['joining_date'] ?></td>
        <td width="20%;"><a href="edituser.php?userid=<?php echo $users['user_id']; ?>">Edit</a></td>	
		</tr>
			
		<?php $sr++;} ?>
        </tbody>
        </table>
        </div>  
        
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>