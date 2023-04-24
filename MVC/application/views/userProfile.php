<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="/assets/css/userProfile.css">
  <script src="/assets/js/validate.js"></script>
</head>

<body>
  <?php include "components/header.php"; ?>
  <main>
    <div class="cover">
      <div class="wrapper">

        <div class="contain">
          <div class="text">
            <h2 class="heading">USER PROFILE</h2>
            <div id="corrSub">
              <?php if (isset($GLOBALS["status"]) && $GLOBALS["status"] == true) {
                echo "Data Updated Successfully";
              }
              ?>
            </div>
            <form action="/dashboardController/ChangeUserDetails" method="post">
              <div class="flex">
                <div class="login-sec">
                  <label for="First name">First Name</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['Fname'])) {
                    echo $_SESSION['Fname'];
                  } ?>" name="fname" id="fname" onblur="fnameValid()" readonly>
                </div>
                <div class="login-sec">
                  <label for="Last name">Last Name</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['Lname'])) {
                    echo $_SESSION['Lname'];
                  } ?>" name="lname" id="lname" onblur="lnameValid()" readonly>
                </div>
              </div>
              <div class="flex">
                <div class="login-sec">
                  <label for="Email">Email address</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['email'])) {
                    echo $_SESSION['email'];
                  } ?>" name="email" id="email" onblur="emailValid()" required>
                  <div id="emailErr"></div>
                  <div style="color:red;">
                    <?php if (isset($GLOBALS['mailerr'])) {
                      echo $GLOBALS['mailerr'];
                    } ?>
                  </div>
                </div>
                <div class="login-sec">
                  <label for="Number">Contact Number</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['PhoneNumber'])) {
                    echo $_SESSION['PhoneNumber'];
                  } ?>" name="number" id="phone" onblur="phoneValid()" required>
                  <div id="phoneErr"></div>
                  <div style="color:red;">
                    <?php if (isset($GLOBALS['numerr'])) {
                      echo $GLOBALS['numerr'];
                    } ?>
                  </div>
                </div>
              </div>
              <div class="flex">
                <div class="login-sec">
                  <label for="nickname">Nick Name</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['Nname'])) {
                    echo $_SESSION['Nname'];
                  } ?>" name="nname" id="nname" readonly>
                </div>
                <div class="login-sec">
                  <label for="Age">Age</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['Age'])) {
                    echo $_SESSION['Age'];
                  } ?>" name="age" id="age" readonly>
                </div>
              </div>
              <div class="flex" style="justify-content:center;">
                <div class="login-sec">
                  <label for="interests">Interests</label><br>
                  <input type="text" value="<?php if (isset($_SESSION['interests'])) {
                    echo $_SESSION['interests'];
                  } ?>" name="interests" required>

                </div>
              </div>
              <br>
              <div class="btn">
                <input type="submit" value="SAVE" class="login-btn" id="register" name='save'>
                <div style="color:red;">
                  <?php if (isset($GLOBALS['regiserr'])) {
                    echo $GLOBALS['regiserr'];
                  }
                  ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include "components/footer.php"; ?>
</body>

</html>