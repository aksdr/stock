<?php

    // configuration
    require("../includes/config.php"); 

    $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
    
        for ($i = 0; $i < count($positions); $i++) 
        {
            $price = lookup($positions[$i]["symbol"]);
            
            $positions[$i]["price"] = $price["price"];
            //dump($position);
        }
    //dump($positions);

    // render portfolio
    render("portfolio.php", ["title" => "Portfolio","positions"=> $positions]);

?>
