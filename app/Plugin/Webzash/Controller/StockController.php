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

App::uses('WebzashAppController', 'Webzash.Controller');
App::uses('StockList', 'Webzash.Lib');

/**
 * Webzash Plugin Accounts Controller
 *
 * @package Webzash
 * @subpackage Webzash.controllers
 */
class StockController extends WebzashAppController {

	public $uses = array('Webzash.Sale', 'Webzash.Purchase', 'Webzash.Entry');

/**
 * index method
 *
 * @return void
 */
	public function show() {
		return $this->redirect(array('plugin' => 'webzash', 'controller' => 'stock', 'action' => 'index'));
	}

/**
 * show method
 *
 * @return void
 */
	public function index() {

		$this->set('title_for_layout', __d('webzash', 'Stock'));

		$stock = new StockList();
		$stock->Sale = &$this->Sale;
		$stock->Purchase = &$this->Purchase;
		$stock->Entry = &$this->Entry;
		$stock->initiateStock();
		$this->set('stock', $stock);

		return;
	}

	/* Authorization check */
	public function isAuthorized($user) {
		if ($this->action === 'show') {
			return $this->Permission->is_allowed('view accounts chart');
		}

		return parent::isAuthorized($user);
	}

}
