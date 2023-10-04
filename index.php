<?php
$login =false;
$error=false;

include("databse.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
  
    $sql= "SELECT * FROM `studlogin` WHERE email='$username' AND  password='$password'";
    $result=mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
    
    if($num==1){
        $login=true;
        session_start();
        $_SESSION['user']=true;
        $_SESSION['username1']="$username";
        header("Location:welcome1.php");
    }
    
        $error=true;
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>isafe</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.jpg">

</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class = "icon">
                
                    <h1 class ="logo">ISafe</h2>
                <div class="menu">
                    <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT US</a></li>
                    <li><a href="admin.php">ADMIN LOGIN</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                    <div class="search">
                    <input class="srch" type="search" name="" placeholder="Type To text">
                    <a href="#"><button class="btn">Search</button></a>
                </div>    
                </ul>
                
                </div>

                <?php
                if($error){
                echo '<div class="alert">
                    <span class="clsbtn">&times;</span>
                    <strong>Invaild Credentials  </strong>Check and try again.
                </div>';
               
                
                }
                if($login)
                {
                    echo ' <div class="alert success">
                    <span class="clsbtn">&times;</span>
                    <strong>You are logged in</strong>
                    </div>';
                    header("Location:welcome1.php");}
                   
                ?>
                <div>
                
             
                <div class="content">
                    <h1>Student <span>Attendance <br>Monitoring </span> System</h1>
                    <br>
                    <p class="par">Commiting to the digital revolution  of data in the education system ,<br>Intoroducing, Best in class 
                    of ensuring the overall management of <br> student attendance data at fingertips </p>
                   
                <button class="cn"> <a href="#"></a> Join Us</button>
                </div>
                <form  method ="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                 <div class="form">
                 <h2>  Student Login </h2>
                 <input type="text" name="username" placeholder="Username">
                 <input type="password" name="password" placeholder="Password">
                 <button class ="btn1"><a href="">login</a></button>
                 <p class="link">Don't have an account?<br>
                    <a href="signup.php">SignUp </a> here</a></p>
                 </div>
                 
                 </form>

                </div>
                
               
                </div>
            </div>
        </div>
    
        
</body>
</html>