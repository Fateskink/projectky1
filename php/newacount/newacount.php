<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=vietnamese"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/font/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>

<?php
    require './loadData.php';
    function checkUser($email,$connection){
        try{
            $statement=$connection->prepare('
                SELECT COUNT(*) AS total_Row FROM projectNhom1_users 
                WHERE email=:email
            '
            );
            $statement->bindParam(':email',$email,PDO::PARAM_STR);
            $statement->execute();
            $users=$statement->fetchAll();
            return $users[0]['total_Row']>0;
        }catch(PDOException $e){
            echo "haha1";
            echo $e->getMessage();
            return false;
        }
    }
    function checkPhone($phone,$connection){
        try{
            $statement=$connection->prepare('
                SELECT COUNT(*) AS total_Row FROM projectNhom1_users 
                WHERE phone=:phone
            '
            );
            $statement->bindParam(':phone',$phone,PDO::PARAM_STR);
            $statement->execute();
            $phones=$statement->fetchAll();
            return $phones[0]['total_Row']>0;
        }catch(PDOException $e){
            echo "haha2";
            echo $e->getMessage();
            return false;
        }
    }
?>


<?php
        $mes="";
        if(isset($_POST['Registration'])){
        $email=htmlspecialchars($_POST['email']);
        $phone=htmlspecialchars($_POST['phone']);
        $password=htmlspecialchars($_POST['password']);
        $passwordTwo=htmlspecialchars($_POST['passwordTwo']);

        try{
            // ??o???n n??y n???u ch??a t???n t???i user th?? m???i nh???y v??o ????? upload d??? li???u l??n sql
            if(checkUser($email,$connection)== TRUE || checkPhone($phone,$connection)== TRUE){
                $mes= "<h1> ???? t???n t???i user</h1>";
            }else if($password!=$passwordTwo){
                $mes= "<h1>password kh??ng kh???p</h1>";
            }else{
                $statement=$connection->prepare('
                INSERT INTO projectNhom1_users (email,phone,password) VALUES (:email,:phone,:password_Hash)
                '
            );
            $statement->bindParam(':email',$email,PDO::PARAM_STR);
            $statement->bindParam(':phone',$phone,PDO::PARAM_INT);
            $password_hash=sha1($password)."";
            $statement->bindParam(':password_Hash',$password_hash,PDO::PARAM_STR);
            $statement->execute();
            $mes= "<h1>th??m th??nh c??ng</h1>";
            }
        }catch(PDOException $e){
            echo "haha3";
            echo $e->getMessage();
        }
    }

?>
<body>
<div class="modal js-modal">
    <div class="modal__overlay ">

    </div>
    <div class="modal__body">
        <!-- register form-->
        <div class="auth-form register">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heeading">????ng k??</h3>
                    <span class="auth-form__switch-btn js-open-login">????ng Nh???p</span>
                </div>

                <form action="./newacount.php" method="post" class="auth-form__form" >
                    <section class="auth-form__group">
                        <input type="text" class="auth-form__input" placeholder="Nh???p email c???a b???n" name="email"/>
                    </section>
                    <section class="auth-form__group">
                        <input type="text" class="auth-form__input" placeholder="Nh???p s??? ??i???n tho???i c???a b???n" name="phone"/>
                    </section>
                    <section class="auth-form__group">
                        <input type="password" class="auth-form__input" placeholder="M???t kh???u c???a b???n" name="password"/>
                    </section>
                    <section class="auth-form__group">
                        <input type="password" class="auth-form__input" placeholder="Nh???p l???i m???t kh???u c???a b???n" name="passwordTwo"/>
                    </section>
                    <section class="auth-form__checkbox">
                        <input type="checkbox" name="checked" />
                        <label for="checked" class="auth-form__checker-text"> ????ng k?? v?? ????ng ?? v???i
                            <a href="" class="auth-form__link">??i???u kho???n</a>
                            c???a Gara
                            <a href="" class="auth-form__link">Fast & Furious fast 9</a>
                        </label>
                    </section>
                    <div class="auth-form__controls">
                        <button class="btn auth-form__back js-modal-close">TR??? L???I</button>
                        <button type="submit" class="btn btn-primary" name="Registration">????NG K??</button>
                    </div>
                </form>
            </div>
            <div class="auth-form__socicals">
                <a href="" class="btn btn--with-icon">
                    <i class="fa-brands fa-facebook"></i>
                    <p>K???t n???i t???i Facebook</p>
                </a>
                <a href="" class="btn btn--with-icon">
                    <i class="fa-brands fa-twitter"></i>
                    <p>K???t n???i t???i Zalo</p>
                </a>
            </div>
        </div>
    </div>
</div>
    <?php echo "<h1>$mes</h1>";?>
</body>
</html>