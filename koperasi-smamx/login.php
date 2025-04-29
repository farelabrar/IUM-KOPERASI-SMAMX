<?php
    @ob_start();
    session_start();
    if(isset($_POST['proses'])){
        require 'config.php';
            
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);

        $sql = 'select member.*, login.user, login.pass
                from member inner join login on member.id_member = login.id_member
                where user =? and pass = md5(?)';
        $row = $config->prepare($sql);
        $row -> execute(array($user,$pass));
        $jum = $row -> rowCount();
        if($jum > 0){
            $hasil = $row -> fetch();
            $_SESSION['admin'] = $hasil;
            echo '<script>alert("Login Sukses");window.location="index.php"</script>';
        }else{
            echo '<script>alert("Login Gagal");history.go(-1);</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Koperasi SMAMX</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff5722, #2196f3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            background: white;
        }

        .card-header {
            background: linear-gradient(90deg, #ff5722, #2196f3);
            color: white;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 20px;
        }

        .card-header h4 {
            margin: 0;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ff5722, #2196f3);
            border: none;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #2196f3, #ff5722);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 10px;
            padding-left: 40px;
        }

        .form-group {
            position: relative;
        }

        .form-group .fa {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            display: block;
            border-radius: 50%;
            border: 4px solid #ff5722;
        }

        .card-body {
            padding: 30px;
        }

        .card-body form {
            margin-top: 20px;
        }

        .card-body .form-group input {
            font-size: 1rem;
        }

        .footer-text {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
            color: #555;
        }

        .footer-text a {
            color: #ff5722;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <img src="assets/img/smamx.jpg" alt="Logo Sekolah" class="logo">
                        <h4>Login Koperasi SMAMX</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <div class="form-group mb-3">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" name="user" placeholder="Masukkan User ID" required>
                            </div>
                            <div class="form-group mb-3">
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" name="pass" placeholder="Masukkan Password" required>
                            </div>
                            <button class="btn btn-primary btn-block w-100" name="proses" type="submit">
                                <i class="fa fa-sign-in-alt"></i> Masuk
                            </button>
                        </form>
                        <div class="footer-text">
                            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>