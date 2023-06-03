<?php

session_start();

require_once('./helpers/helper.php');
require_once(('./config/database.php'));


$sql = "select * from users where email <> 'refsujit@gmail.com' order by id desc limit 10";
$result = $conn->query($sql);

// die;


?>


<!DOCTYPE html>
<html>

<?php
require_once('./_partials/head.php');

?>

<body>

<?php
require_once('./_partials/navbar.php');
?>

<div class="slideshow-container">

    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="./img/sld1.png" style="width:100%;height: 300px">
        <div class="text">Admission Open BE Computer</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="./img/sld.png" style="width:100%;height: 300px">
        <div class="text">BE IV 2020 - Tour</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="./img/sld3.png" style="width:100%;height: 300px">
        <div class="text">Admission Open BBA</div>
    </div>

</div>
<br>

<div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>


<h2>Recent => 10 Registered Users</h2>

<?php
require_once('./helpers/flash.php');
?>


<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Registered On</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['reg_date']; ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>


<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 4000); // Change image every 2 seconds
    }
</script>


</body>


</html>