<?php

function connectToDatabase()
{

  // connect to database
  $connection = mysqli_connect('localhost', 'eugene', '3434', 'ninja_pizza');

  // check connection
  if (!$connection) {
    'Error connecting to database.' . mysqli_connect_error();
  }

  return $connection;

}

?>