<?php

session_start();



require_once('./config/database.php');
require_once('./helpers/helper.php');

validateAuthPage();

$sql = "select * from users";
$result = $conn->query($sql);
print_r($result);
// die;




?>





<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">
  <style>
  </style>
</head>

<body>

  <ul>
    <li><a href="#home">Home</a></li>
    <li><a href="#news">News</a></li>
    <li><a href="#contact">Contact</a></li>
    <li style="float:right"><a class="" href="login.php">Login</a></li>
    <li style="float:right"><a class="" href="index.php">Register</a></li>
    <li style="float:right"><a class="" href="logout.php">Logout</a></li>
  </ul>

  <h2>Student Details</h2>
  <p>Total Registered Students: <?php echo $result->num_rows; ?></p>
  <div style="overflow-x:auto;">
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>

      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td>Edit | Del</td>
        </tr>
      <?php } ?>
    </table>
  </div>

</body>

</html>