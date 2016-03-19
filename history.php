<?php

    // configuration
    require("../includes/config.php"); 
    
    $id = $_SESSION["id"];
    
    $rows = CS50::query("SELECT * FROM history WHERE user_id = $id");
    
    $positions = [];    
    
    foreach ($rows as $row) 
    { 
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "transaction" => $row["transaction"],
                "date" => $row["date"],
                "name" => $stock["name"],   
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "price" => $row["price"]
            ];
        }
    }
    // render history
    render("history_form.php", ["positions" => $positions, "title" => "Positions"]);

?>
