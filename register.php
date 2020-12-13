<?php
session_start();

// initializing variables
$email    = "";
$errors = array();
$minage = 18;

// connect to the database
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');


// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive input values from form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $role = mysqli_real_escape_string($db, $_POST['role']);
    $bdate = mysqli_real_escape_string($db, $_POST['bdate']);


    // form validation
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($role)) { array_push($errors, "Rolle is required"); }
    if (empty($bdate)) { array_push($errors, "Bdate is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    //check age
    $age = date_diff(date_create($bdate), date_create('now'))->y;
    if ($age < $minage){ array_push($errors, "You need to be at least 18 years old"); }

    // set email to lowercase and check if email exists
    $email = strtolower($email);
    $user_check_query = "SELECT * FROM Benutzerkonto WHERE E_mail='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['E_mail'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // register user if there are no errors
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password

        $query = "INSERT INTO Benutzerkonto
  			  VALUES(B_ID,'$password','$role','$email','$bdate',1)";
        mysqli_query($db, $query);
        echo "SUCCESS";

        //For redirection
        //$_SESSION['email'] = $email;
        //$_SESSION['success'] = "You are now logged in";
        //header('location: index.php');
    }
}
