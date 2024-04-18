<?php 
    include "./Model/User.php";
    include "./Model/API.php";
    include "./Model/DBConfig.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="./View/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./View/assets/css/templatemo.css">
    <link rel="stylesheet" href="./View/assets/css/custom.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="./View/assets/css/fontawesome.min.css">
</head>
<body>
   <?php 
      include_once './View/header.php';
   ?>


   <?php 
        $action = 'home';
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        include_once "./Controller/$action.php";
   ?>

   <?php 
      include_once './View/footer.php';
   ?>
   
   <!-- Start Script -->
   <script src="./View/assets/js/jquery-1.11.0.min.js"></script>
    <script src="./View/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="./View/assets/js/bootstrap.bundle.min.js"></script>
    <script src="./View/assets/js/templatemo.js"></script>
    <script src="./View/assets/js/custom.js"></script>
    <script src="ajax/login.js"></script>
    <script src="ajax/User.js"></script>

    <!-- End Script -->

</body>

</html>
