<?php
require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (empty($_POST["Symbol"])) 
      {
          apologize("Please insert symbol");
      } 
      $symbol = $_POST["Symbol"];
      $stock = lookup($symbol);
      //dump($stock);
      render ("quote_form.php", ["title" => "Quote", "stock_symbol"=> $symbol,"price" => $stock["price"]]);

        
    }

    ?>