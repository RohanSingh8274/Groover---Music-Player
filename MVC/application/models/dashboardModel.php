<?php
  class dashboardModel {
    public string $servername = "localhost";
    public string $dbusername = "root";
    public string $dbpassword = "Anju@8274";
    public string $dbname = "MusicPlayer";
    public bool $changeStatus = false; //for user profile update
    public string $imageInfo = ""; //variable to store image information
    public string $imgErr = ""; //variable to store error message if any error is returned via imgValid function
    public bool $imgUploadOk = 1; //variable to store Image vaidation and storing status
    public string $audioInfo = ""; //variable to store audio information
    public string $audioErr = ""; //variable to store error message if any error is returned via audioValid function
    public bool $audioUploadOk = 1; //variable to store audio vaidation and storing status
    public string $uploadErr = '';
    public bool $checkUpload = false;
  
    /** 
     * This function checks if the database is successfully connected or not .
     */
    function checkConnection() {
      //Create connection 
      $conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbname);
      //Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      return $conn;
    }

    /**
     * Function to change the details of user(only email, numbers and interest can be changes by the user). 
     * 
     *  @param string $oldEmail
     *    Song's old email id.
     * 
     *  @param string $email
     *    user's new email id after update.
     * 
     *  @param string $number
     *    user's mobile number.
     * 
     *  @param string $interests
     *    user's interest information.
     */
    public function ChangeUserInformation($oldEmail, $email, $number, $interests) {
      $conn = $this->checkConnection();
      $query1 = 'Update userInfo SET email = "' . $email . '" , PhoneNumber = "' . $number . '" , interests = "' . $interests . '" where email = "' . $oldEmail . '";';
      $res = $conn->query($query1);
      if ($res) {
        $this->changeStatus = true;
      }
  
    }

    /**
     * Function to validate audio. 
     * 
     *  @param string $audio
     *    Song's audio file validation.
     */
    public function AudioValid($audio) {
      $target_dir = "assets/songs/";
      $target_file = $target_dir . basename($audio["name"]);
      $this->audioInfo = $target_file;
      $audioFileType = pathinfo($target_file, PATHINFO_EXTENSION);
      // Check if file already exists
      if (empty($audio["name"])) {
        $this->audioErr = "Select file to upload";
        $this->audioUploadOk = 0;
      } else if (file_exists($target_file)) {
        $this->audioErr = "Sorry, file already exists.";
        $this->audioUploadOk = 0;
      }
      // Check file size in bytes
      else if ($audio["size"] > 5000000000000000000) {
        $this->audioErr = "Sorry, your file is too large.";
        $this->audioUploadOk = 0;
      }
      // Allow certain file formats only .wav, .mp3, .wma, and .mp4 files can be uploaded
      else if (
        $audioFileType != "wav" && $audioFileType != "mp3" && $audioFileType != "wma"
        && $audioFileType != "mp4" && $audioFileType != "mp4"
      ) {
        $this->audioErr = "Sorry, only wav, mp3, wma & mp4 files are allowed.";
        $this->audioUploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      else if ($this->audioUploadOk == 0) {
        $this->audioErr = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
      } else if ($this->audioUploadOk = 1 ) {
        move_uploaded_file($audio["tmp_name"], $target_file);
      } else {
        return $this->audioErr;
      }
    }
  
    /**
     * Function to validate image. 
     * 
     *  @param string $image
     *    Song's cover picture image.
     */
    public function ImgValid($image) {
      $target_dir = "assets/coverPic/";
      $target_file = $target_dir . basename($image["name"]);
      $this->imageInfo = $target_file;
      //storing the file extension in $imageFileType variable
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      // Check if file already exists
      if (empty($image["name"])) {
        $this->imgErr = "Select file to upload";
        $this->imgUploadOk = 0;
      } else if (file_exists($target_file)) {
        $this->imgErr = "Sorry, file already exists.";
        $this->imgUploadOk = 0;
      } else if ($image["size"] > 500000) { // Check file size
        $this->imgErr = "Sorry, your file is too large.";
        $this->imgUploadOk = 0;
      }
      // Allow certain file formats. If required condition doesn't match don't store file in Upload folder
      else if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        $this->imgUploadOk = 0;
        $this->imgErr = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      }
      //if everything is OK.move the file to the upload folder
      else if ($this->imgUploadOk = 1 ) {
        move_uploaded_file($image["tmp_name"], $target_file);
      } else {
        return $this->imgErr;
      }
    }

    /**
     * Function to add the song details in the database. 
     * 
     *  @param string $audioName
     *    name of the song
     * 
     *  @param string $singer
     *    name of singer
     * 
     *  @param string $audioFile
     *    the audio file
     * 
     *  @param string $coverPic
     *    covr picture of the song
     * 
     *  @param string $genre
     *    genres selection
     * 
     */
    public function addMusicInfo($audioName, $singer, $audioFile, $coverPic, $genre) {
      $conn = $this->checkConnection();
      $checkAudio = $this->AudioValid($audioFile);
      $checkImg = $this->ImgValid($coverPic);
      if ($this->audioUploadOk == 1 && $this->imgUploadOk == 1) {
        $stmt = $conn->prepare("INSERT INTO MusicInfo(audioName,singer,audioFile,coverPic,genre) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $audioName, $singer, $this->audioInfo, $this->imageInfo, $genre);
  
        $query1 = "SELECT audioName FROM MusicInfo where audioName = '" . $audioName . "';";
        $res = $conn->query($query1);
  
        $num1 = mysqli_num_rows($res);
        if ($num1 == 0) {
          if ($stmt->execute()) {
            $this->uploadErr = '';
            $this->checkUpload = true;
            $stmt->close();
            $conn->close();
            return TRUE;
          } else {
            $this->uploadErr = 'Unable to upload <br> Error : 510';
            $stmt->close();
            $this->$conn->close();
            return FALSE;
          }
        } else {
          $this->uploadErr = 'Song already present in database';
          $stmt->close();
          $this->$conn->close();
          return FALSE;
        }
      }
    }

    /** 
     * Function to get the cover picture details.
     * 
     */
    public function getCoverPic() {
      $conn = $this->checkConnection();
      $limit = 4;
      $page = "";
      if (isset($_POST['page_no'])) {
        $page = $_POST['page_no'];
      } else {
        $page = 0;
      }
      $query1 = 'select * from MusicInfo  LIMIT ' . $page . ', ' . $limit . ';';
      $res = $conn->query($query1);
      $info = [];
      if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res) ) {
          $info[] = $row;
        }
        return $info;
      } else {
        return "No record";
      }
    }
  
    /** 
     * Function to play a song.
     * 
     *  @param string $data
     *    unique song number from musicInfo table.
     * 
     */
    public function playSong($data) {
      $conn = $this->checkConnection();
      $query1 = 'select * from MusicInfo where numberOfSongs = "' . $data . '";';
      $res = $conn->query($query1);
      $SongDetails = [];
  
      while ($info = mysqli_fetch_assoc($res)) {
        $SongDetails[] = $info;
      }
  
      return $SongDetails;
    }
  
    /** 
     * Function to add songs to favourate.
     * 
     *  @param string $userId
     *    user's unique id.
     * 
     *  @param string $MusicId
     *    unique music id for each song.
     */
    public function AddFavourate($userId, $MusicId) {
      $conn = $this->checkConnection();
  
      $stmt = $conn->prepare("Insert into favourates (UserId,MusicId) values (?,?)");
      $stmt->bind_param('ii', $userId, $MusicId);
  
      $query1 = "SELECT * FROM favourates where UserId = '" . $userId . "' and MusicId ='" . $MusicId . "';";
      $res = $conn->query($query1);
  
      $num1 = mysqli_num_rows($res);
      if ($num1 == 0) {
        if ($stmt->execute()) {
          return true;
        } else {
          return false;
        }
      }
    }
  
    /** 
     * Function to check for favourate in the favourates table.
     * 
     *  @param string $userId
     *    user's unique id.
     * 
     *  @param string $MusicId
     *    unique music id for each song.
     */
    public function checkFavourate($userId, $MusicId) {
      $conn = $this->checkConnection();
      $query1 = "SELECT * FROM favourates where UserId = '" . $userId . "' and MusicId ='" . $MusicId . "';";
      $res = $conn->query($query1);
      $num1 = mysqli_num_rows($res);
      return $num1;
    }

    /** 
     * Function to remove songs from favourate.
     * 
     *  @param string $userId
     *    a particular song will be removed from favourates base on $userId.
     * 
     *  @param string $MusicId
     *    a particular song will be removed from favourates base on $MusicId.
     */
    public function deleteFavourate($userId, $MusicId) {
      $conn = $this->checkConnection();
  
      $query1 = ('Delete from favourates where UserId = "'.$userId.'" and MusicId = "'.$MusicId.'"');
      
      $num1 = $this->checkFavourate($userId, $MusicId);
      if ($num1 > 0) {
        if ($conn->query($query1)) {
          return true;
        } else {
          return false;
        }
      }
    }

    /** 
     * Function to display songs details in favourate section.
     * 
     *  @param string $userId
     *    users unique user id.
     */
    public function addFavourateInfo($userId) {
      $conn = $this->checkConnection();
      $query1 = 'SELECT * from favourates f inner join MusicInfo m on f.`MusicId` = m.`numberOfSongs` where `UserId` ='.$userId.';';
      $res = $conn->query($query1);
      $MusicDetails = [];
  
      while ($info = mysqli_fetch_assoc($res)) {
        $MusicDetails[] = $info;
      }
  
      return $MusicDetails;
  
    }
  }

?>

