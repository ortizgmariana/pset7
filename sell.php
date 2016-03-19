<?php
    // configuration
    require("../includes/config.php");
    $symbol = [];
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $rows = CS50::query("SELECT symbol FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
        $symbols = [];
        
        foreach($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $symbols[] = [
                    "name" => $stock["name"],
                    "symbol" => $row["symbol"],
                ];
            }
        }
        
        render("sell_form.php", ["title" => "Sell", "symbols" => $symbols]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       $shares = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
       $stock = lookup($_POST["symbol"]);
       $earnings = $shares[0]["shares"] * $stock["price"];
       
       CS50::query("UPDATE users SET cash = (cash + ".$earnings.") WHERE id = ?", $_SESSION["id"]);
       $rows = CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"],$stock["symbol"]);
        CS50::query("INSERT INTO history (user_id, transaction, symbol, shares, price) VALUES(?,'SELL', ?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
       redirect("/");
    }
?>
