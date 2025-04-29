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
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --gradient-start: #4361ee;
            --gradient-end: #4cc9f0;
            --text-color: #333;
            --light-text: #7b7b7b;
            --bg-color: #f7f9fc;
            --card-shadow: 0 10px 30px rgba(67, 97, 238, 0.15);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        body:before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            z-index: -1;
            animation: pulse 15s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 0.3;
            }
        }

        .card {
            border: none;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.3s ease;
            max-width: 460px;
            width: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(67, 97, 238, 0.2);
        }

        .card-header {
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            color: white;
            border-radius: 24px 24px 0 0;
            text-align: center;
            padding: 30px 20px;
            position: relative;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }

        .card-header p {
            margin-top: 5px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .logo-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
        }

        .logo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .logo-container:after {
            content: "";
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: pulse-border 2s infinite;
        }

        @keyframes pulse-border {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(1.1);
                opacity: 0;
            }
        }

        .card-body {
            padding: 40px 30px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 25px;
        }

        .welcome-text h5 {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .welcome-text p {
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            height: 55px;
            border-radius: 12px;
            padding-left: 55px;
            font-size: 0.95rem;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            color: var(--text-color);
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
            border-color: var(--primary-color);
            background-color: #ffffff;
        }

        .form-control::placeholder {
            color: #b0b0b0;
            font-size: 0.9rem;
        }

        .form-group .icon {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .form-group:focus-within .icon {
            color: var(--secondary-color);
        }

        .btn-login {
            height: 55px;
            border-radius: 12px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            border: none;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, var(--gradient-end), var(--gradient-start));
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 3px 10px rgba(67, 97, 238, 0.2);
        }

        .btn-login i {
            font-size: 1.1rem;
            transition: transform 0.3s ease;
        }

        .btn-login:hover i {
            transform: translateX(5px);
        }

        .copyright {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .card {
                margin: 0 15px;
            }
            
            .card-body {
                padding: 30px 20px;
            }
            
            .logo {
                width: 100px;
                height: 100px;
            }
            
            .card-header h4 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="logo-container">
                            <img src="assets/img/smamx.jpg" alt="Logo Sekolah" class="logo">
                        </div>
                        <h4>Koperasi SMAMX</h4>
                        <p>Portal Login Sistem Koperasi</p>
                    </div>
                    <div class="card-body">
                        <div class="welcome-text">
                            <h5>Selamat Datang!</h5>
                            <p>Silakan masukkan kredensial Anda untuk melanjutkan</p>
                        </div>
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <i class="fa fa-user icon"></i>
                                <input type="text" class="form-control" name="user" placeholder="Masukkan User ID" required autofocus>
                            </div>
                            <div class="form-group">
                                <i class="fa fa-lock icon"></i>
                                <input type="password" class="form-control" name="pass" placeholder="Masukkan Password" required>
                            </div>
                            <button class="btn btn-login w-100" name="proses" type="submit">
                                Masuk <i class="fa fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        &copy; 2025 Koperasi SMAMX. All rights reserved.
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>