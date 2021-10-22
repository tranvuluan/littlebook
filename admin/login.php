<?php
ob_start();
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../classes/adminlogin.php';
?>

<?php
    $class = new adminlogin();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminUser = $_POST['adminUser'];
    $adminPass = md5($_POST['adminPass']);

    $login_check = $class->login_admin($adminUser, $adminPass);
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../admin/css/styleLogin.css">
    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="login.php" class="sign-in-form" method="POST">
                    <h2 class="title">Sign in</h2>
                    <span>
                        <?php
                        if (isset($login_check))
                        {
                            echo $login_check;
                        }
                    ?>
                    </span>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="adminUser" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="adminPass" />
                    </div>
                    <input type="submit" value="Login" class="btn solid" />                    
                </form>
                
            </div>
        </div>

        
    </div>
    <script src="../js/app.js"></script>
</body>

</html>