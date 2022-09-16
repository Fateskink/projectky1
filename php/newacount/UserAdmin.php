<?php
    class User{
        public function __construct(
            public string $email,
            public int $phone,
            public string $password,
            public int $admin,
        ){ }
    }
?>