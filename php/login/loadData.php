
<?php
    require '../db_localhost/configuration.php';
    require '../db_localhost/db_connection.php';

    function userAdmin($connection){
        $userAdmins=[
            new User("addmin@gmail.com",987654321,123123,1)
        ];
        $sql_insert_tables=
            '
            INSERT INTO projectNhom1_users(email,phone,password,admin) VALUES (:email, :phone, :password, :admin)
            '
        ;
        $statement =$connection->prepare( $sql_insert_tables);
        foreach($userAdmins as $userAdmin){
            $statement->execute([
                ':email'=>$userAdmin->email,
                ':phone'=>$userAdmin->phone,
                ':password'=>sha1($userAdmin->password)."",
                ':admin'=>$userAdmin->admin,
            ]);
        }
    }
    try{
        if($connection){
            $sql_creat_tables=[
                'USE '.DB_NAME,
                '
                CREATE TABLE IF NOT EXISTS projectNhom1_users(
                ID INT PRIMARY KEY AUTO_INCREMENT,
                email VARCHAR(255) NOT NULL,
                phone INT NOT NULL,
                password VARCHAR(255) NOT NULL,
                admin INT default 0
                )'
                ];
            foreach($sql_creat_tables as $sql_creat_table){
                $connection->exec($sql_creat_table);
            }
            $sql_unique=
            '
            ALTER TABLE projectNhom1_users ADD CONSTRAINT UN_phone UNIQUE (phone);
            ';
            $connection->exec($sql_unique);
            userAdmin($connection);
            echo "successfully";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }    
?>
