<!DOCTYPE html>
<html>
	<head>
		<title> Implement a point-of-sale scanning API </title>
	</head>
<body>
<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PointOfSaleScanner\Terminal;
use PointOfSaleScanner\Stock;
use PointOfSaleScanner\Item;

$stock = new Stock();

// Adding stock items with unit price & valume price for product 'A', 'B', 'C', 'D'
$stock->addItem('A', 2.00, [4=>7.00]);
$stock->addItem('B', 12.00);
$stock->addItem('C', 1.25, [6=>6.00]);
$stock->addItem('D', 0.15);

$items = new Item($stock);



$terminal = new Terminal($items);


?>	

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
	  <input type="text" name="skus" />
	  <button type="submit" name="calculate" id="calculate">calculate</button>
	</form>

	<div class="result">
		<?php 

		if (isset($_POST["calculate"])) {
			$string = preg_replace('/\s+/', '', $_POST["skus"]);
			$products = str_split($string);
			foreach($products as $product) {
				$canScan = $terminal->scan(strtoupper($product));
				if (!$canScan)
					echo "Product not found: " . $product . "<br>";
			}
			setlocale(LC_MONETARY,"en_US.UTF-8");
			$price = money_format('%.2n', $terminal->getGrandTotal());
			echo '<br>' . sprintf("Grand Total is %s for scanned code %s", $price , $string);
		}
		
		?>
	</div>
	
</body>
</html>
