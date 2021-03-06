<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">
				<?php echo $head_sub_topic_label.' ('.$header_sub_topic_label_owner_assets.')'; ?>
			</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>

		<div class="box-body">

			<?php 
				$header_content = array(
					'tab_status' => $this->session->flashdata('tab_status'),
					'topic' => 'vehicles_forget_key',
					'main_info' =>array(
						'topic' => 'ผู้ลืมกุญแจ'
					),
					'complainter' =>  array(
						'topic' => 'ผู้เก็บกุญแจได้'
					),
					'upload_image' => array(),
				);
				$this->load->view('header_form_store', array('header_content' => $header_content));
			?>
			

			<div class="tab-content">
				<!-- <form class="form-horizontal form_submit_data"> -->
				<div id="menu1" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'main_info' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">ข้อมูลผู้ลืมกุญแจ</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php $this->load->view('header_form_submit_data');?>
								<div class="box-header"></div>
								<div class="box-body">
									<?php 
										$this->load->view('vehicles_forget_key_owner_assets_information');
									?>
								</div>
								<div class="box-footer">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="hidden" name="status" value="active">
									<?php $this->load->view('button_save_and_back_page_in_form');?>
								</div>
							</form>
						</div><!--box-body -->
					 </div> <!--class="box box-info box-solid"> -->

				</div>

				<div id="menu2" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'active in' : '';?>">

					<?php 
						if ($id != '') {
							$this->load->view('vehicles_forget_key_table_detective_information');
							$this->load->view('vehicles_forget_key_detective_form_store_modal');
						}
					?>
				</div>

				<div id="menu3" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'upload_images' ? 'active in' : '';?>">
					<?php 
						if ($id != '') {
							echo form_open_multipart('vehicles_forget_key/upload_images');	
						?>
							<input type="hidden" name="id" value="<?php echo $id; ?>">

					<?php 
							$this->load->view('upload_images', array('images' =>$images)); 
						}
					?>
					</form>
				</div>
			</div><!-- tab-content -->
		</div>
		
	</div>
	

		
	<script>
		$(document).ready(function () {
			var people_type = '<?php echo $people_type;?>';
			var owner_assets_department = '<?php echo $owner_assets_department;?>';
			var car_state = '<?php echo $car_state;?>';
			var state_comment = '<?php echo $state_comment;?>';
			var vehicles_forget_key_place_id = '<?php echo $vehicles_forget_key_place_id;?>';

			if (people_type == 'student' || people_type == 'staff') {
				$('#div_owner_assets_department').show();
				$('#owner_assets_department').val(owner_assets_department);
			} else {
				$('#div_owner_assets_department').hide();
				$('#owner_assets_department').val('');
			}

			$('input[name="people_type"]').on('ifClicked', function (event) {
				// alert("You clicked " + this.value);
				if (this.value == 'people_outside') {
					$('#owner_assets_department').val('');
					$('#div_owner_assets_department').hide();
				} else {
					// $('#owner_assets_department').val('');
					$('#div_owner_assets_department').show();
				}
			});


			if (car_state == 'other') {
				$('#div_state_comment').show();
				$('#state_comment').val(state_comment);
			} else {
				$('#div_state_comment').hide();
				$('#car_state').val('');
			}


			$("#car_state").change(function () {

				if ($('#car_state').val() == 'other') {
					$('#state_comment').val('');
					$('#div_state_comment').show();
				} else {
					$('#div_state_comment').hide();
					$('#state_comment').val('');
				}

			});

			$('[name=car_state]').val(car_state);

			$('#place_text').val('').hide();
			$('input[name="chk_place"]').on('ifClicked', function () {
				$('#vehicles_forget_key_place_id').next(".select2").hide();
				$('#place_text').val('').show();
			});

			$('input[name="chk_place"]').on('ifUnchecked', function () {
				$('#vehicles_forget_key_place_id').next(".select2").show();
				$('#place_text').val('').hide();
			});
			$('[name=vehicles_forget_key_place_id]').val(vehicles_forget_key_place_id);



			
		});


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
<?php $this->load->view('script_tab_controller');?>