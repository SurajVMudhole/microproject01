<?php
session_start();

if(!isset($_SESSION['user'])||$_SESSION['user']!= true ){
   header("location:index.php"); 
   exit();
   
}
include("databse.php");
$user= $_SESSION['username1'];
$sql="select * from `register` where email='$user'";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result))
    {
        $name=$row['name'];
        $gender= $row['gender']; 
        $dob =$row['dob'];
        $father=$row['father_name'];
        $mother=$row['mother_name'];
        $phn=$row['phone'];
        $admin=$row['admission_no'];
        $email=$row['email'];
        $class=$row['class'];
        $rfid=$row['rfid_no'];
       
    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome</title>
    <link rel="icon" type="image/x-icon" href="logo.jpg">
    <link rel="stylesheet" href="stud.css">

    <?php include('wrknav1.html'); ?>
    <link rel="stylesheet" href="welcome.css">

</head>

    <body>

  <div class="container1">

    <div class="container">
      <div class="title">Personal Information</div>
      
      <div class="content">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="user-details">
        

                    <div class="input-box">
                    <span class="details">Full Name <?php
                    echo ": $name";?></span>
                    
                    </div>
                    <div class="input-box">
                    <span class="details">Date Of Birth <?php
                    echo ": $dob";?></span>
                   
                    </div>
                    <div class="input-box">
                    <span class="details">Gender
                    <?php
                    echo ": $gender";?>
                    </span>
                    
                      
                   
                    </div>

                    <div class="input-box">
                    <span class="details">Father name <?php
                    echo ": $father";?></span>
                   
                    </div>
                    <div class="input-box">
                    <span class="details">Mother name
                    <?php
                    echo ": $mother";?>
                    </span>
                   
                    </div>
                    <div class="input-box">
                    <span class="details">Phone number
                    <?php
                    echo ": $phn";?>
                    </span>
                 
                    </div>
                    <div class="input-box">
                    <span class="details">Email
                      <?php
                      echo ": $email";?>
                    </span>
                   
                    </div>
                    <div class="input-box">
                    <span class="details">Addmission Number
                    <?php
                    echo ": $admin";?>
                    </span>
                  
                    </div>
                    <div class="input-box">
                    <span class="details">RFID Number 
                      <?php
                      echo ": $rfid";?>
                    </span>
                    
                    </div>
                    <div class="input-box">
                    <span class="details">Present class
                      <?php
                      echo ": $class";?>
                    </span>
                    
                    </div>
            
          </div>


         
        </form>
      </div>
    </div>
  </div>
  
</body>

</html>