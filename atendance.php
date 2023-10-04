<?php
session_start();

if(!isset($_SESSION['user'])||$_SESSION['user']!= true ){
   header("location:index.php"); 
   exit();

}
include("databse.php");
$admin=$_SESSION['username1'];
 

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="presentday.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ISafe</title>
     <link rel="icon" type="image/x-icon" href="logo.jpg">
     <?php include("wrknav1.html");?>
   </head>
<body>
    <div class="container1">
        <div class="container">
            <div class="title"> Attendance Tracker</div>
            <div class="content">
           
                <div class="user-details">
         
                
                </div>
                <div style="overflow-x:auto;">
                    <table>
                        <tr>
                            <th>SL No.</th>
                            <th>Date</th>
                            <th>Time in</th>
                            <th>Time out</th>
                        </tr>
                        <?php
                                    include("databse.php");
                                    $date=null;
                                   $count=1;
                                  
                                  
                                       $count=1;
               
                                       $sql = "select date, time_in,time_out from attendance inner join register on attendance.rfid_no=register.rfid_no where register.email='$admin';";
                                       $result = mysqli_query($conn, $sql);
                                       if (mysqli_num_rows($result) > 0) {
                                           while ($row = mysqli_fetch_assoc($result)) {
                                               echo "
                                                                           <tr>
                                                                           <td>" . $count . "</td>
                                                                          <td>" . $row['date'] . "</td>
                                                                           <td>" . $row['time_in'] . "</td>
                                                                           <td>" . $row['time_out'] . "</td>
                                                                       
                                                                       </tr>";
                                                                       $count++;
                                           }
               
                                       }
                                    
    
    
    ?>
                        </table>
               
                  
                      
                    
                </div>
                
            </div>
        </div>
    </div>


</body>
</html>
