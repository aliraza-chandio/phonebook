<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Dashboard | Phonebook Directory </title>
</head>

<body class="bg-secondary">
  <div class="container-fluid px-0">
    <?php require 'menu.php'; ?>
    <div class="row mt-5 mr-0">
      <div class="col-lg-4 col-md-4 col-sm-4 col-12"></div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-12 mt-5">
        <p class="text-center text-info">Total users in your contacts <span class="text-danger"><?php echo $result->num_rows; ?></span></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-12"></div>
    </div>
  </div>
</body>
</html>
