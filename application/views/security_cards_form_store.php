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
$this->load->view('security_cards_information');
?>

				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="status" value="active">
				<?php $this->load->view('button_save_and_back_page_in_form');?>
				</form>
			</div>

			<div class="box-footer"></div>


		</div>

	</div>
