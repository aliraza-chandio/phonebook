<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Add New Contact | Phonebook Directory </title>
</head>
<body class="bg-secondary">
  <div class="container-fluid px-0">
    <?php require 'menu.php'; ?> 

    <?php
    require 'db.php';
    $message = '';
    if(isset($_POST['submit']))
    {
      $name = $_POST['name'];
      $designation = $_POST['designation'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $user_id = $_SESSION['contact_id'];
      if($name == ''  || $phone ==''  ){
         $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Fields marked with * are required</div>';  

      } 
      else 
      {
	        $sql = "INSERT INTO contactdetails(name,designation ,phone,address,user_id) VALUES ('$name','$designation','$phone', '$address', '$user_id')";
	        $result= $connection->query($sql);
	        if($result){
	           $message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Record added successfully.</div>';
	        }else {
		         $message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> There was error while adding record.</div>';  
	        } 
      }
    }
    ?>
    <div class="row mt-5 mr-0">
      <div class="col-lg-4 col-md-4 col-sm-4 col-2 "></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-8  border text-center mb-5">
        <h4 class="text-center text-info mt-5">Add New Contact</h4>

        <form class="mt-5" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <?php echo $message; ?>
          <div class="form-group row mt-5">
            <label for="name" class="text-left col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name*">
              <input type="hidden" name="user_id" value="<?php echo $_SESSION['contact_id']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="designation" class="text-left col-sm-3 col-form-label">Designation</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
            </div>
          </div>
          <div class="form-group row">
            <label for="phone" class="text-left col-sm-3 col-form-label">Phone<span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="int" class="form-control" id="phone" name="phone" placeholder="Phone*">
            </div>
          </div>
          <div class="form-group row">
            <label for="address" class="text-left col-sm-3 col-form-label">Address</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="address" name="address" placeholder="Address">
            </div>
          </div>
          <button type="submit" value="submit" name="submit" class="btn btn-lg btn-primary mb-2 px-5">ADD</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
