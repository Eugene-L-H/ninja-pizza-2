<?php

// connect to database
require 'config/db_connect.php';
$connection = connectToDatabase();

// get pizza id from url
$pizza_id = $_GET['id'];

// query for pizza
$sql = "SELECT * FROM `pizzas` WHERE `id` = $pizza_id";

$result = mysqli_query($connection, $sql);

$pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);
$pizza = $pizza[0];

print_r($pizza);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<div class="col s6 md3 ">
  <div class="card z-depth-0">
    <div class="card-content center">

      <!-- display pizza title -->
      <h6>
        <?php echo htmlspecialchars($pizza['title']) ?>
      </h6>

      <!-- list ingredients -->
      <ul>
        <?php
        $ingredientsArray = explode(',', $pizza['ingredients']);

        foreach ($ingredientsArray as $ingredient): ?>
          <li>
            <?php echo htmlspecialchars($ingredient) ?>
          </li>
        <?php endforeach; ?>

      </ul>
    </div>
    <div class="card-action right-align">
      Created by:
      <?php echo $pizza['email'] ?>
    </div>
  </div>
</div>


<?php include('templates/footer.php') ?>

</html>