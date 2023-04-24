<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Your Password</title>
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
            <?php if (isset($GLOBALS['checkMailSend']) && $GLOBALS['checkMailSend'] == true) {
              echo "Successfully Send";
            }else if(isset($_POST['checkMailErrMessage'])){
              echo $GLOBALS['checkMailErrMessage'];
            }
            ?>
          </div>
        <form action="/login/ControllerresetPassword" method="post">
          <div class="login-sec">
            <label for="Email">Email address or username</label><br>
            <input type="text" name="email" placeholder="Email address or username" id="email" onblur="emailValid()" required>
            <div id="emailErr"></div>
            <div style="color:red;">
              <?php if (isset($GLOBALS['passReset'])) {
                echo $GLOBALS['passReset'];
              } ?>
            </div>
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