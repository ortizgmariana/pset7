<form action = "sell.php" method = "post">
    <fieldset>
        <div class = "form-group">
            <select class ="form-control" name = "symbol">
            
                 <option value = "symbol">Symbol</option>
                <?php
                foreach($symbols as $symbol)
                {
                    print ('<option value="'.$symbol['symbol'].'">'.$symbol['name'].'</option>');
                }
            
                ?>
            </select>
        </div>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="nstocks" placeholder="N. of stocks" type="int"/>
        </div>
        <div class= "form-group">
            <button  class="btn btn-default" type="submit">
                 Sell
            </button>
        </div>
    </fieldset>
</form>
