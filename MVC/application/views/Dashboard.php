<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomePage</title>
  <link rel="stylesheet" href="/assets/css/Dashboard.css">
  
</head>

<body>
  <?php include "components/header.php"; ?>
  <main>
    <div class="cover">
      <div class="container">
        <div class="wrapper">
          <div class="shadow">
            <div class="text">
              <h1>Groover</h1>
              <p>Music according to mood</p>
              <p>Find the best music , beat by beat</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cover1">
      <div class="container">
        <div class="songs">
          <ul id="page">
            <!-- ajax code  -->
          </ul>
        </div>
      </div>
    </div>
  </main>
  <?php include "components/footer.php"; ?>
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="/assets/js/loadMore.js"></script>
</body>

</html>
