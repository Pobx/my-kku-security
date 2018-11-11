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
					$header_content = array(
						'tab_status' => $this->session->flashdata('tab_status'),
						'topic' => 'break_home',
						'main_info' =>array(
							'topic' => 'การเกิดอุบัติเหตุ'
						),
						'complainter' => array(
							'topic' => 'ผู้เกี่ยวข้องกับเหตุการณ์'
						),
						'upload_image' => array(),
					);
					$this->load->view('header_form_store', array('header_content' => $header_content));
				?>


				<div class="tab-content">
					<div id="menu1" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'main_info' ? 'active in' : '';?>">
							<div class="box box-info box-solid">
								<div class="box-header with-border">
									<h3 class="box-title">ข้อมูลการเกิดอุบัติเหตุ</h3>
								</div>
								<div class="box-body">
									<?php
										$this->load->view('header_form_submit_data');
										// $this->load->view('button_save_and_back_page_in_form');
										$this->load->view('accidents_information');
									?>

									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="hidden" name="status" value="active">
									<?php $this->load->view('button_save_and_back_page_in_form');?>
									</form>
								</div>
							</div>

				</div>
				<div id="menu2" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'active in' : '';?>">
					
					<?php if ($id != ''){
							$this->load->view('accidents_participate_table_information');
							$this->load->view('accidents_form_store_modal');
					?>
							<ul class="list-unstyled list-inline pull-right">
								<li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button></li>
								<li><button type="button" class="btn btn-info next-step">Next <i class="fa fa-chevron-right"></i></button></li>
							</ul>
					<?php }?>
					
				</div>


				<div id="menu3" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'upload_images' ? 'active in' : '';?>">
					<?php 
						if ($id != ''){
							$this->load->view('accidents_upload_images'); 
						}
					?>	
				</div>


				<!-- <div id="menu4" class="tab-pane fade">
					<h3>Menu 4</h3>
					<p>Some content in menu 4.</p>
					<ul class="list-unstyled list-inline pull-right">
						<li><button type="button" class="btn btn-default prev-step"><i class="fa fa-chevron-left"></i> Back</button></li>
					</ul>
				</div> -->
			</div>
			</div><!--box-body -->



		</div>

	</div>
	


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


			$('.btn-circle').on('click',function(){
			$('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');
			$(this).addClass('btn-info').removeClass('btn-default').blur();
			});

			$('.next-step, .prev-step').on('click', function (e){
			var $activeTab = $('.tab-pane.active');

			$('.btn-circle.btn-info').removeClass('btn-info').addClass('btn-default');

			if ( $(e.target).hasClass('next-step') )
				{
					var nextTab = $activeTab.next('.tab-pane').attr('id');
					$('[href="#'+ nextTab +'"]').addClass('btn-info').removeClass('btn-default');
					$('[href="#'+ nextTab +'"]').tab('show');
				}
				else
				{
					var prevTab = $activeTab.prev('.tab-pane').attr('id');
					$('[href="#'+ prevTab +'"]').addClass('btn-info').removeClass('btn-default');
					$('[href="#'+ prevTab +'"]').tab('show');
				}
			});

		});



		function append_assets_amount(_id){
			$('#del_assets_form_'+_id).css('display', '')
			$('#append_assets_form_'+_id).css('display', 'none')
			id = _id+1;
			var str= `<div class="form-group" id="assets_name_`+id+`">
				<label for="" class="col-sm-2 control-label"></label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="assets_name" name="assets_name[]" placeholder="ชื่อทรัพย์สิน" value="">
				</div>

				<label for="assets_amount" class="col-sm-1 control-label">จำนวน</label>

				<div class="col-sm-1">
					<input type="number" class="form-control" id="assets_amount" name="assets_amount[]"  value="">
				</div>
				<div class="col-sm-1"><a href="javascript:append_assets_amount(`+id+`)" class="btn btn-info sm" id="append_assets_form_`+id+`" style="display:''"><b>+</b></a></div>
				<div class="col-sm-1"><a href="javascript:delete_assets_amount(`+id+`)" class="btn btn-danger sm" id="del_assets_form_`+id+`" style="display:none"><b>-</b></a></div>

			</div>
			`;
			$('#append_assets_name').append(str);
		}

		function delete_assets_amount(id){
			$('#assets_name_'+id).remove();
		}

		function append_upload_image(_id){
				$('#del_file_form_'+_id).css('display', '')
				$('#append_file_form_'+_id).css('display', 'none')
	
			id = _id+1;
			var str= `<div class="row" style="margin-top:5px">
			<div class="form-group" id="upload_image_`+id+`" style="margin-left:2%">
				<div class="col-sm-3">
					<input type="file" class="form-control"  id="file_image_`+id+`" onchange="show_temp_image(this,`+id+`)" name="upload_image[]">
				</div>
				<div class="col-sm-1"><a href="javascript:append_upload_image(`+id+`)" class="btn btn-info sm" id="append_file_form_`+id+`" style="display:''"><b>+</b></a></div>
				<div class="col-sm-1"><a href="javascript:delete_upload_image(`+id+`)" id="del_file_form_`+id+`" class="btn btn-danger sm" style="display:none"><b>-</b></a></div>
				<div class="col-sm-5">
								<img src="" class="img-responsive" id="temp_image_`+id+`">
							</div>
			</div></div>
			`;
			$('#append_upload_image').append(str);
		}

		function delete_upload_image(id){
			$('#upload_image_'+id).remove();
		}

		function _delete(id){
			console.log(id)
			$.post( "<?php echo site_url('accidents/inactive');?>", { 'id': id})
			.done(function( data ) {
				console.log(data );
			});

		}

		function show_temp_image(input,id){
			var url = input.value;
			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#temp_image_'+id).attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}else{
				$('#temp_image_0').attr('src', '/assets/no_preview.png');
			}
		}


		function delete_raw_image(id){
			$.post( "<?php echo site_url('accidents/delete_raw_image');?>", { 'id': id})
			.done(function( data ) {
				$('#show_images_div').html(data);
			});
		}
		
		

	</script>
