<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password Page</title>
  <link rel="stylesheet" href="/assets/css/passwordReset.css">
  <script src="/assets/js/validate.js"></script>
</head>

<body>
  <div class="cover">
    <div class="container">
      <div class="text">
        <div class="flex title ">
          <img src="/assets/img/headimg.jpg" alt="logo_img">
          <h1>Groover</h1>
        </div>
        <h1 class="heading">Password Reset</h1>
        <div id="corrSub">
          <?php if (isset($_POST['login']) && empty($GLOBALS['passResetErr']) ) {
            echo "Password Changed Successfully.";
          }
          ?>
        </div>
        <form action="/loginController/changePassword" method="post">
          <div class="login-sec">
            <label for="Email">Email address or username</label><br>
            <input type="text" placeholder="Email address or username" name="email" id="email" onblur="emailValid()"
              required>
            <div id="emailErr"></div>
            <div style="color:red;">
              <?php if (isset($GLOBALS['passResetErr'])) {
                echo $GLOBALS['passResetErr'];
              } ?>
            </div>
          </div>
          <div class="login-sec">
            <label for="Password">Create a Password</label><br>
            <input type="password" placeholder="Create Password" name="password" id="password" onblur="passwordValid()"
              required>
            <div id="PasswordErr"></div>
          </div>
          <div class="login-sec">
            <label for="Password">Confirm your Password</label><br>
            <input type="password" placeholder="Confirm your Password" id="confirm_password" onblur="passwordMatch()"
              required>
            <div id="diffPassword"></div>
          </div>
          <div class="btn">
            <input type="submit" value="Confirm" class="login-btn" id="register" name="login">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>