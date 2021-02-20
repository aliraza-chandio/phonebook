<?php session_start(); 
  require 'db.php';
$query = "SELECT * FROM contactdetails WHERE user_id = ".$_SESSION['contact_id'];
$result = $connection->query($query);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Phonebook Directory</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_new_contact.php">Add New</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_all_contact.php">View All <span class="text-white"><?php echo $result->num_rows; ?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_profile.php">View</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="change_password.php">Change Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<?php 
  if (!$_SESSION) {
    header("Location: index.php");
  }
?>
<h4 class="text-center text-info my-5">Login as <?php echo $_SESSION['username']; ?></h4>