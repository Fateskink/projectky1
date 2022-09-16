<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/font/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>

<?php
require './loadData.php';
$mes = "";
if (isset($_POST['Login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    try {
        $statement = $connection->prepare('
                SELECT COUNT(*) AS total_Row FROM abc12users 
                WHERE email=:email AND password=:password
            ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $password_Check = sha1($password) . "";
        $statement->bindParam(':password_Hash', $password_Check, PDO::PARAM_STR);
        $statement->execute();
        $users = $statement->fetchAll();
        // nếu có nó sẽ in ra tương ứng với tồn tại rồi trả về true
        // tài khoản này tồn tại tương ứng với phần tử 0
        if ($users[0]['total_Row'] > 0) {
            $mes = "password pair was correct.";
        } else {
            $mes = "Invalid email or password";
        }
    } catch (PDOException $e) {
        echo "haha1";
        echo $e->getMessage();
    }
}


?>

<body>
    <div class="modal js-modal">
        <div class="modal__overlay ">

        </div>
        <div class="modal__body">
            <div class="auth-form login">
                <div class="auth-form__container js-modal-container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heeading">Đăng Nhập</h3>
                        <span class="auth-form__switch-btn">Đăng Ký</span>
                    </div>

                    <form action="./login.php" class="auth-form__form" method="post">
                        <section class="auth-form__group">
                            <input type="text" class="auth-form__input" placeholder="Nhập email của bạn" name="email" />
                        </section>
                        <section class="auth-form__group">
                            <input type="password" class="auth-form__input" placeholder="Mật khẩu của bạn" name="password" />
                        </section>
                        <section class="auth-form__aside">
                            <div class="auth-form__help">
                                <a href="" class="auth-form__help-link auth-form__help-forcos">Quên mật khẩu</a>
                                <span class="auth-form__help-separate"></span>
                                <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
                            </div>
                        </section>
                        <div class="auth-form__controls">
                            <button type="submit" class="btn auth-form__back js-modal-close">TRỞ LẠI</button>
                            <button type="submit" class="btn btn-primary" name="Login">ĐĂNG Nhập</button>
                        </div>
                    </form>

                </div>
                <div class="auth-form__socicals">
                    <a href="" class="btn btn--with-icon">
                        <i class="fa-brands fa-facebook"></i>
                        <p>Kết nối tới Facebook</p>
                    </a>
                    <a href="" class="btn btn--with-icon">
                        <i class="fa-brands fa-twitter"></i>
                        <p>Kết nối tới Zalo</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo "<h1>$mes</h1>"; ?>
</body>

</html>