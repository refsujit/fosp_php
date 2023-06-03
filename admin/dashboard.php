<?php

session_start();

require_once('./../helpers/helper.php');
require_once(('./../config/database.php'));

validateAuthPage();

$sql = "select * from users where email <> 'refsujit@gmail.com' order by id desc";
$result = $conn->query($sql);

// die;


?>


<!DOCTYPE html>
<html>

<?php
require_once('./../_partials/head.php');

?>

<body>

<?php
require_once('./../_partials/navbar.php');
?>

<h2>Student Details</h2>
<p><strong>Hello <?php echo $_SESSION['auth']['name']; ?> !!!</strong><span style="float: right;">Total Registered Students: <?php echo $result->num_rows; ?></span></p>


<?php
require_once('./../helpers/flash.php');
?>


<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Registered On</th>
            <th>Avatar</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['reg_date']; ?></td>
                <?php if (!empty($row['image'])) { ?>
                    <td><img src="<?php echo baseURL() . '/uploads/' . $row['image']; ?>" width="100px"></td>
                <?php } else { ?>
                    <td >Not Available</td>
                <?php } ?>
                <td><a href="user_edit.php?id=<?php echo $row['id']; ?>"><i style="color:green;"
                                                                            class="fa-sharp fa-solid fa-pen-to-square"></i></a>
                    |
                    <a href="user_delete.php?id=<?php echo $row['id']; ?>"
                       onclick="return confirm('Are you sure to delete this data')"><i style="color:red;"
                                                                                       class="fa-sharp fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>

</html>