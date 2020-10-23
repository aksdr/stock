<?php
    // configuration
    require ("../includes/config.php");
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER ["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render ("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER ["REQUEST_METHOD"] == "POST")
    {
         // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must confirm your password.");
        }
        if ($_POST["password"] != $_POST["confirmation"] ) 
        {
            apologize("password and confirmation must be the same.");
        }
        $usernames = CS50::query ("SELECT username FROM users");
        //dump ($usernames);
       
        $users = [];

        foreach ($usernames as $iuser) {
            array_push($users, $iuser["username"]);
        }
         //dump ($users);
        if (check_username($_POST["username"],$users)) {

            apologize("username is allready exists");
        } 
        else 
        {
            CS50::query ("INSERT INTO users (username, hash, cash) VALUES (?,?, 10000.00)", $_POST [ "username"], password_hash($_POST ["password"],PASSWORD_DEFAULT));
             redirect("/public");
        }

        //CS50::query ("INSERT INTO users (username, hash, cash) VALUES (?,?, 10000.00)", $_POST [ "username"], crypt ($_POST ["password"]));

    }
?>