<?php
    $email = "";
    //isset() empty()

    if(isset($email)){
        //Bepaal of een variabele is gedeclareerd 
        echo"ok";
    }
    
    if(empty($email)){
        //Bepaal of een variabele leeg is
        echo'ok';
    }

    if(!empty($email)){
        //Bepaal of een variabele niet leeg is
        echo'ok';
    }

     //constant vs variabelen
    //constant verandert niet meer variabelen wel
    define("MAX_LIVES", 5);
    define("DB_USER", "root");

    echo MAX_LIVES
?>
