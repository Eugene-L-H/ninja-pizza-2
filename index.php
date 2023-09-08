<?php

// connect to database
$connection = mysqli_connect('localhost', 'eugene', '3434', 'ninja_pizza');

// check connection
if (!$connection) {
  'Error connecting to database.' . mysqli_connect_error();
}

// query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas';

// make query & get results

$result = mysqli_query($connection, $sql);

// store the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

print_r($pizzas);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($connection)

  ?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>
<?php include('templates/footer.php') ?>

</html>