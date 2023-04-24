<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Player</title>
  <link rel="stylesheet" href="/assets/css/playMusic.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<?php
$Coverconcat = '/' . $GLOBALS['details'][0]['coverPic'];
$Songconcat = '/' . $GLOBALS['details'][0]['audioFile'];
?>

<body>
  <?php include "components/header.php"; ?>
  <main>
    <div class="cover">
      <div class="img">
        <img src="<?php echo $Coverconcat; ?>" alt="Img">
      </div>
      <div class="text">
        <div class="flex">
          <div class="SongInfo">
            <h2>
              <?php echo $GLOBALS['details'][0]['audioName']; ?>
            </h2>
            <h4>
              <?php echo $GLOBALS['details'][0]['singer']; ?>
            </h4>
          </div>
          <div>
            <?php
            if ($_SESSION['alreadyFavourate']) {
              ?>
              <button id="addFavourate"><i class="fa-solid fa-heart"></i></button>
              <?php
            } else {
              ?>
              <button id="addFavourate"><i class="fa-regular fa-heart"></i></button>
              <?php
            }
            ?>
          </div>
        </div>
        <audio controls>
          <source src="<?php echo $Songconcat; ?>" type="audio/mpeg">
          You're browser is Outdated . Please Update The Browser
        </audio>
      </div>
    </div>
  </main>
  <?php include "components/footer.php"; ?>

</body>
<script>
  var check = false;

  $(document).ready(function () {
    console.log(check);
    $("#addFavourate").click(function (e) {
      e.preventDefault();

      var userId = <?php echo $_SESSION['UserNumber']; ?>;
      var musicId = <?php echo $GLOBALS['details'][0]['numberOfSongs'] ?>;
      if (check == false) {
        $.ajax({
          url: "/dashboardController/addfavourates",
          type: "POST",
          data: { UserID: userId, MusicID: musicId },
          success: function (data) {

          }
        });
        $("i").addClass("fa-solid");
        check = true;
      } else {
        $.ajax({
          url: "/dashboardController/deletefavourates",
          type: "POST",
          data: { UserID: userId, MusicID: musicId },
          success: function (data) {

          }
        });
        $("i").removeClass("fa-solid");
        $("i").addClass("fa-regular");
        check = false;
      }
    });
  });
</script>

</html>

<!-- toggleClass("fa-solid") -->