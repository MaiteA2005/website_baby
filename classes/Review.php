<?php

namespace Website\XD\Classes;
include_once(__DIR__ . "/Db.php");

class Review
{
    private $userId;
    private $product;
    private $rating;
    private $comment;

     /**
     * Get the value of user_id
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

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
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    //get all reviews from the database for a specific product
    public function getReviews($id)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM reviews WHERE product_id = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetchAll();
    }

    //save a review to the database
    public function save()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (:user, :product, :rating, :comment)");
        $user = $this->getUsername($this->getUserId());
        $product = $this->getProduct();
        $rating = $this->getRating();
        $comment = $this->getComment();
        $statement->execute(['user' => $user, 'product' => $product, 'rating' => $rating, 'comment' => $comment]);
    }

    //get the username from the database based on the user id
    public function getUsername($id)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT firstname FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }
}