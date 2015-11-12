<?php
  session_start();
  session_destroy();
  echo "<center>You have log out from the system <b>[LOGOUT]<b>";

// script to automatically go to system main page after the logout process:
  echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
  echo "<p class='text2'>Automatically goes to the Main Page</p>";
  
?>
