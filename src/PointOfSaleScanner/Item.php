<?php

namespace PointOfSaleScanner;

class Item {
	
	private $_stocks;
	
	public function __construct($products) {
		$this->_stocks = $products;
	}
	
	public function isItemExist($productName) {
		return $item = $this->_stocks->isItemExist($productName);
	}
	
	public function isValumePrice($productName) {
		
		if($this->isItemExist($productName)) {
			$product = $this->_stocks->getProduct($productName);
			return !empty($product->getValumePrice());
		}
		return false;
	}
	
	
	public function getProduct($productName) {
		
		if($this->isItemExist($productName)) {
			return $product = $this->_stocks->getProduct($productName);
		}
		return false;
	}
}
?>


