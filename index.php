<?php
    
    // configuration
    require("../includes/config.php"); 
    
    $id = $_SESSION["id"];
    
    $rows = CS50::query("SELECT id, symbol ,shares FROM portfolios WHERE user_id = $id");
    $cash = CS50::query("SELECT cash, username FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $cash[0]["cash"];
    
    $positions = [];
    $stock = [];
    $symbol = [];
    
    
    foreach ($rows as $row)
    { 
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "symbol" => $row["symbol"],
                "name" => $stock["name"],
                "shares" => $row["shares"],
                "price" => $stock["price"],
                "total" => sprintf("%.2f", $row["shares"]*$stock["price"])
            ];
        }
    }
    
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "cash" => $cash]);

?>
