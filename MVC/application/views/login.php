<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="/assets/css/login.css">
  <script src="/assets/js/validate.js"></script>
</head>

<body>
  <div class="cover">
    <div class="wrapper">
      <div class="container">
        <div class="text">
          <div class="flex title ">
            <img src="/assets/img/headimg.jpg" alt="logo_img">
            <h1>Groover</h1>
          </div>
          <div id="corrSub">
            <?php 
            if (isset($_POST['login']) && empty($GLOBALS['number'])) {
              echo "NOT A REGISTERED USER <br> PLEASE REGISTER YOURSELF";
            }
            ?>
          </div>       
          <form action="/loginController/login" method="post">
            <div class="login-sec">
              <label for="Email">Email address or username</label><br>
              <input type="text" name="email" placeholder="Email address or username" id="email" onblur="emailValid()"
                required>
              <div id="emailErr"></div>
            </div>
            <div class="login-sec">
              <label for="Password">Enter Password</label><br>
              <input type="password" name="password" placeholder="Password" id="password" onblur="passwordValid()"
                required>
              <div id="PasswordErr"></div>
            </div>
            <div class="sec">
              <a href="/loginController/forgetPassword">Forgot your password?</a>
            </div>
            <br>
            <div class="btn">
              <input type="submit" value="LOG IN" class="login-btn" id="register" name="login">
            </div>
          </form>
          <div class="flex look">
            <hr>
            <p>or</p>
            <hr>
          </div>
          <div class="askRegister">
            <p>Not a Registered User?</p>
            <div class="anchor">
              <a href="http://assignment4.net/registerController/register" class="AnchorRedirect">SIGN UP</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>