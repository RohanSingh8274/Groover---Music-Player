<?php
  class registerController extends framework {
    /**
     * Function to display signup page.
     */
    public function register() {
      $this->view("signup");
    }
  
    /**
     * Function to register a user.
     */
    public function check() {
      $this->model("registerModel");
      if ($_POST["register"]) {
        $registers = new registerModel;
        //For ctaking checkbox data as input.
        $checkbox1 = $_POST['Genre'];
        $chk = "";
        foreach ($checkbox1 as $chk1) {
          $chk .= $chk1 . " ";
        }
        $registers->register($_POST["fname"], $_POST["lname"], $_POST["email"], $_POST["number"], $_POST["nname"], $_POST["age"], $_POST["password"], $chk);
       //Variables assigned for future use.
        $GLOBALS['ferr'] = $registers->fnameErr;
        $GLOBALS['lerr'] = $registers->LnameErr;
        $GLOBALS['mailerr'] = $registers->EmailErr;
        $GLOBALS['numerr'] = $registers->NumErr;
        $GLOBALS['ageerr'] = $registers->AgeErr;
        $GLOBALS['passerr'] = $registers->passErr;
        $GLOBALS['regiserr'] = $registers->RefisErr;
        $GLOBALS['checkSubmit'] = $registers->checkSubmit;
        $this->view("signup");
      }
    }
  }

?>

