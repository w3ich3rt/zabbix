<script type="text/javascript">
	jQuery(document).ready(function() {
		// type of media
		jQuery('#type').change(function() {
			switch (jQuery(this).val()) {
				case '<?php echo MEDIA_TYPE_EMAIL; ?>':
					jQuery('#smtp_server, #smtp_helo, #smtp_email')
						.closest('li')
						.css('display', '')
						.removeClass('hidden');
					jQuery('#exec_path, #gsm_modem, #jabber_username, #eztext_username, #eztext_limit, #passwd')
						.closest('li')
						.css('display', 'none');
					jQuery('#eztext_link').css('display', 'none');
					break;

				case '<?php echo MEDIA_TYPE_EXEC; ?>':
					jQuery('#exec_path').closest('li').css('display', '').removeClass('hidden');
					jQuery('#smtp_server, #smtp_helo, #smtp_email, #gsm_modem, #jabber_username, #eztext_username, #eztext_limit, #passwd')
						.closest('li')
						.css('display', 'none');
					jQuery('#eztext_link').css('display', 'none');
					break;

				case '<?php echo MEDIA_TYPE_SMS; ?>':
					jQuery('#gsm_modem').closest('li').css('display', '').removeClass('hidden');
					jQuery('#smtp_server, #smtp_helo, #smtp_email, #exec_path, #jabber_username, #eztext_username, #eztext_limit, #passwd')
						.closest('li')
						.css('display', 'none');
					jQuery('#eztext_link').css('display', 'none');
					break;

				case '<?php echo MEDIA_TYPE_JABBER; ?>':
					jQuery('#jabber_username, #passwd').closest('li').css('display', '').removeClass('hidden');
					jQuery('#smtp_server, #smtp_helo, #smtp_email, #exec_path, #gsm_modem, #eztext_username, #eztext_limit')
						.closest('li')
						.css('display', 'none');
					jQuery('#eztext_link').css('display', 'none');
					break;

				case '<?php echo MEDIA_TYPE_EZ_TEXTING; ?>':
					jQuery('#eztext_username, #eztext_limit, #passwd')
						.closest('li')
						.css('display', '')
						.removeClass('hidden');
					jQuery('#eztext_link').css('display', '').removeClass('hidden');
					jQuery('#smtp_server, #smtp_helo, #smtp_email, #exec_path, #gsm_modem, #jabber_username')
						.closest('li')
						.css('display', 'none');
					break;
			}
		});

		// clone button
		jQuery('#clone').click(function() {
			jQuery('#mediatypeid, #delete, #clone').remove();
			jQuery('#update span').text(<?php echo CJs::encodeJson(_('Add')); ?>);
			jQuery('#update').val('mediatype.create').attr({id: 'add'});
			jQuery('#cancel').addClass('ui-corner-left');
			jQuery('#description').focus();
		});

		// refresh field visibility on document load
		jQuery('#type').trigger('change');
	});
</script>
