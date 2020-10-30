<?php
    require("../includes/config.php");

    function get_symbols() 
    {
        $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
        $symbols =  [];
            foreach ($positions as $pos)
            {
                array_push($symbols,$pos["symbol"]);
            }
            return $symbols;
    }


    // if user reached page via GET (as by clicking a link or via redirect)
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {   
            $symbols=get_symbols();
            
            //dump($symbols);
            // else render form
            render("buy_form.php", ["title" => "Buy", "stock_symbol"=> "","price" => "","selling"=>false,"positions"=>false,"symbols"=>$symbols]);
        }

        // else if user reached page via POST (as by submitting a form via POST)
        else if ($_SERVER["REQUEST_METHOD"] == "POST")
        { 
        if (empty($_POST["symbol"])) 
        {
            apologize("Please insert symbol");
        } 
        if (empty($_POST["share"])) 
        {
            apologize("Please insert a share");
        } 
        if (!preg_match("/^\d+$/", $_POST["share"]))
        {
            apologize("Please insert a correct share");
        }
        
        $symbol =strtoupper($_POST["symbol"]);
        $share = $_POST["share"];
        $price = lookup($symbol)["price"];
        $cash = CS50::query("SELECT `cash` FROM users WHERE id = ?", $_SESSION["id"]);
        $id = $_SESSION["id"];
        $message = "You bought {$share} percents of {$symbol}<b/r>";
        

        if ($cash < $share*$price)
        {
            apologize("You don't have enouth of money");
        }
        
        $insert = CS50::query("UPDATE `users` SET `cash` = `cash` - ($share*$price)  WHERE `users`.`id` = ?"
        ,$id);
        
        $insert = CS50::query("INSERT INTO `portfolio` (`user_id`, `symbol`, `share`) VALUES($id, '$symbol', $share) 
        ON DUPLICATE KEY UPDATE `share` = `share` + VALUES(`share`)");
    
        $symbols=get_symbols();
        $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $id);
        for ($i = 0; $i < count($positions); $i++) 
        {
            $price = lookup($positions[$i]["symbol"]);
            
            $positions[$i]["price"] = $price["price"];
        }
        render ("buy_form.php", ["title" => "Buy", "positions"=> $positions,
        "share"=>$share,"Symbol"=>$symbol,"selling"=>true,"message"=>$message,
        "symbols"=>$symbols]);
    }

?>