<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="<?php echo 'images/landing-pic.png'; ?>">
    <title>ProEva</title>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@feathericons/fontawesome@1.0.0/dist/feather.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo 'styles/style.css'; ?>" />
    <!-- JS -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@feathericons/fontawesome@1.0.0/dist/feather.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign In Form -->
                <form action="#" class="sign-in-form">
                    <div class="text-container-landing">
                        <img src="<?php echo 'images/landing-pic.png'; ?>" class="landing-image" alt="">
                    </div>
                    <h2 class="title">Project Monitoring and</h2>
                    <h2 class="title">Evaluation System</h2>
                    <input type="submit" class="btn" value="LOGIN" id="sign-up-btn" />
                </form>

                <!-- Sign In Form -->
                <form action="<?php echo 'login.php'; ?>" method="POST" class="sign-up-form">
                    <h2 class="title login-title">LOGIN</h2>
                    <div class="text-container">
                        <p class="social-text">Enter your existing account to start your progress</p>
                    </div>
                    <label class="label-field" for="email">Email</label>
                    <div class="input-field">
                        <img src="<?php echo 'images/svg/user.svg'; ?>" />
                        <input type="email" id="email" name="email" placeholder="ex: juancarlos@gmail.com" required />
                    </div>
                    <br>
                    <label class="label-field" for="password">Password</label>
                    <div class="input-field-password">
                        <img src="<?php echo 'images/svg/lock.svg'; ?>" alt="Lock Icon" />
                        <input type="password" id="password" name="password" placeholder="Account password" required />
                        <img src="<?php echo 'images/svg/eye.svg'; ?>" id="togglePassword" class="toggle-password" alt="Toggle Password Visibility" />
                    </div>
                    <p class="social-text-text">Forgot password ?</p>
                    <input type="submit" value="Login" class="btn solid" id="login-form"/>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Learn More !</h3>
                    <br><br>
                    <button class="btn transparent" id="sign-up-btn">About</button>
                </div>
                <img src="<?php echo 'images/svg/register.svg'; ?>" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Welcome Back!</h3>
                    <br>
                    <p>Go back to Homepage ?</p>
                    <br>
                    <button class="btn transparent" id="sign-in-btn">Home</button>
                </div>
                <img src="<?php echo 'images/svg/log.svg'; ?>" class="image" alt="" />
            </div>
        </div>
    </div>
</body>
<script src="<?php echo 'scripts/app.js'; ?>"></script>
</html>
