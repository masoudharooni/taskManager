<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MH | TODO - AUTH Form</title>
    <link rel="shortcut icon" href="assets/img/favIcon2.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= siteUrl("assets/css/auth-style.css") ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            <input type="submit" class="button clickable" value="Sign In">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="">MH | TODO</a>
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
                            <input type="submit" class="button clickable" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Masoud | TODO</a>
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
    <!-- partial -->

</body>

</html>