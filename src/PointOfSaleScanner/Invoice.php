<?php

namespace PointOfSaleScanner;

class Invoice {
	
	private $_invoice;
	private $_items;

	public function __construct($items) {
		$this->_invoice = array();
		$this->_items = $items;
	}
	
	public function add($productName) {
		if($this->existInInvoice($productName)) {
			$this->_invoice[$productName]++;
		} else {
			$this->_invoice[$productName] = 1;
		}
	}
	
	private function existInInvoice($productName) {
		return array_key_exists($productName, $this->_invoice);
	}
	
	public function getGrandTotal() {
		$total = 0;
		foreach ($this->_invoice as $productName => $productcount) {
			$total += $this->calculate($productName, $productcount);
		}
		return $total;
	}
	
	private function calculate($productName, $productcount) {
		
		$valumeTotal = $unitTotal = 0;
		$remindCount = $productcount;
		//check valume price is defined or not
		
		$product = $this->_items->getProduct($productName);
		
		if($this->_items->isValumePrice($productName)) {
			$valumePrice = $product->getValumePrice();
			$result = $this->finalValumePrice($valumePrice, $remindCount);
			$remindCount = $result['remainder'];
			$valumeTotal += $result['total'];
		}
		
		$unitPrice = $product->getUnitPrice();
		$unitTotal = $this->finalUnitPrice($unitPrice, $remindCount) ;
		
		return $valumeTotal + $unitTotal;
	}
	
	private function finalValumePrice($price, $qty) {
		
		$total = 0;
		$remainder = 0;
		foreach ( $price as $valume_qty => $valume_price) { 
			
		
			$pr = abs(floor($qty  / $valume_qty));
			
			if($pr >=1) {
				$total += $pr * $valume_price;
				
			}
			$remainder += $qty % $valume_qty;
		}
		return compact("total", "remainder");
		
		
	}
	private function finalUnitPrice($unitPrice, $productcount ) {
		return $unitPrice * $productcount;
	}
}
?>
