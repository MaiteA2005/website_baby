<?php
    namespace Website\XD\Classes;

    include_once(__DIR__ .'Db.php');

    abstract class Product{
        private $title;
        private $description;
        private $price;
        private $categorie_id;
        private $color;
        private $image;

        

        // Get the value of title 
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
            if(empty($title)){
                throw new Exception('Title is required');
            }

            $this->title = $title;

            return $this;
    }

        // Get the value of title
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        // Get the value of title 
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price){
            if(empty($price)){
                throw new Exception('Price is required');
            }

            $this->price = $price;

            return $this;
        }

        // Get the value of title
        public function getCategorie_id()
        {
            return $this->categorie_id;
        }

        /**
         * Set the value of categorie_id
         *
         * @return  self
         */ 
        public function setCategorie_id($categorie_id)
        {
            $this->categorie_id = $categorie_id;

            return $this;
        }

        // Get the value of title 
        public function getColor()
        {
            return $this->color;
        }

        /**
         * Set the value of color
         *
         * @return  self
         */ 
        public function setColor($color)
        {
            $this->color = $color;

            return $this;
        }

        // Get the value of title
        public function getImage()
        {
            return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
            if(empty($image)){
                throw new Exception('Image is required');
            }
            
            $this->image = $image;

            return $this;
        }
 
        public function __construct($title, $price, $image, $description, $color) {
            $this->title = $title;
            $this->price = $price;
            $this->image = $image;
            $this->description = $description;
            $this->color = $color;
        }


        public static function getProductsByCategory($categoryId) {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM products WHERE categorie_id = :categoryId");
            $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $stmt->execute();
    
            $products = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = new Product($row['title'], $row['price'], $row['image'], $row['color']);
            }
    
            return $products;
        }
    }
?>