<?php require_once("dbconfig.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
        }
        #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-color: #EAEAEA;
        }
        #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
        }
    </style>

</head>
<body>
<div id="login">
    <div>
        <h2 class="text-center text-white pt-5" >welcome</h2>
    </div>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form action="login_db.php" method="post">
                    <h3 class="text-center text-info">Login</h3>
                        <?php if(isset($_SESSION['error'])) { ?>
                            <div>
                                <h5 class="text-warning" >
                                    <?php
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']); 
                                    ?>
                                </h5>

                            </div>
                        <?php }?>
                        <div class="form-group">
                            <label for="username" class="text-info">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info" >Password </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group" >
                            <button type="submit" name="login_user" class=" btn btn-info btn-md">login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
</body>
</html>