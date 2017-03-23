<?php
/**
 * The MIT License (MIT)
 *
 * Webzash - Easy to use web based double entry accounting software
 *
 * Copyright (c) 2014 Prashant Shah <pshah.mumbai@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Class to store the entire stock tree with the details
 */
class StockList
{
	var $Material = null;
	var $Entry = null;
	var $list = [];


/**
 * Initializer
 */
	function StockList()
	{
		return;
	}

/**
 * Setup which group id to start from
 */
	function initiateStock()
	{
		$stockList = [];
		$sales = $this->Material->find('all' , array('conditions' => array('Material.is_purchase' => 0)));
		$purchases = $this->Material->find('all' , array('conditions' => array('Material.is_purchase' => 1)));;

		foreach ($purchases as $purchase) {
			$entry = $this->Entry->findById($purchase['Material']['entry_id']);
			$flag = 0;
			$sold  = 0;

			foreach ($sales as $sale) {
				if ($purchase['Material']['material_name'] == $sale['Material']['material_name'] && $purchase['Material']['material_type'] == $sale['Material']['material_type'] ) {
					
					$flag = 1;
					$materialName = $purchase['Material']['material_name'];
					$materialType = $purchase['Material']['material_type'];
					$sold = $sold + $sale['Material']['quantity'];
				}
			}

			if ($flag == 0){
				$materialName = $purchase['Material']['material_name'];
				$materialType = $purchase['Material']['material_type'];
				$quantity = $purchase['Material']['quantity'];
			}
			else {
				$quantity = $purchase['Material']['quantity'] - $sold;
			}
			$stockList[] = ['material_name' => $materialName, 'material_type' => $materialType ,'quantity' =>  $quantity , 'warehouse' => $entry['Entry']['warehouse']];
		}

		$this->list = $stockList;
		return $this;

	}



}
