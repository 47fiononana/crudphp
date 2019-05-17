<?php
require_once 'db.php';

if($user->is_loggedin()!="")
{
 $user->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname_email'];

 $upass = $_POST['txt_password'];
  
 if($user->login($uname,$upass))
 {
  $user->redirect('home.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}

if(isset($_POST['btn-signup']))
{
   $uname = trim($_POST['txt_uname']);
  
   $upass = trim($_POST['txt_upass']); 
 
   if($uname=="") {
      $error[] = "provide username !"; 
   }
  
   else if($upass=="") {
      $error[] = "provide password !";
   }
   else if(strlen($upass) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else
   {
      try
      {
         $stmt = $DB_con->prepare("SELECT user_name FROM users WHERE user_name=:uname");
         $stmt->execute(array(':uname'=>$uname));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['user_name']==$uname) {
            $error[] = "sorry username already taken !";
         }
         
         else
         {
            if($user->register($fname,$lname,$uname,$upass)) 
            {
                $user->redirect('index.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>






<!DOCTYPE html>
<html >
<head>
<meta  charset=utf-8 />
<title>Login :</title>

<link rel="stylesheet" href="face.css" type="text/css"  />
</head>
<body>
<div id="header_wrapper">
 <div id="header">
 <li id="sitename"><a href="index.php"><img src="logo.png"></a></li>
        <form method="post">
            
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                  </div>
                  <?php
            }
            ?>
            
             <li>Username<br><input type="text" class="inputtext" name="txt_uname_email" required />
            
            
             <li>Password<br><input type="password" name="txt_password"  required /><br>
              <div class="logginF"><a href="">Forgot account?</a></div></li>
             <li class="uiButton uiButtonConfirm"><input type="submit" name="btn-login" value="Log In" ></li>
            
        </form>
       </div>
</div>

<div id="wrapper">

<div id="div1">
<p<Talkerscode helps you connect and share with the <br>people in your life.</p>
<img src="facebook.png">
</div>
<div id="div2">
<h1>Sign Up</h1>
<p>It's free and always will be.</p>
<form method="post">
<?php

            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <p style="color: green;"> Successfully registered you can log now</p>
                 </div>
                 <?php
            }
            ?>

<li><input type="text" name="txt_uname" placeholder="Username" value="<?php if(isset($error)){echo $uname;}?>"></li>

<li><input type="password" placeholder="New password" name="txt_upass"></li>

</li>

<li id="terms">By clicking Create an account, you agree to our <a href="">Terms</a> and that <br>you have read our <a href="">Data Policy</a>, including our <a href="">Cookie Use</a>.</li>
<li><input type="submit" value="Sign Up" name="btn-signup" class="hoverr"></li>
<li id="create_page"><a href="">Create a Page</a> for a celebrity, band or business.</li>
</li>
</form>
</div>

</div>



</body>
<footer>
  <div id="footer_wrapper">

<div id="footer1">
English (UK) <a href="">हिन्दी</a><a href="">ਪੰਜਾਬੀ</a><a href=""> اردو</a><a href="">தமிழ்</a><a href="">বাংলা</a><a href="">मराठी</a><a href="">తెలుగు</a><a href="">ગુજરાતી</a><a href="">ಕನ್ನಡ</a><a href="">മലയാളം</a>
</div>
<div id="footer2">
<a href="">Sign Up</a><a href="">Log In</a><a href="">Messenger</a><a href="">Talkerscode</a><a href="">Mobile</a><a href="">Find Friends</a><a href="">Badges</a><a href="">People</a><a href="">Pages</a><a href="">Places</a><a href="">Games</a><a href="">Locations</a><a href="">Celebrities</a><a href="">Groups</a><a href="">Moments</a><a href="">About</a><a href="">Create Advert</a><a href="">Create Page</a><a href="">Developers</a><a href="">Careers</a><a href="">Privacy</a><a href="">Cookies</a><a href="">Ads</a><a href="">Terms</a><a href="">Help</a>
<p>Design By TalkersCode.com</a>
</div>


</footer>
</div>
</html>