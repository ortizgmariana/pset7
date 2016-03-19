<div>
<body style="background-color: #F2F2F2">
    <h1>
    <?php 
        $name=CS50::query("SELECT name FROM users WHERE id = ?", $_SESSION["id"]);
        $name=$name[0]["name"];
        $lastname=CS50::query("SELECT lastname FROM users WHERE id = ?", $_SESSION["id"]);
        $lastname=$lastname[0]["lastname"]; 
        echo("Good to see you again,  ");
        echo $name;
        echo (" ");
        echo $lastname;
        ?>
         
    </h1>
</div>
<h3> Current balance: $<?= number_format($cash,2) ?></h3>
<table class="table table-striped">
    
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
        
        <tbody>
        <?php 
        
        foreach ($positions as $position)
        {
            print("<tr background-color:yellow;>");
            print("<td class=\"text-left\">" . $position["symbol"] . "</td>");
            print("<td class=\"text-left\">" . $position["name"] . "</td>");
            print("<td class=\"text-left\">" . $position["shares"] . "</td>");
            print("<td class=\"text-left\">$" . $position["price"] . "</td>");
            print("<td class=\"text-left\">$" . $position["total"] . "</td>");
            print("</tr>");
        }

         ?>
    </tbody>
</table>
</body>
