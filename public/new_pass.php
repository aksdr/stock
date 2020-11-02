<?php

require ("../includes/config.php");


if ($_SERVER ["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render ("portfolio.php", ["title" => "Portfolio"]);
    }
else if ($_SERVER ["REQUEST_METHOD"] == "POST")
    {
        $placement = "none";
        $message = "Password was successefully changed";
        $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
    
        for ($i = 0; $i < count($positions); $i++) 
        {
            $price = lookup($positions[$i]["symbol"]);
            
            $positions[$i]["price"] = $price["price"];
            //dump($position);
        }


        $id = $_SESSION["id"];


        if (empty($_POST["password"]))
        {
            $placement = "first";
            $message = "You must provide your password.";
            render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message,"positions"=> $positions]);
        }
        else if (empty($_POST["confirmation"]))
        {
            $placement = "second";
            $message = "You must confirm your password.";
            render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message,"positions"=> $positions]);
        }
        if ($_POST["password"] != $_POST["confirmation"] ) 
        {
            $placement = "second";
            $message = "password and confirmation must be the same.";
            render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message,"positions"=> $positions]);
        }

        $insert = CS50::query("UPDATE `users` SET `hash` = ? WHERE `users`.`id` = ?",password_hash($_POST ["password"],PASSWORD_DEFAULT),$id);
       



        render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message,"positions"=> $positions]);

    }


    ?>