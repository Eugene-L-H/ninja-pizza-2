<?php

if (isset($_POST['submit'])) {

  // check email
  if (empty($_POST['email'])) {
    echo 'An email is required <br />';
  } else {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo 'Email must be in proper format. <br />';
    }
  }

  // check title
  if (empty($_POST['title'])) {
    echo 'A title for your pizza is required <br />';
  } else {
    $title = $_POST['title'];

    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      echo 'Title must contain letters and spaces only. <br />';
    }
  }

  // check ingredients
  if (empty($_POST['ingredients'])) {
    echo 'Ingredients for your pizza are required <br />';
  } else {
    $ingredients = $_POST['ingredients'];
    if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
      echo 'Ingredients must be a comma separated list';
    }

  }

} // end of POST check.

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php') ?>

<section class="container grey-text">
  <h4 class="center">Add a Pizza</h4>

  <form action="" class="white" action="add.php" method="POST">

    <label for="">Your Email</label>
    <input type="text" name="email">

    <label for="title">Pizza Title</label>
    <input type="text" name="title">

    <label for="ingredients">Ingredients (comma seperated)</label>
    <input type="text" name="ingredients">

    <div class="center">
      <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
    </div>

  </form>
</section>

<?php include('templates/footer.php') ?>

</html>