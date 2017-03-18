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
	var $Sale = null;
	var $Purchase = null;
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
		$sales = $this->Sale->find('all');
		$purchases = $this->Purchase->find('all');

		foreach ($purchases as $purchase) {
			$entry = $this->Entry->findById($purchase['Purchase']['entry_id']);

			$flag = 0;
			$sold  = 0;
			foreach ($sales as $sale) {
				if ($purchase['Purchase']['material_name'] == $sale['Sale']['material_name'] && $purchase['Purchase']['material_type'] == $sale['Sale']['material_type'] ) {
					
					$flag = 1;
					$materialName = $purchase['Purchase']['material_name'];
					$materialType = $purchase['Purchase']['material_type'];
					$sold = $sold + $sale['Sale']['quantity'];
				}
			}

			if ($flag == 0){
				$materialName = $purchase['Purchase']['material_name'];
				$materialType = $purchase['Purchase']['material_type'];
				$quantity = $purchase['Purchase']['quantity'];
			}
			else {
				$quantity = $purchase['Purchase']['quantity'] - $sold;
			}
			$stockList[] = ['material_name' => $materialName, 'material_type' => $materialType ,'quantity' =>  $quantity , 'warehouse' => $entry['Entry']['warehouse']];
		}

		$this->list = $stockList;
		return $this;

	}



}
