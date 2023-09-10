<?php

// connect to database
require 'config/db_connect.php';
$connection = connectToDatabase();

// if post request is recieved requesting deletion of pizza
if (isset($_POST['delete'])) {
  print_r($_POST);
  // query pizza in database to be deleted
  $sql = "DELETE FROM `pizzas` WHERE `id` = $_POST[delete_pizza_id]";

  // send query, requesting deletion, to database
  if (mysqli_query($connection, $sql)) {

    // success
    header('Location: index.php');

  } else {
    // error
    echo 'Error connecting to database.' . mysqli_error($connection);
  }

} else {

  // get pizza id from url
  $pizza_id = $_GET['id'];

  // query for pizza
  $sql = "SELECT * FROM `pizzas` WHERE `id` = $pizza_id";

  $result = mysqli_query($connection, $sql);

  $pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $pizza = $pizza[0];

}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<form class="white" action="more_info.php" method="POST">
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

    <div class="right-align">
      Created by:
      <?php echo $pizza['email'] ?>, @
      <?php echo $pizza['created_at'] ?>
    </div>
    <input type="hidden" name="delete_pizza_id" value=<?php echo $pizza_id ?>>
    <div class="center">
      <input type="submit" name="delete" value="Delete Pizza" class="btn brand z-depth-0">
    </div>
  </div>
</form>


<?php include('templates/footer.php') ?>

</html>