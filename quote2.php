<h1><?= $stock["name"] ?></h1>
<h1><?= $stock["symbol"] ?></h1>
Price: $<?= $stock["price"] ?>
<h4>Want to buy it?</h4>
<form action="buy.php" method="get">
<button class="btn btn-default" type="submit" value="buy.php">
         Buy Stock
         </button>
</form>
