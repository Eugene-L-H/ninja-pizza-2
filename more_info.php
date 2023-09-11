<?php

// connect to database
require 'config/db_connect.php';
$connection = connectToDatabase();

// if POST request is recieved requesting deletion of pizza
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

  // GET request from user, display more information on pizza 
} else {

  if (isset($_GET['id'])) {

    // get pizza id from url
    $pizza_id = mysqli_real_escape_string($connection, $_GET['id']);

    // query for pizza
    $sql = "SELECT * FROM `pizzas` WHERE `id` = $pizza_id";
    $result = mysqli_query($connection, $sql);

    // get all data for selected pizza
    if ($result) {
      $pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);
      // contains all the info for pizza to be displayed
      $pizza = $pizza[0];

      // If pizza with that id does not exist, redirect to home page
      if ($pizza === null)
        header('Location: index.php');

      // free result from memory
      mysqli_free_result($result);

      // close connection
      mysqli_close($connection);

    } else {
      // error
      echo 'Error connecting to database.' . mysqli_error($connection);
    }

  } else {
    // redirect to home page if no pizza id is present in url
    header('Location: index.php');
  }


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
      <div class="center">Ingredients:</div>
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
      <input type="submit" name="delete" value="Delete Pizza" class="btn brand z-depth-0"
        onclick="return confirm('This is permanent! Are you sure you want to delete?')">
    </div>
  </div>
</form>


<?php include('templates/footer.php') ?>

</html>