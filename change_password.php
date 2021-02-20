<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Change Password | Phonebook Directory </title>
</head>
<body class="bg-secondary">
  <div class="container-fluid px-0">
    <?php require 'menu.php'; ?>
    <?php 
    $message= '';
        if(isset($_POST['update']))
        {
          $old_password = $_POST['old_password'];
          $new_password = $_POST['new_password'];
          $confirm_password = $_POST['confirm_password'];
          if($old_password == ''  || $new_password ==''  || $confirm_password ==''  ){
             $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>';  
          } 
          else 
          {
             $sql = "SELECT * FROM users where id = ".$_SESSION['contact_id']." AND password = '".$old_password."'";
              $result = $connection->query($sql);

              if ($result->num_rows == 1) {
                if ($new_password == $confirm_password) {
                  $query = "UPDATE users SET password='".$new_password."' WHERE id =".$_SESSION['contact_id'];

                   $result= $connection->query($query);
                   if($result){
                      $message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Password Changed successfully.</div>';
                   }else {
                      $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> There was error while adding record.</div>';  
                   } 
                } else {
                  $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Confirm Password does not match.</div>';  
               } 
              }else {
                  $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Old Password does not match.</div>';  
               }  


             
          }
        }
     ?>
    <div class="row mt-5 mr-0">
      <div class="col-lg-4 col-md-4 col-sm-4 col-2 "></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-8  border text-center mb-5">
        <h4 class="text-center text-info mt-5">Change Password</h4>
        <form class="mt-5"  action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <?php echo $message; ?>
          <div class="form-group row ">
            <label for="old_password" class="text-left col-sm-3 col-form-label">Old Password<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control mt-3" id="old_password" name="old_password" placeholder="Old Password*">
            </div>
          </div>
          <div class="form-group row ">
            <label for="new_password" class="text-left col-sm-3 col-form-label"><small>New Password </small><span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control mt-3" id="new_password" name="new_password" placeholder="New Password*">
            </div>
          </div>
          <div class="form-group row ">
            <label for="confirm_password" class="text-left col-sm-3 col-form-label"><small>Confirm New Password </small><span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control mt-3" id="confirm_password" name="confirm_password" placeholder="Confirm New Password*">
            </div>
          </div>
          <button type="submit" name="update" class="btn btn-lg btn-primary mb-2 px-5">CHANGE</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
