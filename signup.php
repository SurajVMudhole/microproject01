<?php
$msg =false;
$status=false;
$failure=false;

include("databse.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $number = $_POST["number"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
  
    $sql= "select `admission_no` from `register` WHERE `admission_no`='$number'";
    $result=mysqli_query($conn,$sql);
    $num= mysqli_num_rows($result);
    
    if($num==1){{
        if($password==$cpassword){
            $login=true;
            $sql="insert into studlogin (`email`,`password`) VALUES ((SELECT `email`FROM register WHERE `admission_no`='$number'),'$password') ";
            $result=mysqli_query($conn,$sql);
           
        }
        else{
            $msg=true;
        }
      
    }
   
    }
    else if($num==0){
        $failure = true;
    }   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="logo.jpg">

    <link rel="stylesheet" href="admin.css">

</head>
<body>
    <div class="main">
        <div class="navbar">
            <div class = "icon">
                
                    <h1 class ="logo">ISafe</h2>
                <div class="menu">
                    <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="about.php">ABOUT</a></li>
                    <li><a href="admin.php">LOGIN</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                    <div class="search">
                    <input class="srch" type="search" name="" placeholder="Type To text">
                    <a href="#"><button class="btn">Search</button></a>
                </div>    
                </ul>
                </div>
                <?php
                if($msg){
                echo '<div class="alert">
                    <span class="clsbtn">&times;</span>
                    <strong>Password and Conform password</strong>dose not match.
                </div>';
               
                
                }
                if($num==0){
                    echo '<div class="alert">
                        <span class="clsbtn">&times;</span>
                        <strong>admission number </strong>invalid.
                    </div>';
                   
                    
                    }
                if($num==1)
                {
                    echo ' <div class="alert success">
                    <span class="clsbtn">&times;</span>
                    <strong>Account created Sucesfully login </strong>
                    </div>';
                    header("Location:index.php");
                }
                   
                   
                ?>
                <div>
                <form  method ="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                 <div class="form">
                 <h2>  Student Signup </h2>
                 <input type="text" name="number" placeholder="Admission Number">
                 <input type="password" name="password" placeholder="New Password">
                 <input type="password" name="cpassword" placeholder="Confrom Password">
                 <button class ="btn1"><a href="">SignUp</a></button>
                 <p class="link">Already have an account?<br>
                    <a href="index.php">Login </a> here</a></p>
                 </div>
                 </form>
                 

                </div>
                
                <script>
                
var close = document.getElementsByClassName("clsbtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0.2";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>
                </div>
            </div>
        </div>
    
</body>

</html>