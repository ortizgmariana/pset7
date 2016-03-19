<div>
<table class="table table-condensed">
    
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
        
        <?php 
        
        foreach ($positions as $position)
        {
            print("<tr>");
            print("<td class=\"text-left\">" . $position["transaction"] . "</td>");
            print("<td class=\"text-left\">" . $position["date"] . "</td>");
            print("<td class=\"text-left\">" . $position["symbol"] . "</td>");
            print("<td class=\"text-left\">" . $position["name"] . "</td>");
            print("<td class=\"text-left\">" . $position["shares"] . "</td>");
            print("<td class=\"text-left\">$" . $position["price"] . "</td>");
            print("</tr>");
        }

            
        ?>
        
</table>
</div>
