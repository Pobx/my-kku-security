<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">
				<?php echo $head_sub_topic_label; ?>
			</h3>
		</div>

		<div class="box-body">
			<?php 
				$header_content = array(
					'tab_status' => $this->session->flashdata('tab_status'),
					'topic' => 'student_do_not_wear_helmet',
					'main_info' =>array(
						'topic' => 'ไม่สวมหมวกนิรภัย'
					),
					'complainter' => $this->session->userdata('roles') == 'security' ? false : array(
						'topic' => 'เจ้าหน้าที่รับผิดชอบ'
					),
					'upload_image' => array(),
				);
				$this->load->view('header_form_store', array('header_content' => $header_content));
			?>
			<div class="tab-content">
				<div id="menu1" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'main_info' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">ข้อมูลไม่สวมหมวกนิรภัย</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php $this->load->view('header_form_submit_data');?>

							<?php
								$this->load->view('student_do_not_wear_helmet_student_information');
								$this->load->view('student_do_not_wear_helmet_vehicles_information');
							?>
							<div class="box-footer">
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<input type="hidden" name="status" value="active">
								<?php $this->load->view('button_save_and_back_page_in_form');?>
							</div>
							</form>
						</div><!--box-body-->
					</div><!--box box-info box-solid-->
				</div><!--menu1-->

				<div id="menu2" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">เจ้าหน้าที่รับผิดชอบ</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php	
								if ($id != '') {
									echo form_open('student_do_not_wear_helmet/store_detective');	
							?>
									<div class="form-group">
										<label for="name" class="col-sm-2 control-label">ชื่อ&nbsp;-&nbsp;สกุล</label>

										<div class="col-sm-4">
											<!-- <input type="text" class="form-control select2" id="name" name="name" placeholder="ชื่อ - สกุล" value=""> -->
											<select class="form-control select2" style="width:240px" id="name" name="name" >
												<option>เลือก...</option>
												<?php foreach($users['results'] as $user){ ?>
													<option value="<?=$user['id'];?>"><?=$user['name'];?></option>

												<?php }?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"> บันทึก</button>
									</div>
									<input type="hidden" name="id" value="<?php echo $id; ?>">

									</form>
									
									<?php if(count($complainter) > 0){ ?>
										<?php if($complainter['recorder'] > 0){ ?>
										<table class="table table-bordered table-striped mydataTable">
											<thead>
												<tr>
													<th class="text-center"> ชื่อ - สกุล</th>
													<th class="text-center">สังกัด</th>
													<th class="text-center"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-center">
														<?php 
															$query = $this->db->where(array('id' => $complainter['recorder']))->get('users');
															$detective = $query->result_array();

															echo $detective[0]['name']; 
														?>
													</td>

													<td class="text-center">
														<?php echo $detective[0]['roles']; ?>
													</td>
			

													<td class="text-center">
														<a href="javascript:removeItem_break_mc_pad('<?php echo $complainter['id']; ?>', '<?php echo site_url('student_do_not_wear_helmet/remove_complainter');?>', 'complainter')"
														class="btn btn-danger">
															<i class="fa fa-trash-o"></i>
														</a>
													</td>

												</tr>
											</tbody>
										</table>
										<?php }  ?>
									<?php } ?>
									

							<?php } ?>
						</div><!-- box-body -->
					</div><!-- box box-warning box-solid -->
				
				</div><!-- menu2 -->

				<div id="menu3" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'uplaod_images' ? 'active in' : '';?>">
					<?php 
						if ($id != '') {
							echo form_open_multipart('student_do_not_wear_helmet/upload_images');	
						?>
							<input type="hidden" name="id" value="<?php echo $id; ?>">

					<?php 
							$this->load->view('upload_images', array('images' =>$images)); 
						}
					?>
				</div><!-- menu3 -->
			</div><!-- tab-content-->
		</div><!-- box-body -->
	</div><!-- box box-primary-->
</section>
	<script>
		var people_type = '<?php echo $people_type;?>';
		$('[name=people_type]').val(people_type);
		people_info(people_type);

		$('#people_type').change(function () {
			people_type = $(this).val();
			console.log(people_type);
			people_info(people_type);
			reset_people_info();
		});

		function people_info(people_type) {
			if (people_type == 'student') {
				$('#student_info').attr('class', 'show');
				$('#officer_info').attr('class', 'hide');
			} else if (people_type == 'officer' || people_type == 'people_outside') {
				$('#student_info').attr('class', 'hide');
				$('#officer_info').attr('class', 'show');
			}

		}

		function reset_people_info() {
			$('[name=people_code]').val('');
			$('[name=department_name]').val('');
		}

	</script>


<?php $this->load->view('script_tab_controller');?>