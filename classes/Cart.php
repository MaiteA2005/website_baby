<?php

    namespace Website\XD\Classes;
    include_once(__DIR__ . "/Db.php");
    use \PDO;

    //class Cart
    class Cart
    {
        private $user;
        private $product;
        private $quantity;
        private $total;

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
            return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
            $this->user = $user;

            return $this;
        }

        /**
         * Get the value of product
         */ 
        public function getProduct()
        {
            return $this->product;
        }

        /**
         * Set the value of product
         *
         * @return  self
         */ 
        public function setProduct($product)
        {
            $this->product = $product;

            return $this;
        }

        /**
         * Get the value of quantity
         */ 
        public function getQuantity()
        {
            return $this->quantity;
        }

        /**
         * Set the value of quantity
         *
         * @return  self
         */ 
        public function setQuantity($quantity)
        {
            $this->quantity = $quantity;

            return $this;
        }

        /**
         * Get the value of total
         */ 
        public function getTotal()
        {
                return $this->total;
        }

        /**
         * Set the value of total
         *
         * @return  self
         */ 
        public function setTotal($total)
        {
                $this->total = $total;

                return $this;
        }

        //functie om product toe te voegen aan winkelmand
        
        public static function addToCart($userId, $productId, $quantity, $total) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, total_price) VALUES (:user_id, :product_id, :quantity, :total_price)");
            $statement->bindParam(':user_id', $userId, \PDO::PARAM_INT);
            $statement->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statement->bindParam(':total_price', $total, PDO::PARAM_STR);
            $statement->execute();
        }

       
        //functie om winkelmand op te halen
        public static function getCart($user)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from cart where user_id = :user_id");
            $statement->bindValue(":user_id", $user);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        //functie om product te verwijderen uit winkelmand
        public static function deleteFromCart($user, $product)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("delete from cart where user_id = :user_id and product_id = :product_id");
            $statement->bindValue(":user_id", $user);
            $statement->bindValue(":product_id", $product);
            $result = $statement->execute();
            return $result;
        }
    }