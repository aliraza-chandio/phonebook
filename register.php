<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Register | Phonebook Directory </title>
</head>
<?php
require 'db.php';
$message = '';
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password =$_POST['confirm_password'];
  // echo $confirm_password;
  // exit;

  if($name == '' || $username == ''  || $email == ''  || $password == '' || $confirm_password ==''){
    $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>'; 

  }
  else if( $password != $confirm_password){
    
      $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Passwords do not match.</div>'; 
  }
  else
  {
    $emailExists = $connection->query("SELECT * FROM users WHERE email = '$email' ");
    $usernameExists = $connection->query("SELECT * FROM users WHERE username = '$username' ");

    if ($usernameExists->num_rows == 1) {
      
      $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Username already exists</div>';
    }
    elseif ($emailExists->num_rows == 1) {
      $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Email already exists</div>';
      
    }
    else
    {
        $sql = "INSERT INTO users(name, username, email, password) VALUES ('$name','$username','$email', '$password')";
        $result = $connection->query($sql);
        if($result == TRUE){
          $message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Record added successfully</div>'; 
        }
        else  
        {
          $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> '.$connection->error.'</div>';  
        }
    }
  }
}
?>
<body class="bg-secondary">
  <div class="container-fluid px-0">
    <div class="row mt-5 mr-0">
      <div class="col-lg-4 col-md-4 col-sm-4 col-2 "></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-8  border text-center mb-5">
        <h4 class="text-center text-info mt-5">Register</h4>
        <form class="mt-5" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
          <?php echo $message; ?>
          <div class="form-group row mt-5">
            <label for="name" class="text-left col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name*" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="text-left col-sm-3 col-form-label">Username<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username*" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="text-left col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email*" required>
            </div>
          </div>
          <div class="form-group row ">
            <label for="Password" class="text-left col-sm-3 col-form-label">Password<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password*" required>
            </div>
          </div>
          <div class="form-group row ">
            <label for="confirm_password" class="text-left col-sm-3 col-form-label">Confirm Password<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control mt-3" id="confirm_password" name="confirm_password" placeholder="Confirm Password*" required>
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-lg btn-primary mb-2 px-5">REGISTER</button>
        </form>
        <p class="text-center text-primary">Already have an account? please login <a class="text-white" href="index.php">Here</a></p>
      </div>
    </div>
  </div>
</body>
</html>
