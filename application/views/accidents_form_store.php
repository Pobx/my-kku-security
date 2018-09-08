<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">
				<?php echo $head_sub_topic_label; ?>
			</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">

			<div class="box-header"></div>

			<div class="box-body">
				<?php
$this->load->view('header_form_submit_data');
$this->load->view('button_save_and_back_page_in_form');
$this->load->view('accidents_information');
?>

				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="status" value="active">
				<?php $this->load->view('button_save_and_back_page_in_form');?>
				</form>
			</div>

			<div class="box-footer"></div>


		</div>

	</div>
	<?php
if ($id != '')
{
    $this->load->view('accidents_participate_table_information');
    $this->load->view('accidents_form_store_modal');
}
?>


	<script>
		$(document).ready(function () {

			$('#place_text').val('').hide();
			$('#accident_cause_text').val('').hide();

			$('input[name="chk_place"]').on('ifClicked', function () {
				$('#place').next(".select2").hide();
				$('#place_text').val('').show();
			});

			$('input[name="chk_place"]').on('ifUnchecked', function () {
				$('#place').next(".select2").show();
				$('#place_text').val('').hide();
			});

			$('input[name="chk_accident_cause"]').on('ifClicked', function () {
				$('#accident_cause').next(".select2").hide();
				$('#accident_cause_text').val('').show();
			});

			$('input[name="chk_accident_cause"]').on('ifUnchecked', function () {
				$('#accident_cause').next(".select2").show();
				$('#accident_cause_text').val('').hide();
			});

		});

	</script>
