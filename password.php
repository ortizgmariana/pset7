<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("password_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["oldpassword"]))
        {
            apologize("Please, provide your old password");
        }
        else if (empty($_POST["newpassword"]))
        {
            apologize("Please, provide a new password");
        }
        else if (empty($_POST["confirmation"]))
        {
           apologize("Please, confirm your password");
        }
        else if ($_POST["newpassword"] != $_POST["confirmation"])
        {
            apologize("Your new password and your confirmation don't match!");
        }
       
        
        else
        {
            CS50::query("UPDATE users SET hash = ? WHERE id = ?", password_hash($_POST["newpassword"], PASSWORD_DEFAULT),$_SESSION["id"]);
            $_SESSION["id"] = $id;
            redirect("/");
        }
    }
    else
    render("password_form.php", ["title" => "password"])

?>
