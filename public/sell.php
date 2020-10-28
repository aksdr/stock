<?php
require("../includes/config.php");


// if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {   
        $symbols=[];
        $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
        foreach ($positions as $pos)
        {
            array_push($symbols,$pos["symbol"]);
        }
        //dump($symbols);
        // else render form
        render("sell_form.php", ["title" => "Sell", "stock_symbol"=> "","price" => "","selling"=>false,"positions"=>false,"symbols"=>$symbols]);
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
      $message = "You sold {$share} percents of {$symbol}<b/r>";
        
        for ($i = 0; $i < count($positions); $i++) 
        {
         
            if ($positions[$i]["symbol"] == $symbol) 
            {
                if ($positions[$i]["share"] > $share )
                {
                    $count = $positions[$i]["share"] - $share;
                    $insert = CS50::query("UPDATE `portfolio` SET `share` = ? WHERE `portfolio`.`id` = ?",$count,$positions[$i]["id"]);
                }
                else if ($positions[$i]["share"] == $share)
                {
                    $insert = CS50::query("DELETE FROM `portfolio` WHERE `portfolio`.`id` = ?",$positions[$i]["id"]);
                }
                else 
                {
                    $message = "You don't have enouth share";

                }
            }
        }

        $shares = CS50::query("SELECT `share` FROM portfolio WHERE user_id = ? && symbol = ?",$_SESSION["id"],$symbol);
        $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
        
        for ($i = 0; $i < count($positions); $i++) 
        {
            $price = lookup($positions[$i]["symbol"]);
            
            $positions[$i]["price"] = $price["price"];
        }

        //dump($shares);
        
      render ("sell_form.php", ["title" => "Sell", "positions"=> $positions,"share"=>$share,"Symbol"=>$symbol,"selling"=>true,"message"=>$message]);

        
    }

    ?>