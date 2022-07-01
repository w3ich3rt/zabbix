<?php
/*
** Zabbix
** Copyright (C) 2001-2022 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/

require_once dirname(__FILE__).'/../../include/CWebTest.php';
require_once dirname(__FILE__).'/../behaviors/CMessageBehavior.php';
require_once dirname(__FILE__).'/../../include/helpers/CDataHelper.php';

class testFormGraphs extends CWebTest {

	/**
	 * Flag for graph prototype.
	 */
	public $prototype = false;

	/**
	 * URL for opening graph or graph prototype form.
	 */
	public $url;

	/**
	 * Attach MessageBehavior to the test.
	 *
	 * @return array
	 */
	public function getBehaviors() {
		return [CMessageBehavior::class];
	}

	public function getLayoutData() {
		return [
			[
				[
					'check_defaults' => true,
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Normal'),
					],
					'visible_fields' => [
						['field' => 'id:name', 'value' => '', 'maxlength' => 255],
						['field' => 'id:width', 'value' => '900', 'maxlength' => 5],
						['field' => 'id:height', 'value' => '200', 'maxlength' => 5],
						['field' => 'id:graphtype', 'value' => 'Normal'],
						['field' => 'id:show_legend', 'value' => true],
						['field' => 'id:show_work_period', 'value' => true],
						['field' => 'id:show_triggers', 'value' => true],
						['field' => 'id:visible_percent_left', 'value' => false], // Percentile line (left) checkbox.
						['field' => 'id:visible_percent_right', 'value' => false], // Percentile line (right) checkbox.
						['field' => 'id:percent_left', 'visible' => false], // Percentile line (left) input.
						['field' => 'id:percent_right', 'visible' => false], // Percentile line (right) input.
						['field' => 'id:ymin_type', 'value' => 'Calculated'], // Y axis MIN value dropdown.
						['field' => 'id:ymax_type', 'value' => 'Calculated'], // Y axis MAX value dropdown.
						['field' => 'id:yaxismin', 'visible' => false], // Y axis MIN fixed value input.
						['field' => 'id:yaxismax', 'visible' => false], // Y axis MAX fixed value input.
						['field' => 'id:ymin_name', 'visible' => false], // Y axis MIN item input.
						['field' => 'id:ymax_name', 'visible' => false], // Y axis MAX item input.
						['field' => 'id:itemsTable', 'visible' => true]
					],
					'item_columns' => ['', '', 'Name', 'Function', 'Draw style', 'Y axis side', 'Color', 'Action']
				]
			],
			[
				[
					'check_defaults' => true,
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Stacked'),
					],
					'visible_fields' => [
						['field' => 'id:name', 'value' => ''],
						['field' => 'id:width', 'value' => '900'],
						['field' => 'id:height', 'value' => '200'],
						['field' => 'id:graphtype', 'value' => 'Stacked'],
						['field' => 'id:show_legend', 'value' => true],
						['field' => 'id:show_work_period', 'value' => true],
						['field' => 'id:show_triggers', 'value' => true],
						['field' => 'id:visible_percent_left', 'exists' => false], // Percentile line (left) checkbox.
						['field' => 'id:visible_percent_right', 'exists' => false], // Percentile line (right) checkbox.
						['field' => 'id:percent_left', 'exists' => false], // Percentile line (left) input.
						['field' => 'id:percent_right', 'exists' => false], // Percentile line (right) input.
						['field' => 'id:ymin_type', 'value' => 'Calculated'], // Y axis MIN value dropdown.
						['field' => 'id:ymax_type', 'value' => 'Calculated'], // Y axis MAX value dropdown.
						['field' => 'id:yaxismin', 'visible' => false], // Y axis MIN fixed value input.
						['field' => 'id:yaxismax', 'visible' => false], // Y axis MAX fixed value input.
						['field' => 'id:ymin_name', 'visible' => false], // Y axis MIN item input.
						['field' => 'id:ymax_name', 'visible' => false], // Y axis MAX item input.
						['field' => 'id:itemsTable', 'visible' => true]
					],
					'item_columns' => ['', '', 'Name', 'Function', 'Y axis side', 'Color', 'Action']
				]
			],
			[
				[
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Pie'),
					],
					'visible_fields' => [
						['field' => 'id:name', 'value' => ''],
						['field' => 'id:width', 'value' => '900'],
						['field' => 'id:height', 'value' => '200'],
						['field' => 'id:graphtype', 'value' => 'Pie'],
						['field' => 'id:show_legend', 'value' => true],
						['field' => 'id:show_work_period', 'exists' => false],
						['field' => 'id:show_triggers', 'exists' => false],
						['field' => 'id:visible_percent_left', 'exists' => false], // Percentile line (left) checkbox.
						['field' => 'id:visible_percent_right', 'exists' => false], // Percentile line (right) checkbox.
						['field' => 'id:percent_left', 'exists' => false], // Percentile line (left) input.
						['field' => 'id:percent_right', 'exists' => false], // Percentile line (right) input.
						['field' => 'id:ymin_type', 'exists' => false], // Y axis MIN value dropdown.
						['field' => 'id:ymax_type', 'exists' => false], // Y axis MAX value dropdown.
						['field' => 'id:yaxismin', 'exists' => false], // Y axis MIN fixed value input.
						['field' => 'id:yaxismax', 'exists' => false], // Y axis MAX fixed value input.
						['field' => 'id:ymin_name', 'exists' => false], // Y axis MIN item input.
						['field' => 'id:ymax_name', 'exists' => false], // Y axis MAX item input.
						['field' => 'id:show_3d', 'value' => false],
						['field' => 'id:itemsTable', 'visible' => true]
					],
					'item_columns' => ['', '', 'Name', 'Type', 'Function', 'Color', 'Action']
				]
			],
			[
				[
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Exploded'),
					],
					'visible_fields' => [
						['field' => 'id:name', 'value' => ''],
						['field' => 'id:width', 'value' => '900'],
						['field' => 'id:height', 'value' => '200'],
						['field' => 'id:graphtype', 'value' => 'Exploded'],
						['field' => 'id:show_legend', 'value' => true],
						['field' => 'id:show_work_period', 'exists' => false],
						['field' => 'id:show_triggers', 'exists' => false],
						['field' => 'id:visible_percent_left', 'exists' => false], // Percentile line (left) checkbox.
						['field' => 'id:visible_percent_right', 'exists' => false], // Percentile line (right) checkbox.
						['field' => 'id:percent_left', 'exists' => false], // Percentile line (left) input.
						['field' => 'id:percent_right', 'exists' => false], // Percentile line (right) input.
						['field' => 'id:ymin_type', 'exists' => false], // Y axis MIN value dropdown.
						['field' => 'id:ymax_type', 'exists' => false], // Y axis MAX value dropdown.
						['field' => 'id:yaxismin', 'exists' => false], // Y axis MIN fixed value input.
						['field' => 'id:yaxismax', 'exists' => false], // Y axis MAX fixed value input.
						['field' => 'id:ymin_name', 'exists' => false], // Y axis MIN item input.
						['field' => 'id:ymax_name', 'exists' => false], // Y axis MAX item input.
						['field' => 'id:show_3d', 'value' => false],
						['field' => 'id:itemsTable', 'visible' => true]
					],
					'item_columns' => ['', '', 'Name', 'Type', 'Function', 'Color', 'Action']
				]
			],
			[
				[
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Normal'),
						'id:visible_percent_left' => true, // Percentile line (left) checkbox.
						'id:visible_percent_right' => true, // Percentile line (right) checkbox.
					],
					'visible_fields' => [
						['field' => 'id:percent_left', 'value' => 0, 'visible' => true], // Percentile line (left) input.
						['field' => 'id:percent_right', 'value' => 0, 'visible' => true] // Percentile line (right) input.
					]
				]
			],
			[
				[
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Normal'),
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'), // Y axis MIN value dropdown.
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'), // Y axis MAX value dropdown.
					],
					'visible_fields' => [
						['field' => 'id:yaxismin', 'value' => 0, 'visible' => true], // Y axis MIN fixed value input.
						['field' => 'id:yaxismax', 'value' => 100, 'visible' => true] // Y axis MAX fixed value input.
					]
				]
			],
			[
				[
					'change_fields' => [
						'Graph type' => CFormElement::RELOADABLE_FILL('Normal'),
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Item'), // Y axis MIN value dropdown.
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Item'), // Y axis MAX value dropdown.
					],
					'visible_fields' => [
						['field' => 'id:ymin_name', 'value' => '', 'visible' => true], // Y axis MIN item input.
						['field' => 'id:ymax_name', 'value' => '', 'visible' => true] // Y axis MAX item input.
					]
				]
			]
		];
	}

	public function checkGraphLayout($data) {
		$this->page->login()->open($this->url)->waitUntilReady();
		$this->query('button', ($this->prototype ? 'Create graph prototype' : 'Create graph'))->waitUntilClickable()
				->one()->click();
		$form = $this->query('name:graphForm')->waitUntilVisible()->asForm()->one();

		// Check default fields only for first case.
		if (CTestArrayHelper::get($data, 'check_defaults', false)) {
			$this->assertEquals([($this->prototype ? 'Graph prototype' : 'Graph'),'Preview'], $form->getTabs());
			$this->assertFalse($form->query('xpath:.//table[@id="itemsTable"]//div[@class="drag-icon"]')->exists());

			$items_container = $form->getFieldContainer('Items');
			$this->assertTrue($items_container->query('button:Add')->one()->isClickable());

			if ($this->prototype) {
				$this->assertTrue($items_container->query('button:Add prototype')->one()->isClickable());
				$discover_field = $form->getField('Discover');
				$this->assertTrue($discover_field->isVisible());
				$this->assertEquals(true, $discover_field->getValue());
			}
			else {
				$this->assertFalse($items_container->query('button:Add prototype')->exists());
				$this->assertFalse($form->query('id:discover')->exists());
			}

			$form->selectTab('Preview');
			$this->page->waitUntilReady();
			$this->assertTrue($this->query('xpath://div[@id="previewChart"]/img')->waitUntilPresent()->one()->isVisible());

			$form->selectTab($this->prototype ? 'Graph prototype' : 'Graph');
			$this->page->waitUntilReady();
		}

		$form->fill($data['change_fields']);

		foreach ($data['visible_fields'] as $visible_field) {
			if (array_key_exists('exists', $visible_field)) {
				$this->assertEquals($visible_field['exists'], $form->query($visible_field['field'])->exists());
			}

			if (array_key_exists('visible', $visible_field)) {
				$this->assertTrue($form->query($visible_field['field'])->one(false)->isVisible($visible_field['visible']));
			}

			if (array_key_exists('value', $visible_field)) {
				$this->assertEquals($visible_field['value'], $form->getField($visible_field['field'])->getValue());
			}

			if (array_key_exists('maxlength', $visible_field)) {
				$this->assertEquals($visible_field['maxlength'], $form->getField($visible_field['field'])->getAttribute('maxlength'));
			}
		};

		// Check items functions fields depending on graph type.
		if (array_key_exists('item_columns', $data)) {
			$form->invalidate();
			$items_container = $form->getFieldContainer('Items');

			$item = ($this->prototype)
				? ['button' => 'Add prototype', 'name' => 'testFormItemPrototype1']
				: ['button' => 'Add', 'name' => 'testFormItem'];

			$items_container->query('button', $item['button'])->waitUntilClickable()->one()->click();
			$dialog = COverlayDialogElement::find()->one();
			$dialog->query('link', $item['name'])->waitUntilClickable()->one()->click();
			$dialog->waitUntilNotPresent();

			$this->assertEquals($data['item_columns'], $form->query('id:itemsTable')->asTable()->one()->getHeadersText());
		}
	}

	public function getCommonGraphData() {
		return [
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => '',
						'Width' => '',
						'Height' => ''
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Incorrect value for field "Name": cannot be empty.',
						'Incorrect value "0" for "Width" field: must be between 20 and 65535.',
						'Incorrect value "0" for "Height" field: must be between 20 and 65535.'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Fractional width and height'.($this->prototype ? ' {#KEY}' : NULL),
						'Width' => 1.2,
						'Height' => 15.5
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Field "Width" is not integer.',
						'Field "Height" is not integer.'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Negative and empty inputs'.($this->prototype ? ' {#KEY}' : NULL),
						'Width' => -100,
						'Height' => -1,
						'id:visible_percent_left' => true,
						'id:visible_percent_right' => true,
						'id:percent_left' => -2,
						'id:percent_right' => -200,
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:yaxismin' => '',
						'id:yaxismax' => '',
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Incorrect value "-100" for "Width" field: must be between 20 and 65535.',
						'Incorrect value "-1" for "Height" field: must be between 20 and 65535.',
						'Field "yaxismin" is mandatory.',
						'Field "yaxismax" is mandatory.',
						'Incorrect value "-2" for "Percentile line (left)" field: must be between 0 and 100, and have no more than 4 digits after the decimal point.',
						'Incorrect value "-200" for "Percentile line (right)" field: must be between 0 and 100, and have no more than 4 digits after the decimal point.'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Commas in inputs'.($this->prototype ? ' {#KEY}' : NULL),
						'Width' => '20,5',
						'Height' => '50,9',
						'id:visible_percent_left' => true,
						'id:visible_percent_right' => true,
						'id:percent_left' => '1,3',
						'id:percent_right' => '5,6',
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:yaxismin' => '88,9',
						'id:yaxismax' => '0,1',
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Field "yaxismin" is not correct: a number is expected',
						'Field "yaxismax" is not correct: a number is expected',
						'Field "Percentile line (left)" is not correct: a number is expected',
						'Field "Percentile line (right)" is not correct: a number is expected'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Too large inputs'.($this->prototype ? ' {#KEY}' : NULL),
						'Width' => 65536,
						'Height' => 65536,
						'id:visible_percent_left' => true,
						'id:visible_percent_right' => true,
						'id:percent_left' => 101,
						'id:percent_right' => 101,
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:yaxismin' => 12345678999999998,
						'id:yaxismax' => 12345678999999998,
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Incorrect value "65536" for "Width" field: must be between 20 and 65535.',
						'Incorrect value "65536" for "Height" field: must be between 20 and 65535.',
						'Field "yaxismin" is not correct: a number is too large',
						'Field "yaxismax" is not correct: a number is too large',
						'Incorrect value "101" for "Percentile line (left)" field: must be between 0 and 100, and have no more than 4 digits after the decimal point.',
						'Incorrect value "101" for "Percentile line (right)" field: must be between 0 and 100, and have no more than 4 digits after the decimal point.'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Text in inputs'.($this->prototype ? ' {#KEY}' : NULL),
						'Width' => 'test',
						'Height' => 'value',
						'id:visible_percent_left' => true,
						'id:visible_percent_right' => true,
						'id:percent_left' => 'letters',
						'id:percent_right' => 'symbols',
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:yaxismin' => 'text',
						'id:yaxismax' => 'value',
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Incorrect value "0" for "Width" field: must be between 20 and 65535.',
						'Incorrect value "0" for "Height" field: must be between 20 and 65535.',
						'Field "yaxismin" is not correct: a number is expected',
						'Field "yaxismax" is not correct: a number is expected',
						'Field "Percentile line (left)" is not correct: a number is expected',
						'Field "Percentile line (right)" is not correct: a number is expected'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Low width and height and too many fractional digits in percentile and axis'.
								($this->prototype ? ' {#KEY}' : NULL),
						'Width' => 1,
						'Height' => 19,
						'id:visible_percent_left' => true,
						'id:visible_percent_right' => true,
						'id:percent_left' => 1.99999,
						'id:percent_right' => 2.12345,
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:yaxismin' => 1.12345,
						'id:yaxismax' => 1.999999999,
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Incorrect value "1" for "Width" field: must be between 20 and 65535.',
						'Incorrect value "19" for "Height" field: must be between 20 and 65535.',
						'Field "yaxismin" is not correct: a number has too many fractional digits',
						'Field "yaxismax" is not correct: a number has too many fractional digits',
						'Field "Percentile line (left)" is not correct: a number has too many fractional digits',
						'Field "Percentile line (right)" is not correct: a number has too many fractional digits'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Too large negative numbers'.($this->prototype ? ' {#KEY}' : NULL),
						'id:visible_percent_left' => true,
						'id:visible_percent_right' => true,
						'id:percent_left' => -900000,
						'id:percent_right' => -900000,
						'id:ymin_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:ymax_type' => CFormElement::RELOADABLE_FILL('Fixed'),
						'id:yaxismin' => -90000000000000000,
						'id:yaxismax' => -90000000000000000,
					],
					'error' => 'Page received incorrect data',
					'details' => [
						'Field "yaxismin" is not correct: a number is too large',
						'Field "yaxismax" is not correct: a number is too large',
						'Incorrect value "-900000" for "Percentile line (left)" field: must be between 0 and 100, and have no more than 4 digits after the decimal point.',
						'Incorrect value "-900000" for "Percentile line (right)" field: must be between 0 and 100, and have no more than 4 digits after the decimal point.'
					]
				]
			],
			[
				[
					'expected' => TEST_BAD,
					'fields' => [
						'Name' => 'Empty item'.($this->prototype ? ' {#KEY}' : NULL)
					],
					'error' => ($this->prototype) ? 'Cannot add graph prototype' : 'Cannot add graph',
					'details' => [
						'Missing items for '.($this->prototype ? 'graph prototype' : 'graph').' "Empty item'.
								($this->prototype ? ' {#KEY}' : NULL).'".'
					]
				]
			]
		];
	}

	public function checkGraphForm($data) {
		if (CTestArrayHelper::get($data, 'expected', TEST_GOOD) === TEST_BAD) {
			$sql = 'SELECT * FROM graphs ORDER BY graphid';
			$old_hash = CDBHelper::getHash($sql);
		}

		$this->page->login()->open($this->url)->waitUntilReady();
		$this->query('button', ($this->prototype ? 'Create graph prototype' : 'Create graph'))->waitUntilClickable()
				->one()->click();
		$form = $this->query('name:graphForm')->waitUntilVisible()->asForm()->one();
		$form->fill($data['fields']);

		// Fill Y axis Item values separately because field is not real multiselect.
		if (array_key_exists('yaxis_items', $data)) {
			foreach ($data['yaxis_items'] as $y => $yaxis_item) {
				$form->query(($this->prototype) ? 'id:yaxis_'.$y.'_prototype' : 'id:yaxis_'.$y)->waitUntilClickable()->one()->click();
				$dialog = COverlayDialogElement::find()->one();
				$dialog->query('link', $yaxis_item['value'])->waitUntilClickable()->one()->click();
				$dialog->waitUntilNotPresent();
			}
		}

		$items_container = $form->getFieldContainer('Items');

		// Add items or item prototypes to graph.
		if (array_key_exists('items', $data)) {
			foreach ($data['items'] as $i => $item) {
				$items_container->query('button', CTestArrayHelper::get($item, 'prototype', false) ? 'Add prototype' : 'Add')
						->waitUntilClickable()->one()->click();
				$dialog = COverlayDialogElement::find()->one();
				$dialog->query('link', $item['item'])->waitUntilClickable()->one()->click();
				$dialog->waitUntilNotPresent();

				// Check that added item link appeared.
				$item_row = $items_container->query('xpath:.//tr[@id="items_'.$i.'"]')->one()->waitUntilPresent();
				$this->assertTrue($item_row->query('link', $item['host'].': '.$item['item'])->one()->isClickable());

				// Add line styling functions.
				if (array_key_exists('functions', $item)) {
					foreach ($item['functions'] as $function => $value) {
						$item_row->query('xpath:.//z-select[@name="items['.$i.']['.$function.']"]')->asDropdown()->one()->fill($value);
					}
				}

				// Add line color.
				if (array_key_exists('color', $item)) {
					$item_row->query('xpath:.//button[@id="lbl_items_'.$i.'_color"]')->waitUntilClickable()->one()->click();
					$this->query('xpath://div[@id="color_picker"]')->asColorPicker()->one()->fill($item['color']);
				}
			}
		}

		$form->submit();
		$this->page->waitUntilReady();

		if (CTestArrayHelper::get($data, 'expected', TEST_GOOD) === TEST_BAD) {
			$this->assertMessage(TEST_BAD, $data['error'], $data['details']);
			$this->assertEquals($old_hash, CDBHelper::getHash($sql));
		}
		else {
			$this->assertMessage(TEST_GOOD, ($this->prototype ? 'Graph prototype added' : 'Graph added'));
			$this->assertEquals(1, CDBHelper::getCount('SELECT * FROM graphs WHERE name='.
					zbx_dbstr($data['fields']['Name']))
			);

			// Open just created graph and check that all fields present correctly in form.
			$this->query('xpath://form[@name="graphForm"]/table')->asTable()->one()->waitUntilReady()
					->query('link', $data['fields']['Name'])->waitUntilClickable()->one()->click();
			$form->invalidate();
//			$form->checkValue($data['fields']);

			// Check Y axis Item values fake multiselects.
			if (array_key_exists('yaxis_items', $data)) {
				foreach ($data['yaxis_items'] as $y => $yaxis_item) {
					$this->assertEquals($yaxis_item['host'].': '.$yaxis_item['value'],
							$form->query('id:y'.$y.'_name')->one()->getAttribute('value')
					);
				}
			}

			// Check saved items count.
			$items_container = $form->getFieldContainer('Items');
			$this->assertEquals(count($data['items']),
					$items_container->query('xpath:.//tr[@class="sortable"]')->all()->count()
			);

			// Check saved items names.
			foreach ($data['items'] as $i => $item) {
				$item_row = $items_container->query('xpath:.//tr[@id="items_'.$i.'"]')->one()->waitUntilPresent();
				$this->assertTrue($item_row->query('link', $item['host'].': '.$item['item'])->one()->isClickable());

				// Check lines styling functions.
				if (array_key_exists('functions', $item)) {
					foreach ($item['functions'] as $function => $value) {
						$this->assertEquals($value, $item_row->query('xpath:.//z-select[@name="items['.$i.']['.$function.']"]')
								->asDropdown()->one()->getValue()
						);
					}
				}

				// Check lines color.
				if (array_key_exists('color', $item)) {
					$item_row->query('xpath:.//button[@id="lbl_items_'.$i.'_color"]')->waitUntilClickable()->one()->click();
					$this->assertEquals($item['color'],
							$this->query('xpath://div[@id="color_picker"]')->asColorPicker()->one()->getValue()
					);
				}
			}
		}
	}
}
