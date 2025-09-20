<?php
     if(isset($_GET["id"])){
        $id = $_GET['id'];
        $con= mysqli_connect("localhost","root","", "php_auth");
        $query= 'DELETE FROM users where id = id';
        $query_run=mysqli_query($con,$query);
    }
   header('location:index.php');
    exit;
    ?>
