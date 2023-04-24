<?php
  class dashboardController extends framework {
    
    /**
     * Function to display dashboard.
     */
    public function show() {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $_SESSION['Nname'];
        $this->model('dashboardModel');
        $getPic = new dashboardModel;
  
        $this->view("Dashboard");
      } else {
        header("location: /loginController/showlogin");
      }
    }
  
    /**
     * Function to loadmore pagination vai ajax.
     */
    public function loadMore() {
      $this->model('dashboardModel');
      $getPic = new dashboardModel;
      $GLOBALS['data'] = $getPic->getCoverPic();
      if (!is_string($GLOBALS['data'])) {
        echo $this->view("loadMoreData");
      } else {
        echo $GLOBALS['data'];
      }
    }
  
    /**
     * Function to display add music page.
     */
    public function showAddMusic() {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $this->view("addMusic");
      } else {
        header("location: /loginController/showlogin");
      }
    }
  
    /**
     * Function to display user profile.
     */
    public function showUserProfile() {
      session_start();
      $this->model("dashboardModel");
      $data = new dashboardModel;
      if (isset($_SESSION['LoggedIN'])) {
        $this->view("userProfile");
      } else {
        header("location: /loginController/showlogin");
      }
    }
  
    /**
     * Function to signout.
     * It redirects to login page.
     */
    public function signOut() {
      session_start();
      session_unset();
      session_destroy();
      header("location: /loginController/showlogin");
  
    }
  
    /**
     * Function to change user details via php .
     * It pops up success or error messafe depending on the result
     */
    public function ChangeUserDetails() {
      if ($_POST['save']) {
        session_start();
        $this->model("dashboardModel");
        $changes = new dashboardModel;
        $changes->ChangeUserInformation($_SESSION['email'], $_POST['email'], $_POST['number'], $_POST['interests']);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['PhoneNumber'] = $_POST['number'];
        $_SESSION['interests'] = $_POST['interests'];
        $GLOBALS["status"] = $changes->changeStatus;
        $this->view("userProfile");
      }
    }
  
    /**
     * Function to add music.
     * It adds music in database.
     * It checks all errors
     */
    public function addMusic() {
      if (isset($_POST['save'])) {
        $this->model("dashboardModel");
        $addFiles = new dashboardModel;
        $checkbox1 = $_POST['Genre'];
        $chk = "";
        foreach ($checkbox1 as $chk1) {
          $chk .= $chk1 . " ";
        }
        $addFiles->addMusicInfo($_POST['audioName'], $_POST['singerName'], $_FILES['audioFile'], $_FILES['coverPic'], $chk);
  
        $GLOBALS['imgErr'] = $addFiles->imgErr;
        $GLOBALS['audioErr'] = $addFiles->audioErr;
        $GLOBALS['imgStatus'] = $addFiles->imgUploadOk;
        $GLOBALS['audioStatus'] = $addFiles->audioUploadOk;
        $GLOBALS['uploadErr'] = $addFiles->uploadErr;
        $GLOBALS['checkUploadStatus'] = @$addFiles->checkUpload;
  
        $this->view("addMusic");
      }
    }
  
    /**
     * Function to display and play songs.
     * It loads a new page where user can play song.
     * Add favourate and delete favourate functionalities also provided here.
     */
    public function playMusic($data) {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $this->model("dashboardModel");
        $songInfo = new dashboardModel;
        $GLOBALS['details'] = $songInfo->playSong($data);
        $_SESSION['alreadyFavourate'] = $songInfo->checkFavourate($_SESSION['UserNumber'], $data);
        $this->view("PlayMusic");
      } else {
        header("location: /loginController/showlogin");
      }
    }
  
    /**
     * Function to display favourates page.
     * It loads a new page where we can see all the favourates.
     * Can also play song and remove from favourates(if want).
     */
    public function showFavourates() {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $this->model("dashboardModel");
        $val = new dashboardModel;
        $GLOBALS['details'] = $val->addFavourateInfo($_SESSION['UserNumber']);
  
        $this->view("favourates");
      } else {
        header("location: /login/showlogin");
      }
    }
  
    /**
     * Function to add song to favourates.
     * On click the color of the heart changes to red(via ajax).
     */
    public function addfavourates() {
      $this->model('dashboardModel');
      $addFavourate = new dashboardModel;
      echo $addFavourate->AddFavourate($_POST['UserID'], $_POST['MusicID']);
  
    }
  
    /**
     * Function to remove song from favourates.
     * On click the color of the heart changes to hollow(via ajax).
     */
    public function deletefavourates() {
      $this->model('dashboardModel');
      $deleteFavourate = new dashboardModel;
      echo $deleteFavourate->deleteFavourate($_POST['UserID'], $_POST['MusicID']);
    }
  }

?>

