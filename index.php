<?php

// connect to database
require 'config/db_connect.php';
$connection = connectToDatabase();

// query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

// make query & get results
$result = mysqli_query($connection, $sql);

// store the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($connection)

  ?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<h4 class="center grey-text">Pizzas!</h4>

<div class="container">
  <div class="row">

    <?php foreach ($pizzas as $pizza): ?>

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
            <a href="#" class="brand-text">more info</a>
          </div>
        </div>
      </div>

    <?php endforeach; ?>

  </div>
</div>

<?php include('templates/footer.php') ?>

</html>