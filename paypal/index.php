<?php
// Start the session
session_start();

// Include configuration file 
include_once 'config.php'; 

$totalPrice   = '';
$product_name = '';
$itemNumber   = date("His").rand(1234, 9632);

if ( isset( $_GET['payer_fname'] ) ) { 
    $payerNmae        = $_GET['payer_fname'];
    $payerEmail       = $_GET['payer_email'];
    $phone            = $_GET['phone'];
    $product_quantity = $_GET['product_quantity'];
    $product_name     = $_GET['product_name'];

    if ( $product_name == 'FrontSeat' ) {
        $totalPrice = $product_quantity * 99;
    } elseif ( $product_name == 'MiddleSeat' ) {
        $totalPrice = $product_quantity * 199;
    } elseif ( $product_name == 'BackSeat' ) {
        $totalPrice = $product_quantity * 299;
    } elseif ( $product_name == 'VIP' ) {
        $totalPrice = $product_quantity * 399;
    }

    // Set session variables
    $_SESSION["payer_fname"]      = $payerNmae;
    $_SESSION["payer_email"]      = $payerEmail;
    $_SESSION["phone"]            = $phone;
    $_SESSION["product_quantity"] = $product_quantity;
    $_SESSION["product_name"]     = $product_name;
    $_SESSION["totalprice"]       = $totalPrice;
    $_SESSION["item_number"]      = $itemNumber;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- PayPal payment form for displaying the buy button -->
<form action="<?php echo PAYPAL_URL; ?>" method="post" style="display:none;">
    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
    
    <!-- Specify a Buy Now button. -->
    <input type="hidden" name="cmd" value="_xclick">
    
    <!-- Specify details about the item that buyers will purchase. -->
    <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
    <input type="hidden" name="item_number" value="<?php echo $itemNumber; ?>">
    <input type="hidden" name="amount" value="<?php echo $totalPrice; ?>">
    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
    
    <!-- Specify URLs -->
    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
    
    <!-- Display the payment button. -->
    <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
</form>

<script>
    /*------------Payple Redirect btn------------*/
    $(document).ready(function() {
        $('form').submit();
    });
</script>