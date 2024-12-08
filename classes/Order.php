<?php

    namespace Website\XD\Classes;
    include_once(__DIR__ . "/Db.php");
    use \PDO;

    //class order (id, date, order_items_id, user_id, total_price, quantity)
    class Order
    {
        private $id;
        private $date;
        private $order_items_id;
        private $user_id;
        private $total_price;
        private $quantity;

        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
            return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return  self
         */ 
        public function setDate($date)
        {
            $this->date = $date;

            return $this;
        }

        /**
         * Get the value of order_items_id
         */ 
        public function getOrder_items_id()
        {
            return $this->order_items_id;
        }

        /**
         * Set the value of order_items_id
         *
         * @return  self
         */ 
        public function setOrder_items_id($order_items_id)
        {
            $this->order_items_id = $order_items_id;

            return $this;
        }

        /**
         * Get the value of user_id
         */ 
        public function getUser_id()
        {
            return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser_id($user_id)
        {
            $this->user_id = $user_id;

            return $this;
        }

        /**
         * Get the value of total_price
         */ 
        public function getTotal_price()
        {
            return $this->total_price;
        }

        /**
         * Set the value of total_price
         *
         * @return  self
         */ 
        public function setTotal_price($total_price)
        {
            $this->total_price = $total_price;

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

        //function to view orders
        public function viewOrders($id)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM `order` WHERE user_id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $orders;
        }

        //function to add order
        public function placeOrder($date,$user_id, $total_price, $quantity)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO `orders` (date, user_id, total_price, quantity) VALUES (:date,:user_id, :total_price, :quantity)");
            $statement->bindParam(':date', $date, PDO::PARAM_STR);
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $statement->bindParam(':total_price', $total_price, PDO::PARAM_STR);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statement->execute();
        }

        //function om de producten die besteld worden opgeslagen worden in de order_items (order_id, product_id)
        public function addOrderItems($order_id, $product_id, $quantity)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
            $statement->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $statement->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statement->execute();
        }
    }