<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Login | Phonebook Directory </title>
</head>
<?php
session_start();

if(isset($_SESSION['username'])){
  header('Location: home.php');
  // redirect krne k liye use krty hain header
}
$message = '';
require 'db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $username = $_POST['username'];
  $password = $_POST['password'];
  // echo $username." ". $password;
  // exit;
  if($username == '' || $password == ''){
     $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>';  

  }
  else
  {

   $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";


   $result = $connection->query($query);
   if($result->num_rows == 1) {
     $user = $result->fetch_assoc();

     $_SESSION['username'] = $username;
     $_SESSION['contact_id'] = $user['id'];
     header('Location: home.php'); 

   }
   else
   {
     $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Invalid username or password</div>'; 


   }

  }
}
?>
<body class="bg-secondary">
  <div class="container-fluid px-0">
    <div class="row mt-5 mr-0">
      <div class="col-lg-4 col-md-4 col-sm-4 col-2 "></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-8  border text-center mb-5">
        <h4 class="text-center text-info mt-5">Login</h4>
        <form class="mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <?php echo $message; ?>
          <div class="form-group row mt-5">
            <label for="username" class="text-left col-sm-3 col-form-label">Username<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username*">
            </div>
          </div>
          <div class="form-group row ">
            <label for="password" class="text-left col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password*">
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-lg btn-primary mb-2 px-5">LOGIN</button>

        </form>
        <p class="text-center text-primary">Not a member yet? Register <a class="text-white" href="register.php">Here</a></p>
      </div>
    </div>
  </div>
</body>
</html>
