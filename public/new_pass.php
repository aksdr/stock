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
        $id = $_SESSION["id"];
        if (empty($_POST["password"]))
        {
            $placement = "first";
            $message = "You must provide your password.";
            render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message]);
        }
        else if (empty($_POST["confirmation"]))
        {
            $placement = "second";
            $message = "You must confirm your password.";
            render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message]);
        }
        if ($_POST["password"] != $_POST["confirmation"] ) 
        {
            $placement = "second";
            $message = "password and confirmation must be the same.";
            render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message]);
        }

        $insert = CS50::query("UPDATE `users` SET `password` = ? WHERE `users`.`id` = ?",password_hash($_POST ["password"],PASSWORD_DEFAULT),$id);


        render ("portfolio.php", ["title" => "Portfolio","placement"=>$placement,"message"=>$message]);

    }


    ?>