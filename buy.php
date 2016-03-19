<?php
    
    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "buy"]);
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]) || empty($_POST["shares"]))
        {
            apologize("Please, enter a stock symbol and its shares.");
        }
        if (preg_match("/^\d+$/", $_POST["shares"]) == false)
        {
            apologize("Invalid number of shares");
        }
        // lookup the stock price
        $stock = lookup($_POST["symbol"]);
        
        if (! $stock)
        {
            apologize("Please, enter a valid stock");
        }
        
        $cost = $stock["price"] * $_POST["shares"];
        $cash_rows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $cash_rows[0]["cash"];
        
        if($cash < $cost)
        {
            apologize("You can't afford this stock, try with another one.");
        }
        
        CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION["id"], $_POST["symbol"], $_POST["shares"],  $_POST["shares"]);
        
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
        
        CS50::query("INSERT INTO history (user_id, transaction, date, symbol, shares, price) VALUES (?, 'BUY', NOW(), ?, ?, ?)", $_SESSION["id"], $_POST["symbol"],$_POST["shares"], $stock["price"]);
        
        redirect("/");
        
        
    }
?>
