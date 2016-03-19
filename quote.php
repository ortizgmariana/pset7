<?php
    // configuration
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
        if ($_POST["symbol"] == NULL)
        {
            apologize("Please, provide a symbol");
        }
        
        $stock = lookup($_POST["symbol"]);
        
        if ($stock == 0)
        {
            apologize("Please, enter a valid symbol");
        }
        render("quote.php", ["title" => "Quote","stock" => $stock]);
    }
?>
