<?php
session_start();
session_regenerate_id(true);
include 'com/connection.php';

//$accounts = [[
//    'id' => '1',
//    'email' => 'admin@gmail.com',
//    'password' => '12345678',
//    'level' => 'admin'
//], [
//    'id' => '2',
//    'email' => 'financeadmin@gmail.com',
//    'password' => '123456',
//    'level' => 'user'

//], [
//    'id' => '3',
//    'email' => 'marketingadmin@gmail.com',
//    'password' => '1234',
//    'level' => 'user'

//]];


//if (isset($_POST['email']) && isset($_POST['password'])) {
//    foreach ($accounts as $accounts) {
//        if (
//            $accounts['email'] == $_POST['email'] &&
//            $accounts['password'] == $_POST['password'] &&
//            $accounts['level'] == $_POST['level']
//        ) {
//            $_SESSION['email'] == $_POST['email'];
//            if ($accounts['level'] == 'admin') {
//                header("Location: admin.php");
//            } else {
//                header("Location: user.php");
//            }
//            exit;
//        }
//    }
//}

require_once "com/function.php";

if (isset($_POST['masuk'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $opt = htmlspecialchars($_POST['lvl']);

    if ($opt == '2') {
        $query = "SELECT * FROM user WHERE email = ?";
    } else if ($opt == "3") {
        $query = "SELECT * FROM user WHERE email = ?";
    } else {
        header("Location: index.php");
        die();
    }
    $result = $db->prepare($query);
    $result->bindParam(1, $email);
    $result->execute();

    $autentication = false;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        if ($row['password'] == $_POST['password']) {
            if ($opt == "2" && $row['id_level'] == $opt) {
                $autentication = true;
                $_SESSION['email'] = $row['email'];
                header("Location: user.php");
                die();
            } else if ($opt == "3" && $row['id_level'] == $opt) {
                $autentication = true;
                $_SESSION['emailAdmin'] = $row['email'];
                header("Location: admin.php");
                die();
            }
        }
    }
}

if (isset($_SESSION['email'])) {
    header("Location: user.php");
    exit();
}
if (isset($_SESSION['emailAdmin'])) {
    header("Location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="assets/admin/img/ppkd.jpg" alt="" width="100%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hello!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <select name="level" id="" class="form-control">
                                                <option value="">Pilih Level</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                        <button name="login" type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/admin/js/sb-admin-2.min.js"></script>

</body>

</html>