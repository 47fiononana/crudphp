<?php
include_once 'db.php';
if(!$user->is_loggedin())
{
 $user->redirect('home.php');
}

$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<?php 
include_once 'db.php';

if(!$user->logout())
{
 $user->redirect('index.php');
}

 ?>
<!DOCTYPE html >
<html >
<head>
<meta  charset=utf-8 />

<link rel="stylesheet" href="profil.css" type="text/css"  />
<title>welcome - <?php print($userRow['user_name']); ?></title>
</head>

<body>

<div id="header_wrapper">
<div id="header">
	<div class="logg">
	<li class="uiButton uiButtonConfirm"><a href="index.php?logout=true"><input type="submit" name="logout" value="log out"></a></li>
 </div>
</div>
</div>
<div class="content">
welcome : <?php print($userRow['user_name']); ?>
</div>
</body>
</html>