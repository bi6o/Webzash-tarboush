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

App::uses('WebzashAppModel', 'Webzash.Model');

/**
 * Webzash Plugin Entry Model
 *
 * @package Webzash
 * @subpackage Webzash.Model
 */
class Purchase extends WebzashAppModel {

	/* Validation rules for the Purchase table */
	public $validate = array(
		'entry_id' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'message' => 'Entry id is not a valid number',
				'required' => true,
				'allowEmpty' => true,
			),
			'rule2' => array(
				'rule' => array('maxLength', 18),
				'message' => 'Entry id length cannot be more than 18',
				'required' => true,
				'allowEmpty' => true,
			),
			'rule3' => array(
				'rule' => 'validEntry',
				'message' => 'Entry id is not valid',
				'required' => true,
				'allowEmpty' => true,
			),
		),
		'material_type' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Material type cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Material type length cannot be more than 100',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'price' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Price cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isAmount',
				'message' => 'Price is not a valid amount',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule3' => array(
				'rule' => array('maxLength', 28),
				'message' => 'Price length cannot be more than 28',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule4' => array(
				'rule' => 'isPositive',
				'message' => 'Price cannot be less than 0.00',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'quantity' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Quantity cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => 'isPositive',
				'message' => 'Quantity cannot be a negative value',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'unit' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Unit cannot be empty',
				'required' => true,
				'allowEmpty' => false,
			),
			'rule2' => array(
				'rule' => array('maxLength', 12),
				'message' => 'Unit length cannot be more than 12',
				'required' => true,
				'allowEmpty' => false,
			),
		),
		'material_name' => array(
			'rule1' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Material name length cannot be more than 100',
				'required' => true,
				'allowEmpty' => false,
			),
		),

	);

	/**
	 * Validation - Check if entry is valid
	 */
	public function validEntry($data) {
		$values = array_values($data);
		if (!isset($values)) {
			return false;
		}
		$value = $values[0];

		/* Load the Entrytype model */
		App::import("Webzash.Model", "Entry");
		$Entry = new Entry();

		if ($Entry->exists($value)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Validation - Check if value is a proper decimal number with 2 decimal places
	 */
	public function isAmount($data) {
		$values = array_values($data);
		if (!isset($values)) {
			return false;
		}
		$value = $values[0];
		if (preg_match('/^[0-9]{0,23}+(\.[0-9]{0,' . Configure::read('Account.decimal_places') . '})?$/', $value)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Validation - Check if value is a positive value
	 */
	public function isPositive($data) {
		$values = array_values($data);
		if (!isset($values)) {
			return false;
		}
		$value = $values[0];
		if ($value >= 0.00) {
			return true;
		} else {
			return false;
		}
	}
}
