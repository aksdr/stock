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

      if ($cash < $share*$price)
      {
        apologize("You don't have enouth of money");
      }
      $positions = CS50::query("SELECT * FROM portfolio WHERE user_id = ?", $_SESSION["id"]);
      $insert = CS50::query("UPDATE `users` SET `cash` = `cash` - ($share*$price)  WHERE `users`.`id` = ?",$positions[$i]["user_id"]);
      $insert = CS50::query("INSERT INTO portfolio (user_id, symbol, share) VALUES($_SESSION['id'], $symbol, $share) ON DUPLICATE KEY UPDATE share = share + VALUES(share)");








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
                    $price = lookup($positions[$i]["symbol"])["price"];
                    $count = $positions[$i]["share"] - $share;
                    $insert = CS50::query("UPDATE `portfolio` SET `share` = ? WHERE `portfolio`.`id` = ?",$count,$positions[$i]["id"]);
                    $insert = CS50::query("UPDATE `users` SET `cash` = `cash` + ($share*$price)  WHERE `users`.`id` = ?",$positions[$i]["user_id"]);
                }
                else if ($positions[$i]["share"] == $share)
                {
                    $price = lookup($positions[$i]["symbol"])["price"];
                    $insert = CS50::query("DELETE FROM `portfolio` WHERE `portfolio`.`id` = ?",$positions[$i]["id"]);
                    $insert = CS50::query("UPDATE `users` SET `cash` = `cash` + ($share*$price)  WHERE `users`.`id` = ?",$positions[$i]["user_id"]);
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
        $symbols=get_symbols();

      render ("sell_form.php", ["title" => "Sell", "positions"=> $positions,"share"=>$share,"Symbol"=>$symbol,"selling"=>true,"message"=>$message,"symbols"=>$symbols]);

        
    }

    ?>