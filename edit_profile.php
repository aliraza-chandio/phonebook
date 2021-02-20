<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Edit Profile | Phonebook Directory </title>
</head>
<body class="bg-secondary">
  <div class="container-fluid px-0">
    <?php require 'menu.php'; 
      $message = '';
      if(isset($_POST['update'])){

          $name = $_POST['name'];
          $username = $_POST['username'];
          $email = $_POST['email'];


          $id = $_SESSION['contact_id'];

          if($name == ''  || $username ==''  || $email ==''  ){
             $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>';  

          }
          else
          {
            $emailExists = $connection->query("SELECT * FROM users WHERE id <> '$id' AND email = '$email' ");
            $usernameExists = $connection->query("SELECT * FROM users WHERE id <> '$id' AND username = '$username' ");

            if ($usernameExists->num_rows == 1) {
              
              $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Username already exists</div>';
            }
            elseif ($emailExists->num_rows == 1) {
              $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Email already exists</div>';
              
            }
            else
            {
            $query = "UPDATE users SET name = '$name', email =  '$email', username =  '$username' WHERE id ='$id'";
            $result = $connection->query($query);
              if($result){
                 $message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Profile Update Successfully</div>';   
               } else {
                 $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> '.$connection->error.'</div>';   
               }
             }
          }
      }
      $query = "SELECT * FROM users WHERE id = ".$_SESSION['contact_id'];
      $result = $connection->query($query);
      $row = $result->fetch_assoc(); 
    ?>    
    <div class="row mt-5 mr-0">
      <div class="col-lg-4 col-md-4 col-sm-4 col-2 "></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-8  border text-center mb-5">
        <h4 class="text-center text-info mt-5">Edit Profile</h4>
        <form class="mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <?php echo $message; ?>
          <div class="form-group row mt-5">
            <label for="name" class="text-left col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name*" value="<?php echo $row['name']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="text-left col-sm-3 col-form-label">Username<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username*" value="<?php echo $row['username']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="text-left col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="email" name="email" placeholder="Email*" value="<?php echo $row['email']; ?>">
            </div>
          </div>
          <button type="submit" name="update" class="btn btn-lg btn-primary mb-2 px-5">UPDATE</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
