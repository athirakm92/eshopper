<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require './vendor/autoload.php';
use Eshop\Login;
use Eshop\Register;

if (isset($_POST['login'])) {
    $login = new Login();
    $result = $login->userLogin($_POST);

    if (!empty($result['success'])) {
        print_r($result);
    }
}

if (isset($_POST['register'])) {
    $register = new Register();
    $result = $register->userRegister($_POST);

    if (!empty($result['success'])) {
        print_r($result);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?> 
<link href="scss/style.scss" rel="stylesheet">

<body>
    <?php include 'includes/topbar.php'; ?>


    <?php include 'includes/shop_navbar.php'; ?>


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Login</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <div class="wrapper ">
      <?php
        if (isset($result) && $result['error'] != '') {
            echo $result['error'];
        }
      ?>
      <div id="formContent" class="logincontainer">
        <!-- Tabs Titles -->
        <h2 id="loginbtn" class="active underlineHover"> Login </h2>
        <h2 id="registerbtn" class="inactive underlineHover">Register </h2>

        <!-- Login Form -->
        <div id="loginblock">
          <form action="" method="post">
            <input type="text" id="email" class=" second" name="email" placeholder="Email">
            <input type="text" id="password" class=" third" name="password" placeholder="password">
            <input type="submit" name="login" class=" fourth" value="Log In">
          </form>
        </div>
        <!-- Register Form -->
        <div id="registerblock" >
          <form action="" method="post">

          <input type="text" id="firstname" class=" second" name="firstname" placeholder="First Name">
          <input type="text" id="lastname" class=" second" name="lastname" placeholder="Last Name">
            <input type="text" id="email" class=" second" name="email" placeholder="Email">
            <input type="text" id="password" class=" third" name="password" placeholder="Password">
          <input type="text" id="phonenumber" class=" second" name="phonenumber" placeholder="Phone Number">
          <input type="text" id="address" class=" second" name="address" placeholder="Address">
            <input type="submit" name="register" class=" fourth" value="Register">
          </form>
        </div>

        <!-- Remind Passowrd -->
        <div id="formFooter">
          <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

      </div>
    </div>


    <!-- Footer Start -->
    <?php include 'includes/footer.php'; ?> 
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
      $(document).ready(function(){

        $("#registerblock").hide();
        $("#loginbtn").click(function(){
          $("#loginblock").show();
          $("#registerblock").hide();
          $( "#loginbtn" ).removeClass( "inactive" ).addClass( "active" );
          $( "#registerbtn" ).removeClass( "active" ).addClass( "inactive" );
        });
        $("#registerbtn").click(function(){
          $("#loginblock").hide();
          $("#registerblock").show();
          $( "#loginbtn" ).removeClass( "active" ).addClass( "inactive" );
          $( "#registerbtn" ).removeClass( "inactive" ).addClass( "active" );
        });
      });
      </script>
</body>

</html>