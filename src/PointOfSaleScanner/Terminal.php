<?php

namespace PointOfSaleScanner;

use PointOfSaleScanner\Cart;
use PointOfSaleScanner\Invoice;

class Terminal {
	
	private $_items;
	private $_invoice;
	
	public function __construct($items) {
		
		$this->_items = $items;
		$this->_invoice = new Invoice($this->_items);
	}
	
	
	public function scan($productName) {
		if ($this->_items->isItemExist($productName)) {
			$this->_invoice->add($productName);
			return true;
		} 
		return false;
	}
	
	public function getGrandTotal() {
		return $this->_invoice->getGrandTotal();
	}
}
?>
