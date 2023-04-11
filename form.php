<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sent_email($e_mail, $fbody)
{
//Load Composer's autoloader
require 'vendor/autoload.php';
//Create an instance; passing `true` enables exceptions

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jindal@navdesign.online';                     //SMTP username
    $mail->Password   = 'Easytowin12#';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('jindal@navdesign.online', 'Nav Jindal');
    $mail->addAddress(''.$e_mail, 'Nav Jindal');     //Add a recipient            
    $mail->addReplyTo(''.$e_mail, 'Nav Jindal');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Testing888';
    $mail->Body    = ''.$fbody;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeMTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php 
$filename = 'resources/pkey.txt';
$num = rand(0,9999);
$fp = @fopen($filename, 'r');

if ($fp) {
    $array = explode("\n", fread($fp, filesize($filename)));
    $pkey = $array[$num];
 }
?>

<?php
$name = $email = $quantity = $address = null;
$nameErr = $emailErr = $quantityErr = $addressErr = null;
$total = 0;
$owner = $customer = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['Submit']))
{
    if(empty($_POST["Fullname"])) {
        $nameErr = 'Please, enter your name';
    } 
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $emailErr = 'Pleaes, enter a correct email';
    }
    if(empty($_POST["quantity"])){
        $quantityErr = 'Please enter a value between 1 and 50';
    }
    if(empty($_POST["Address"])){
        $addressErr = 'Please, provide a address';
    }
    else {
        $name = $_POST["Fullname"];
        $email = $_POST["email"];
        $quantity = $_POST["quantity"];
        $address = $_POST["Address"];
    }
    
    if (!empty($name) && !empty($quantity) && !empty($address) && !empty($email)){
    $total = 20 * $quantity;
    $owner_email = 'blankslate555@proton.me';
    $customer = $name.', you are just one step away from finalizing your order of'.$quantity.'MTP kit+ (worth $'.$total.') <br> Please, click on the below link to finalize your payment: <br> '.$pkey;
    $owner = 'A new order of of '.$quantity.' has been made by'.$name.' for $ '.$total.' only. And her address '.$address.' and the cryto key is '.$pkey;
    sent_email($email, $customer);
    sent_email($owner_email, $owner);
    }    
} 
 
}
?>
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="images/SafeMTP_logo.png">SafeMTP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <!-- <li class="nav-item">
          <a class="nav-link text-right" href="protectyou.php">How we protect you</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link text-right" href="https://www.mahotline.org/" target="_blank">Call the Hotline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-right fw-bold" href="needhelp.php" target="_blank">FAQ's</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="shipaddress container">
    <div class="row justify-content-between">
        <div class="col-md-5">
        <div class="form-heading">
            <h2>Enter Your shipping address</h2>  
            <p>We will never share any of your details</p>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
            <div class="shipaddress-spacing">
                <label for="fullname" class="shipaddress-name">Full Name</label>
                <input type="text" class="shipaddress-input" placeholder="John Doe" name="Fullname" value ='<?php echo $name ?>'><br>
                <span class="error"><?php if(isset($nameErr)) {echo $nameErr;} ?></span>
            </div>

            <div class="shipaddress-spacing">
                <label for="exampleInputEmail1" class="shipaddress-name">Email address</label>
                <input type="email" class="shipaddress-input" placeholder="johndoe@email.com" name="email" value ="<?php echo $email ?>"><br>
                <span class="error"><?php if(isset($emailErr)) echo $emailErr; ?></span>
            </div>

            <div class="shipaddress-spacing">
                <label for="fullname" class="shipaddress-name">Quantity</label>
                <input type="number" class="shipaddress-input" placeholder="1-50" name="quantity" min="1" max="50" value="<?php echo $quantity ?>" ><br>
                <span class="error"><?php if(isset($quantityErr)) echo $quantityErr; ?></span>
            </div>


            <div class="shipaddress-spacing">
                <label for="floatingTextarea" class="shipaddress-name">Address</label>
                <textarea placeholder="Write your full address here" rows="4" name="Address"><?php echo $address ?></textarea>
                <span class="error"><?php if(isset($addressErr)) echo $addressErr; ?></span>
            </div>

            <input type="submit" class="primary-button place-my-order-button" value="Place my order" name="Submit">
        </form>
        </div>

        <div class="col-md-3 summary-section">
            <h4>Summary</h4>
            <div class="summary-item d-flex justify-content-between">
                <div class="summary-item-name">
                    <h5>MTP Kits+</h5>
                    <p>20 kits</p>
                </div>
                <h4><sup class="dollar-sign">$</sup></span><?php echo $total ?></h4>
            </div>
            <div class="summary-total d-flex justify-content-between">
            <h5>Total</h5>
            <h3><span class="dollar-sign">$</span><?php echo $total ?></h3>
            </div>
        </div>
    </div>
</div>
</body>
</html>