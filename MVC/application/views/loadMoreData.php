<li>
<div class='flex song' style='color:white;'>
<?php
foreach ($GLOBALS['data'] as $data) {
    $concat = "/" . $data["coverPic"];
    $numberOFSongs = $data['numberOfSongs'];
    $audioName = $data['audioName'];

    ?>
    <a href='/dashboardController/playMusic/<?php echo $numberOFSongs ?>'>
        <img src='<?php echo $concat ?>' alt='Song_Img' class='SongCoverImg'>
        <p>
            <?php echo $audioName ?>
        </p>
    </a>
<?php } ?>
</div>
</li>
<div class='flex loadMore'>
    <button class='ajaxbtn' data-id='<?php echo $numberOFSongs ?>'>Load more</button>
</div>