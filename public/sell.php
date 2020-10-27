<?php
require("../includes/config.php");


// if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell", "stock_symbol"=> "","price" => "","selling"=>false,"positions"=>false]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (empty($_POST["Symbol"])) 
      {
          apologize("Please insert symbol");
      } 
      if (empty($_POST["share"])) 
      {
          apologize("Please insert a share");
      } 
      $symbol = $_POST["Symbol"];
      $share = $_POST["share"];
      //dump($stock);
      $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
      //dump($positions);
    
        for ($i = 0; $i < count($positions); $i++) 
        {
            $price = lookup($positions[$i]["symbol"]);
            
            $positions[$i]["price"] = $price["price"];
            //dump($position);
            if ($positions[$i]["share"] > $share)
            {
                $count = $positions[$i]["share"] - $share;
                $insert = CS50::query("UPDATE `portfolio` SET `share` = ? WHERE `portfolio`.`user_id` = ?",$count,$_SESSION["id"]);
            }
            else if ($positions[$i]["share"] == $share)
            {

            }
        }

        
      render ("sell_form.php", ["title" => "Sell", "positions"=> $positions,"share"=>$share,"Symbol"=>$symbol,"selling"=>true]);

        
    }

    ?>