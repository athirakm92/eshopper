<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/topbar.php'; ?>


    <?php include 'includes/shop_navbar.php'; ?>


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $total = 0;
                        if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) {
                            foreach ($_SESSION['cart_item'] as $key => $item) {
                                $item_price = $item['quantity'] * $item['price'];
                                $total = $total + $item_price; ?>
                                <tr>
                                    <td class="align-middle">
                                        <a href="detail.php?pid=<?php echo $key; ?>">
                                            <img src="img/watch/<?php echo $item['photo']; ?>" alt="" style="width: 50px;">
                                        </a>
                                        <?php echo $item['product_name']; ?>
                                    </td>
                                    <td class="align-middle">$<?php echo $item['price']; ?></td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <?php echo $item['quantity']; ?>
                                        </div>
                                    </td>
                                    <td class="align-middle">$<?php echo $item_price; ?></td>
                                    <td class="align-middle"><a href="addtocart.php?action=remove&puuid=<?php echo $key; ?>" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        
                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">                
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$<?php echo $total; ?></h6>
                        </div>                       
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$<?php echo $total; ?></h5>
                        </div>
                        <a href="checkout.php" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


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
</body>

</html>