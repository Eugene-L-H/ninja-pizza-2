<?php

// connect to database
$connection = mysqli_connect('localhost', 'eugene', '3434', 'ninja_pizza');

// check connection
if (!$connection) {
  'Error connecting to database.' . mysqli_connect_error();
}

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
    <?php foreach ($pizzas as $pizza) { ?>

      <div class="col s6 md3 ">
        <div class="card z-depth-0">
          <div class="card-content center">
            <h6>
              <?php echo htmlspecialchars($pizza['title']) ?>
            </h6>
            <div>
              <?php echo htmlspecialchars($pizza['ingredients']) ?>
            </div>
          </div>
          <div class="card-action right-align">
            <a href="#" class="brand-text">more info</a>
          </div>
        </div>
      </div>

    <?php } ?>
  </div>
</div>

<?php include('templates/footer.php') ?>

</html>