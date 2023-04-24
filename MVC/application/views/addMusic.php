<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Music</title>
  <link rel="stylesheet" href="/assets/css/addMusic.css">
  <script src="/assets/js/validate.js"></script>
</head>

<body>
  <?php include "components/header.php"; ?>
  <main>
    <div class="cover">
      <div class="wrapper">
        <div class="contain">
          <div class="text">
            <h2 class="heading">ADD MUSIC</h2>
            <div style="text-align:center;">
              <div id="corrSub">
                <?php
                if (isset($GLOBALS["checkUploadStatus"]) && $GLOBALS["checkUploadStatus"] == true) {
                  echo "Song Uploaded Successfully";
                }
                ?>
              </div>
            </div>
            <form action="/dashboardController/addMusic" method="post" enctype="multipart/form-data">
              <div class="flex">
                <div class="login-sec">
                  <label for="First name">Audio Name</label><br>
                  <input type="text" placeholder="Audio Name" name="audioName" required>
                </div>
                <div class="login-sec">
                  <label for="Email">Singer Name</label><br>
                  <input type="text" placeholder="Singer Name" name="singerName" required>
                </div>
              </div>
              <div class="flex">
                <div class="login-sec">
                  <label for="Audio File">Audio File</label><br>
                  <input type="file" name="audioFile">
                  <div id="corrSub">
                    <?php
                    if (isset($GLOBALS["audioErr"]) && isset($GLOBALS["audioStatus"]) && $GLOBALS["audioStatus"] == 0) {
                      echo $GLOBALS['audioErr'];
                    }
                    ?>
                  </div>
                </div>

                <div class="login-sec">
                  <label for="Cover Picture">Cover Picture</label><br>
                  <input type="file" name="coverPic">
                  <div id="corrSub">
                    <?php
                    if (isset($GLOBALS["imgErr"]) && isset($GLOBALS["imgStatus"]) && $GLOBALS["imgStatus"] == 0) {
                      echo $GLOBALS['imgErr'];
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="flex">
                <p>Genre :</p>
                <div class="login">
                  <input type="checkbox" name="Genre[]" value="Pop">
                  <label for="Pop">Pop</label>
                  <input type="checkbox" name="Genre[]" value="Hip-Hop">
                  <label for="hiphop">Hip hop</label>
                  <input type="checkbox" name="Genre[]" value="Rock">
                  <label for="Rock">Rock</label>
                  <input type="checkbox" name="Genre[]" value="Soul">
                  <label for="Soul">Soul</label>
                </div>
              </div>
              <br>
              <div class="btn">
                <input type="submit" value="UPLOAD" class="login-btn" id="register" name='save'>
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