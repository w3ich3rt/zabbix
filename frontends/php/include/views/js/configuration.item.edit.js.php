<?php

include dirname(__FILE__).'/common.item.edit.js.php';

$this->data['valueTypeVisibility'] = [];
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'units');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'row_units');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'trends');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'row_trends');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'trends');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'row_trends');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_LOG, 'logtimefmt');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_LOG, 'row_logtimefmt');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'valuemapid');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_STR, 'valuemapid');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_STR, 'row_valuemap');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_STR, 'valuemap_name');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'row_valuemap');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'valuemap_name');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'valuemapid');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'row_valuemap');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'valuemap_name');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_STR, 'inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_STR, 'row_inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_TEXT, 'inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_TEXT, 'row_inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_FLOAT, 'row_inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'inventory_link');
zbx_subarray_push($this->data['valueTypeVisibility'], ITEM_VALUE_TYPE_UINT64, 'row_inventory_link');
?>
<script type="text/javascript">
	function displayKeyButton() {
		// selected item type
		var type = parseInt(jQuery('#type').val());

		jQuery('#keyButton').prop('disabled',
			type != <?php echo ITEM_TYPE_ZABBIX; ?>
				&& type != <?php echo ITEM_TYPE_ZABBIX_ACTIVE; ?>
				&& type != <?php echo ITEM_TYPE_SIMPLE; ?>
				&& type != <?php echo ITEM_TYPE_INTERNAL; ?>
				&& type != <?php echo ITEM_TYPE_AGGREGATE; ?>
				&& type != <?php echo ITEM_TYPE_DB_MONITOR; ?>
				&& type != <?php echo ITEM_TYPE_SNMPTRAP; ?>
		)
	}

	jQuery(document).ready(function() {
		// field switchers
		<?php
		if (!empty($this->data['valueTypeVisibility'])) { ?>
			var valueTypeSwitcher = new CViewSwitcher('value_type', 'change',
				<?php echo zbx_jsvalue($this->data['valueTypeVisibility'], true); ?>);
		<?php } ?>

		jQuery('#type').change(function() {
				displayKeyButton();
			})
			.trigger('change');

		// Whenever non-numeric type is changed back to numeric type, set the default value in "trends" field.
		jQuery('#value_type').on('focus', function () {
			old_value = jQuery(this).val();
		}).change(function() {
			var new_value = jQuery(this).val(),
				trends = jQuery('#trends');

			if ((old_value == <?= ITEM_VALUE_TYPE_STR ?> || old_value == <?= ITEM_VALUE_TYPE_LOG ?>
					|| old_value == <?= ITEM_VALUE_TYPE_TEXT ?>)
					&& ((new_value == <?= ITEM_VALUE_TYPE_FLOAT ?>
					|| new_value == <?= ITEM_VALUE_TYPE_UINT64 ?>)
					&& trends.val() == 0)) {
				trends.val(<?= DAY_IN_YEAR ?>);
			}
		});
	});
</script>
