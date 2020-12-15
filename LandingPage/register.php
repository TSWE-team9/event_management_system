<?php
session_start();

// initializing variables
$email    = "";
$errors_t = array();
$errors_v = array();
$minage = 18;
// connect to the database
$db = mysqli_connect('132.231.36.109', 'dbuser', 'dbuser123', 'vms_db');


// REGISTER USER
if (isset($_POST['reg_user_t'])) {
    // receive input values from form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['passwort_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['passwort_2']);
    $bdate = mysqli_real_escape_string($db, $_POST['geburtsdatum']);
    $v_name = mysqli_real_escape_string($db, $_POST['vorname']);
    $n_name = mysqli_real_escape_string($db, $_POST['nachname']);
    $geschlecht = mysqli_real_escape_string($db, $_POST['geschlecht']);
    $street = mysqli_real_escape_string($db, $_POST['straße']);
    $hnummer = mysqli_real_escape_string($db, $_POST['hnummer']);
    $plz = mysqli_real_escape_string($db, $_POST['postleitzahl']);
    $ort = mysqli_real_escape_string($db, $_POST['ort']);
    $land = mysqli_real_escape_string($db, $_POST['land']);
    $tel = mysqli_real_escape_string($db, $_POST['telefonnummer']);



    // form validation
    if (empty($email)) { array_push($errors_t, "Email wird benötigt"); }
    if (empty($password_1)) { array_push($errors_t, "Password wird benötigt"); }
    if (empty($password_2)) { array_push($errors_t, "Password wird benötigt"); }
    if (empty($bdate)) { array_push($errors_t, "Geburtsdatum wird benötigt"); }
    if (empty($v_name)) { array_push($errors_t, "Vorname wird benötigt"); }
    if (empty($n_name)) { array_push($errors_t, "Nachname wird benötigt"); }
    if (empty($geschlecht)) { array_push($errors_t, "Geschlecht wird benötigt"); }
    if (empty($street)) { array_push($errors_t, "Straße wird benötigt"); }
    if (empty($hnummer)) { array_push($errors_t, "Hausnummer wird benötigt"); }
    if (empty($plz)) { array_push($errors_t, "Postleitzahl wird benötigt"); }
    if (empty($ort)) { array_push($errors_t, "Ort wird benötigt"); }
    if (empty($land)) { array_push($errors_t, "Land wird benötigt"); }

    if ($password_1 != $password_2) {
        array_push($errors_t, "The two passwords do not match");
    }

    //check age
    $age = date_diff(date_create($bdate), date_create('now'))->y;
    if ($age < $minage){ array_push($errors_t, "You need to be at least 18 years old"); }

    // set email to lowercase and check if email exists
    $email = strtolower($email);
    $user_check_query = "SELECT * FROM Benutzerkonto WHERE E_mail='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['E_mail'] === $email) {
            array_push($errors_t, "email already exists");
        }
    }

    // register user if there are no errors
    if (count($errors_t) == 0) {
        $password = md5($password_1);//encrypt the password

        $query = "INSERT INTO Benutzerkonto
  			  VALUES(B_ID,'$password',2,'$email','$bdate',1)";
        mysqli_query($db, $query);

        $query_t = "INSERT INTO Teilnehmerkonto
  			  VALUES((SELECT B_ID FROM Benutzerkonto where E_mail='$email'),'$v_name','$n_name','$geschlecht','$street','$hnummer','$plz','$ort','$land','$tel',current_date, current_date )";
        mysqli_query($db, $query_t);
        echo "SUCCESS";

        //For redirection
        //$_SESSION['email'] = $email;
        //$_SESSION['success'] = "You are now logged in";
        //header('location: index.php');
    }
}

if (isset($_POST['reg_user_v'])) {
    // receive input values from form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['passwort_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['passwort_2']);
    $bdate = mysqli_real_escape_string($db, $_POST['geburtsdatum']);
    $v_name = mysqli_real_escape_string($db, $_POST['vorname']);
    $n_name = mysqli_real_escape_string($db, $_POST['nachname']);
    $firma = mysqli_real_escape_string($db, $_POST['firmenname']);
    $street = mysqli_real_escape_string($db, $_POST['straße']);
    $hnummer = mysqli_real_escape_string($db, $_POST['hnummer']);
    $plz = mysqli_real_escape_string($db, $_POST['postleitzahl']);
    $ort = mysqli_real_escape_string($db, $_POST['ort']);
    $land = mysqli_real_escape_string($db, $_POST['land']);
    $tel = mysqli_real_escape_string($db, $_POST['telefonnummer']);


    // form validation
    if (empty($email)) { array_push($errors_v, "Email is required"); }
    if (empty($password_1)) { array_push($errors_v, "Password is required"); }
    if (empty($password_2)) { array_push($errors_t, "Password wird benötigt"); }
    if (empty($bdate)) { array_push($errors_v, "Geburtsdatum wird benötigt"); }
    if (empty($v_name)) { array_push($errors_v, "Vorname wird benötigt"); }
    if (empty($n_name)) { array_push($errors_v, "Nachname wird benötigt"); }
    if (empty($firma)) { array_push($errors_v, "Firmenname wird benötigt"); }
    if (empty($street)) { array_push($errors_v, "Straße wird benötigt"); }
    if (empty($hnummer)) { array_push($errors_v, "Hausnummer wird benötigt"); }
    if (empty($plz)) { array_push($errors_v, "Postleitzahl wird benötigt"); }
    if (empty($ort)) { array_push($errors_v, "Ort wird benötigt"); }
    if (empty($land)) { array_push($errors_v, "Land wird benötigt"); }

    if ($password_1 != $password_2) {
        array_push($errors_v, "The two passwords do not match");
    }

    //check age
    $age = date_diff(date_create($bdate), date_create('now'))->y;
    if ($age < $minage){ array_push($errors_v, "You need to be at least 18 years old"); }

    // set email to lowercase and check if email exists
    $email = strtolower($email);
    $user_check_query = "SELECT * FROM Benutzerkonto WHERE E_mail='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['E_mail'] === $email) {
            array_push($errors_v, "email already exists");
        }
    }

    // register user if there are no errors
    if (count($errors_v) == 0) {
        $password = md5($password_1);//encrypt the password

        $query = "INSERT INTO Benutzerkonto
  			  VALUES(B_ID,'$password',1,'$email','$bdate',1)";
        mysqli_query($db, $query);

        $query_v = "INSERT INTO Veranstalterkonto
  			  VALUES((SELECT B_ID FROM Benutzerkonto where E_mail='$email'),'$v_name','$n_name','$firma','$street','$hnummer','$plz','$ort','$land','$tel')";
        mysqli_query($db, $query_v);
        echo "SUCCESS";

        //For redirection
        //$_SESSION['email'] = $email;
        //$_SESSION['success'] = "You are now logged in";
        //header('location: index.php');
    }
}