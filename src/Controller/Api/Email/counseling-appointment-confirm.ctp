<?php
  
  include 'variable.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title> COUNSELING APPOINTMENT - CONFIRMED </title>

  <style type="text/css">
    * {
     font-family: "Times New Roman";
    }
  </style>

</head>
<body>
  <h4>Hello Mr/Ms <strong><?php echo $_SESSION['name'];?></strong>, </h4>
  <h5>Your counseling appointment has already been  approved and confirmed.</h5>
  <table width="100%" style="border: 3px solid #ffe6f2; border-radius: 20px;">
  <tr>
    <td style="text-align: center;"><center><img src="<?php echo $logo;?>" height="200" width="200"></center></td>
  </tr>
  <tr>
    <td><center><h1 style="background-color:#ffe6f2; color:black;"> Counseling Appointment </h1></center></td>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> CONTROL NO. :</strong><i> <?php echo $_SESSION['code'];?> </i></td>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> STUDENT NUMBER :</strong><i> <?php echo $_SESSION['student_no'];?> </i></td>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> STUDENT NAME :</strong><i> <?php echo $_SESSION['name'];?> </i></td>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> COUNSELOR NAME :</strong><i> <?php echo $_SESSION['counselor_name'];?> </i></td>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> DATE :</strong><i> <?php echo $_SESSION['date'];?> </i></td>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> TIME :</strong><i> <?php echo $_SESSION['time'];?> </i></td>
  </tr>
  </tr>
  <tr>
    <td style="text-align: left;"><strong> STATUS : </strong><i> CONFIRMED </i></td>
  </tr>
  <!-- <tr>
    <td style="text-align: center;font-family:'Poppins';"><center><a href='<?php echo $url; ?>vehicle-requests/view/<?php echo $_SESSION['id']; ?>'. target="_blank" style="padding: 8px 12px; background-color: #038C8C;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color:white;text-decoration: none;font-weight:bold;display: inline-block;">
    Click Here</center></td>
  </tr> -->
</table>
</body>
</html>