<?php

// connect to database
require 'config/db_connect.php';
$connection = connectToDatabase();

// Default values for "Add a Pizza" form input values
$formValues = [
  'email' => '',
  'title' => '',
  'ingredients' => ''
];

// Will store error messages when input errors are submitted on the form
$errors = [
  'email' => '',
  'title' => '',
  'ingredients' => ''
];

if (isset($_POST['submit'])) {

  // Store user data from "Add a Pizza" form
  $formValues['email'] = $_POST['email'];
  $formValues['title'] = $_POST['title'];
  $formValues['ingredients'] = $_POST['ingredients'];

  // check email
  if (empty($_POST['email'])) {
    $errors['email'] = 'An email is required <br />';
  } else {
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Email must be in proper format: someone@email.com <br />';
    }
  }

  // check title
  if (empty($_POST['title'])) {
    $errors['title'] = 'A title for your pizza is required <br />';
  } else {
    $title = $_POST['title'];

    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      $errors['title'] = 'Title must contain letters and spaces only. <br />';
    }
  }

  // check ingredients
  if (empty($_POST['ingredients'])) {
    $errors['ingredients'] = 'Ingredients for your pizza are required <br />';
  } else {
    $ingredients = $_POST['ingredients'];
    if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
      $errors['ingredients'] = 'Ingredients must be a comma separated list';
    }

  }

  // Check errors array for any user errors 
  $errorPresent = false;
  foreach ($errors as $error => $value) {
    // If value is not an empty string, there is an error
    if ($value !== '') {
      $errorPresent = true;
    }
  }

  // Redirect to index page if no errors are present in for submission
  if (!$errorPresent) {

    // sanitize data recieved from user, before sending to database
    $email = htmlspecialchars($email);
    $title = htmlspecialchars($title);
    $ingredients = htmlspecialchars($ingredients);

    // send email, title, and ingredients to server.
    $sql = "INSERT INTO pizzas (email, title, ingredients) VALUES (
             '$email',
             '$title',
             '$ingredients'
            )";

    // send pizza info to database
    $result = mysqli_query($connection, $sql);

    header('Location: index.php');
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
    <input type="text" name="email" value=<?php echo htmlspecialchars($formValues['email']) ?>>
    <!-- error message -->
    <div class="red-text">
      <?php echo $errors['email'] ?>
    </div>

    <label for="title">Pizza Title</label>
    <input type="text" name="title" value=<?php echo htmlspecialchars($formValues['title']) ?>>
    <!-- error message -->
    <div class="red-text">
      <?php echo $errors['title'] ?>
    </div>

    <label for="ingredients">Ingredients (comma seperated)</label>
    <input type="text" name="ingredients" value=<?php echo htmlspecialchars($formValues['ingredients']) ?>>
    <!-- error message -->
    <div class="red-text">
      <?php echo $errors['ingredients'] ?>
    </div>

    <div class="center">
      <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
    </div>

  </form>
</section>

<?php include('templates/footer.php') ?>

</html>