<?php
  
  include 'variable.php';

?>

<!DOCTYPE html>
<html>
<head>
  <title> COLLEGE ADMISSION TEST RESULT </title>

  <style type="text/css">
    * {
     font-family: "Times New Roman";
    }
  </style>

</head>
<body>

  <h4>Hello Mr/Ms <strong><?php echo $_SESSION['name'];?></strong>, </h4>
  <h4>Below is the details of college admission test result.</h4>
  <table width="100%" style="border: 3px solid #ffe6f2; border-radius: 20px;">
    <tr>
      <td style="text-align: center;"><center><img src="<?php echo $logo;?>" height="200" width="200"></center></td>
    </tr>
    <tr>
      <td><center><h1 style="background-color:#ffe6f2; color:black;"> Examination Result </h1></center></td>
    </tr>
    <tr>
      <td style="text-align: left;"><strong> APPLICATION NUMBER :</strong><i> <?php echo $_SESSION['application_no'];?> </i></td>
    </tr>
    <tr>
      <td style="text-align: left;"><strong> NAME :</strong><i> <?php echo $_SESSION['name'];?> </i></td>
    </tr>
    <tr>
      <td style="text-align: left;"><strong> RATE :</strong><i> <?php echo $_SESSION['rate'];?> </i></td>
    </tr>
     <tr>
      <td style="text-align: left;"><p>Unfortunately you did not meet the required rating for <?php echo $_SESSION['preferred_program']; ?>.</p></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <th style="text-align: left;">Programs Offered you can take.</th>
    </tr>
    <?php 

    if(!empty($_SESSION['program_list'])){

      foreach ($_SESSION['program_list'] as $key => $value) { ?>
        
        <tr>
          <td><?php echo ($key + 1).'. '.$value['name'] ?></td>
        </tr>

      <?php }

    }

    ?>

    <tr>
      <td style="text-align: center;font-family:'Poppins';"><center><a href='<?php echo $_SESSION["base"]; ?>change-program/<?php echo $_SESSION["id"] ?>'. target="_blank" style="padding: 8px 12px; background-color: #038C8C;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color:white;text-decoration: none;font-weight:bold;display: inline-block;">
      Change Program Here</center></td>
    </tr>
   
  </table>
    
</body>
</html>