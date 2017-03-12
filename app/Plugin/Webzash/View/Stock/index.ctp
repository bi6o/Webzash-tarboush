<script type="text/javascript">
	$(document).ready(function() {
		$("#EntryShow").change(function() {
			this.form.submit();
		});

		var entryId = 0;
		$("button#send").click(function() {
			$(".modal-body").hide();
			$(".modal-footer").hide();
			$(".modal-ajax").show();
			$.ajax({
				type: "POST",
				url: '<?php echo $this->Html->url(array("controller" => "entries", "action" => "email")); ?>/' + entryId,
				data: $('form#emailSubmit').serialize(),
				success: function(response) {
					msg = JSON.parse(response); console.log(msg);
					if (msg['status'] == 'success') {
						$(".modal-error-msg").html("");
						$(".modal-error-msg").hide();
						$(".modal-body").show();
						$(".modal-footer").show();
						$(".modal-ajax").hide();
						$("#emailModal").modal('hide');
					} else {
						$(".modal-error-msg").html(msg['msg']);
						$(".modal-error-msg").show();
						$(".modal-body").show();
						$(".modal-footer").show();
						$(".modal-ajax").hide();
					}
				},
				error: function() {
					$(".modal-error-msg").html("Error sending email.");
					$(".error-msg").show();
					$(".modal-body").show();
					$(".modal-footer").show();
					$(".modal-ajax").hide();
				}
			});
		});

		$('#emailModal').on('show.bs.modal', function(e) {
			$(".modal-error-msg").html("");
			$(".modal-ajax").hide();
			$(".modal-error-msg").hide();
			entryId = $(e.relatedTarget).data('id');
			var entryType = $(e.relatedTarget).data('type');
			var entryNumber = $(e.relatedTarget).data('number');
			$("#emailModelType").html(entryType);
			$("#emailModelNumber").html(entryNumber);
		});
	});
</script>

<div class="row">

</div>
<br />
<table class="stripped">

	<tr>
		<th><?php echo  __d('webzash', 'Material'); ?></th>
		<th><?php echo  __d('webzash', 'Type'); ?></th>
		<th><?php echo  __d('webzash', 'Quantity'); ?></th>
		<th><?php echo  __d('webzash', 'Warehouse'); ?></th>
	</tr>

	<?php
	foreach ($stock->list as $stockRow) {

		echo '<tr>';
		echo '<td>' . $stockRow['material_name'] . '</td>';
		echo '<td>' . $stockRow['material_type'] . '</td>';
		echo '<td>' . $stockRow['quantity'] . '</td>';
		echo '<td></td>';

	}
	?>
</table>
