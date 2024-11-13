<?php 
    namespace Website\XD\Interfaces;
    include_once('Db.php');

    interface iUser{
        public function login();
        public function canLogin();
        public function logout();
        public function register();
        public function update();
        public function delete();
        
    }
