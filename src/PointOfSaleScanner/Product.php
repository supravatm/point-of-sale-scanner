<?php

namespace PointOfSaleScanner;

class Product {
	
	private $_productName;
	
	private $_unitPrice;
	
	private $_volumePrice;

	public function __construct($productName, $unitPrice = 0, $volumePrice = []) {		
		$this->_productName = $productName;
		$this->_unitPrice = $unitPrice;
		$this->_volumePrice = $volumePrice;
	}
	
	public function getName() {
		return $this->_productName;
	}
	
	public function getUnitPrice() {
		return $this->_unitPrice;
	}
	
	public function getValumePrice() {
		return $this->_volumePrice;
	}
	
	
}
?>
