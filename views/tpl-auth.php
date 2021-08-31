<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MH | TODO - AUTH Form</title>
    <link rel="shortcut icon" href="assets/img/favIcon2.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= siteUrl("assets/css/auth-style.css") ?>">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Kaito</title>



        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

        <link rel="stylesheet" href="css/style.css">


    </head>
    <link rel="stylesheet" href="css/style.css">

    <body>

        <div class="login-wrap">
            <div class="login-html">
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab clickable">Sign In</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab clickable">Sign Up</label>
                <div class="login-form">

                    <form class="sign-in-htm" action="<?= siteUrl('auth.php?action=login') ?>" method="POST">
                        <div class="group">
                            <label for="user" class="label">Email</label>
                            <input id="user" type="email" class="input" name="email" placeholder="Your Email Adress . . . " autocomplete="off" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" type="password" class="input" name="password" data-type="password" placeholder="Your Password . . ." autocomplete="off" required>
                        </div>
                        <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div>
                        <div class="group">
                            <input type="submit" name="authBtn" class="button clickable" value="Sign In">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <i style="color: #fff;font-family: sans-serif;" class="clickable forgetPass">Forget Password</i>
                        </div>
                    </form>

                    <form class="sign-up-htm" action="<?= siteUrl('auth.php?action=register') ?>" method="POST">
                        <div class="group">
                            <label for="user" class="label">Username</label>
                            <input id="user" type="text" class="input" name="username" placeholder="Your User Name . . . " autocomplete="off" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" type="password" class="input" name="password" data-type="password" placeholder="Your Password . . . " autocomplete="off" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Repeat Password</label>
                            <input id="pass" type="password" class="input" name="rptpassword" data-type="password" placeholder="Repeat Your Password . . ." autocomplete="off" required>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Email Address</label>
                            <input id="pass" type="email" class="input" name="email" placeholder="Your Email Address . . . " autocomplete="off" required>
                        </div>
                        <div class="group">
                            <input type="submit" name="authBtn" class="button clickable" value="Sign Up">
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <!------------------------------------------The External Dependency-------------------------------------------->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    </body>

    </html>
    <!------------------------------------------Password Recovery-------------------------------------------->
    <div id="modal">
        <div id="modalMain">
            <i class="fas fa-times closeIcon clickable"></i>

            <p class="descriptionModal">Your New Password must be Minimum 8-Digit Character and a capital character and a normal character and a number!</p>

            <div class="container">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="col-auto modalEmail">
                        <label class="sr-only" for="inlineFormInputGroup"></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend emailBtn">
                                <div class="input-group-text">Email</div>
                            </div>
                            <input type="text" name="email" class="form-control emailInput" id="inlineFormInputGroup" placeholder="Your Email For Recovery . . . ">
                        </div>
                    </div>

                    <div class="col-auto modalPass">
                        <label class="sr-only" for="inlineFormInputGroup"></label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend passBtn">
                                <div class="input-group-text">Pass</div>
                            </div>
                            <input type="password" name="pass" class="form-control passInput" id="inlineFormInputGroup" placeholder="New Password . . . ">
                        </div>
                    </div>
                    <input name="recoveryBtn" style="display: block;margin: auto;margin-top:20px" type="submit" class="btn btn-primary btn-block" value="Send Email">
                </form>

                <div class="col-auto modalCode">
                    <label class="sr-only" for="inlineFormInputGroup"></label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend codeBtn clickable">
                            <div class="input-group-text">Submit</div>
                        </div>
                        <input type="number" class="form-control codeInput" id="inlineFormInputGroup" placeholder="6-Digit Code . . . " min="100000" max="999999">
                    </div>
                </div>

            </div>


        </div>
    </div>

    <!-- bootstrap cdn -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(".forgetPass").click(function() {
                $("div#modal").fadeIn(1000);
            });

            $(".closeIcon").click(function() {
                $("div#modal").fadeOut(1000);
            });

            $(".codeBtn").click(function() {
                var code = $(".codeInput").val();
                $.ajax({
                    url: "process/ajaxHandler.php",
                    method: "post",
                    data: {
                        action: "codeRev",
                        code: code
                    },
                    success: function(respons) {
                        $(".recoveryPass").html(respons);
                    }
                });
            });

        });
    </script>

</body>

</html>