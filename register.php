<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["name"]))
        {
            apologize("please, provide a username");
        }
        
        if (empty($_POST["lastname"]))
        {
            apologize("please, provide a username");
        }
        if (empty($_POST["username"]))
        {
            apologize("please, provide a username");
        }
        else if (empty($_POST["password"]))
        {
            apologize("please, provide a password");
        }
        else if (empty($_POST["confirmation"]))
        {
           apologize("please, confirm your password");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Your password and your confirmation don't match!");
        }
        
        else if (CS50::query("INSERT IGNORE INTO users (username, hash, cash, name, lastname) VALUES(?, ?, 10000.0000, ?, ?)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT),  $_POST["name"], $_POST["lastname"]) == 0)
        {
            apologize("Username already taken, try again");
        }
         else
        {
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
        }
    }
    else
    render("register_form.php", ["title" => "register"])

?>
