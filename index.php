<?php

// connect to database

$connection = mysqli_connect('localhost', 'eugene', '3434', 'ninja_pizza');

// check connection

if (!$connection) {
  'Error connecting to database.' . mysqli_connect_error();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>
<?php include('templates/footer.php') ?>

</html>