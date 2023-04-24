<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Favourates</title>
  <link rel="stylesheet" href="/assets/css/favourates.css">
</head>

<body>
  <?php include "components/header.php" ; ?>
  <main>
    <div class="cover">
      <div class="container">
          <div class="flex item">
            <?php
            foreach ($GLOBALS['details'] as $data) {
              $Coverconcat = '/' . $data['coverPic'];
              $audioName = $data['audioName'];
              $numberOFSongs = $data['numberOfSongs'];
              $link = '/dashboardController/playMusic/'.$numberOFSongs ;
              ?>
              <a href="<?php echo $link ?>">
                <img src='<?php echo $Coverconcat; ?>' alt='Song_Img' class='SongCoverImg'>
                <p>
                  <?php echo $audioName; ?>
                </p>
              </a>
              <?php
            }
            ?>
          </div>
      </div>
    </div>
  </main>
  <?php include "components/footer.php" ; ?>
</body>

</html>