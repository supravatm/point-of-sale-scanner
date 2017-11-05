<?php
namespace PointOfSaleScanner;

use PointOfSaleScanner\Product;

class Stock {
	
	private $stock_items;

	public function __construct() {
		$this->stock_items = array();
	}

	public function addItem($productName, $unitPrice= 0.00, $valumePrice=array()) {
		try {
			if (!$this->checkDuplicateItem($productName)) {
				$this->stock_items[$productName] = new Product($productName, $unitPrice, $valumePrice);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	public function checkDuplicateItem($productName) {
		return array_key_exists($productName, $this->stock_items);
	}
	
	public function isItemExist($productName) {
		return array_key_exists($productName, $this->stock_items);
	}
	
	public function getProduct($productName) {
		$product = '';
		if($this->isItemExist($productName)) {
			$product = $this->stock_items[$productName]; 
		}
		return $product;
	}
	
}
?>
