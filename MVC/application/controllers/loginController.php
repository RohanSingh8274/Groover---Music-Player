<?php
  class loginController extends framework {

    /**
     * Function to display login page.
     */
    function showlogin() {
      $this->view("login");
    }
  
    /**
     * Function to display forget password page.
     */
    public function forgetPassword() {
      $this->view("forgetPassword");
    }
  
    /**
     * Function to validate a valid user.
     */
    public function login() {
      session_start();
      //If already logged in load dashboard.
      if (isset($_SESSION['LoggedIN']) && $_SESSION['LoggedIN']) {
        $this->view("Dashboard");
      }
      if (isset($_POST['login'])) {
        $this->model("loginModel");
        $loginValid = new loginModel;
        $loginValid->login($_POST['email'], $_POST['password']);
        $GLOBALS['number'] = $loginValid->num;

        //If user details found in database ,create session variables and login.
        if ($loginValid->num == 1) {
          $_SESSION['UserNumber'] = $loginValid->info['numberOfUsers'];
          $_SESSION['Fname'] = $loginValid->info['Fname'];
          $_SESSION['Lname'] = $loginValid->info['Lname'];
          $_SESSION['email'] = $loginValid->info['email'];
          $_SESSION['PhoneNumber'] = $loginValid->info['PhoneNumber'];
          $_SESSION['Nname'] = $loginValid->info['Nname'];
          $_SESSION['Age'] = $loginValid->info['Age'];
          $_SESSION['interests'] = $loginValid->info['interests'];
          $_SESSION['LoggedIN'] = true;
  
          $this->model('dashboardModel');
          $getImgInfo = new dashboardModel;
          $imgArr = $getImgInfo->getCoverPic();
          $_SESSION["imgINFO"] = $imgArr;
  
          $this->view("Dashboard");
        } 
        //If details not found redirect to login page.
        else {
          $this->view("login");
        }
      } 
      //If form not submitted redirect to login page.
      else {
        header("location: /loginController/login");
      }
    }
  
    /**
     * Function to add favourates.
     * On click the color of the heart changes to red(via ajax).
     */
    public function resetPasswordPage() {
      $this->view("resetPage");
    }
  
  /**
     * Function to add favourates.
     * On click the color of the heart changes to red(via ajax).
     */
    public function resetPassword() {
      $this->model("loginModel");
  
      if ($_POST['login']) {
        $reset = new loginModel;
  
        $reset->ResetLinkSend($_POST['email']);
        $GLOBALS['checkMailSend'] = $reset->mailSend;
        $GLOBALS['checkMailErrMessage'] = $reset->mailSendFailErr;
        $GLOBALS["passReset"] = $reset->passReset;
        $this->view("forgetPassword");
      }
    }
  
    /**
     * Function to add favourates.
     * On click the color of the heart changes to red(via ajax).
     */
    public function changePassword() {
      $this->model("loginModel");
      if ($_POST['login']) {
        $change = new loginModel;
  
        $change->passResetValid($_POST['email'], $_POST['password']);
        $GLOBALS["passResetErr"] = $change->passResetErr;
  
        $this->view("resetPage");
      }
    }
  }

?>

