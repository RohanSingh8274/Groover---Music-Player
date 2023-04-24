<?php

class registerModel
{
  public string $servername = "localhost";
  public string $dbusername = "root";
  public string $dbpassword = "Anju@8274";
  public string $dbname = "MusicPlayer";
  public string $fnameErr = '';
  public string $LnameErr = '';
  public string $EmailErr = '';
  public string $NumErr = '';
  public string $AgeErr = '';
  public string $passErr = '';
  public string $RefisErr = '';
  public bool $checkSubmit = false;

  /** 
   * A common function which will check the data coming from input tag.It checks trim,stripslashes,htmlspecialcharacter.
   * 
   *  @param string $data
   *    input data
   */
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  /**
   * Function to validate firstname. 
   * 
   *  @param string $firstName
   *    user's first name.
   */
  function firstNameValid($firstName) {
    $fname = $this->test_input($firstName);
    if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
      $this->fnameErr = '* Only letters and white spaces allowed';
      return false;
    } else {
      $this->fnameErr = '';
      return true;
    }
  }

  /**
   * Add note function to add note. 
   * 
   *  @param string $lastName
   *    user's mobile number
   */
  function lastNameValid($lastName) {
    $lname = $this->test_input($lastName);
    if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
      $this->LnameErr = '* Only letter and white space allowed';
      return false;
    } else {
      $this->LnameErr = '';
      return true;
    }
  }

  /**
   * Function to validate email id. 
   * 
   *  @param string $email
   *    user's email.
   */
  function emailValid($email) {
    $mailId = $this->test_input($email);
    if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mailId)) {
      $this->EmailErr = '* Not a valid email';
      return false;
    } else {
      $this->EmailErr = '';
      return true;
    }

  }

  /**
   * Function to validate number. 
   * 
   *  @param string $mobileNumber
   *    user's mobile number
   */
  function numberValid($mobileNumber) {
    $number = htmlspecialchars($mobileNumber);
    if (!preg_match('/^[+][9][1]?[6-9]\d{9}$/', $number)) {
      $this->NumErr = '* Not a valid number';
      return false;
    } else {
      $this->NumErr = '';
      return true;
    }
  }

  /**
   * Function to validate age. 
   * 
   *  @param string $age
   *    user's age
   */
  function ageValid($age) {
    $age = htmlspecialchars($age);
    if (!preg_match('/^(100|[1-9][0-9]?)$/', $age)) {
      $this->AgeErr = '* Not a valid age';
      return false;
    } else {
      $this->AgeErr = '';
      return true;
    }
  }

  /**
   * Function to validate password. 
   * 
   *  @param string $password
   *    user's password.
   */
  function passwordValid($password) {
    $pass = htmlspecialchars($password);
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/', $pass)) {
      $this->passErr = '* Not a valid password';
      return false;
    } else {
      $this->passErr = '';
      return true;
    }
  }

  /** 
   * This function checks if the database is successfully connected or not. 
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
   * Function to check registration.
   * 
   *  @param string $fname
   *    User's firstname.
   * 
   *  @param string $lname
   *    User's lastname.
   * 
   *  @param string $email
   *    User's unique email.
   * 
   *  @param string $phone
   *    User's mobile number.
   * 
   * @param string $nname
   *    User's nick name.
   * 
   * @param string $age
   *    User's age.
   * 
   *  @param string $pass
   *    User's password.
   * 
   * @param string $interests
   *    genre selections.
   */
  function register($fname, $lname, $email, $phone, $nname, $age, $pass,$interests) {
    $this->firstNameValid($fname);
    $this->lastNameValid($lname);
    $this->emailValid($email);
    $this->numberValid($phone);
    $this->ageValid($age);
    $this->passwordValid($pass);

    if (($this->firstNameValid($fname) == true) && ($this->lastNameValid($lname) == true) && ($this->emailValid($email) == true) && ($this->numberValid($phone) == true) && ($this->ageValid($age) == true) && ($this->passwordValid($pass) == true)) {
      $conn = $this->checkConnection();
      $stmt = $conn->prepare("INSERT INTO userInfo(fname,lname,email,PhoneNumber,Nname,Age,Password,interests) VALUES (?,?,?,?,?,?,?,?)");
      $stmt->bind_param('sssssiss', $fname, $lname, $email, $phone, $nname, $age, $pass ,$interests);

      $query1 = "SELECT email FROM userInfo where email = '" . $email . "';";
      $res = $conn->query($query1);

      $num1 = mysqli_num_rows($res);
      if ($num1 == 0) {
        if ($stmt->execute()) {
          $this->RefisErr = '';
          $this->checkSubmit = true;
          $stmt->close();
          $conn->close();
          return true;
        } else {
          $this->RefisErr = '* Unable to execute';
          $stmt->close();
          $this->$conn->close();
          return false;
        }
      } else {
        $this->RefisErr = '* Email Already in use!! <br> try with another email';
        $stmt->close();
        $this->$conn->close();
        return false;
      }
    } else {
      $this->RefisErr = '* Error sending Data to database';
    }

  } 
}

?>

