<?php
  session_start();
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
?>

<!-- The HTML code that should only be displayed when the user is logged in -->
<a href="/CVMS/dummy/logoutpage.php" class="w3-bar-item w3-button w3-padding-large w3-hover-green">
    <i class='fas fa-user-check' style='font-size:30px; color: rgb(8, 235, 76); '></i>
    <p>Logout</p>
  </a>
<div>
  <p>Welcome, user! You are logged in.</p>
</div>

<?php
  } 
?>