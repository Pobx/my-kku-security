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
					'topic' => 'break_motorcycle_pad',
					'main_info' =>array(
						'topic' => 'งัดเบาะจักรยานยนต์'
					),
					'complainter' => $this->session->userdata('roles') == 'security' ? false : array(
						'topic' => 'ผู้รับเรื่อง'
					),
					'upload_image' => array(),
				);
				$this->load->view('header_form_store', array('header_content' => $header_content));
			?>
			<!-- <form class="form-horizontal form_submit_data"> -->
			<div class="tab-content">
				<div id="menu1" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'main_info' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">ข้อมูลงัดเบาะจักรยานยนต์</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php 
								$this->load->view('header_form_submit_data');
								$this->load->view('break_motorcycle_pad/break_motorcycle_pad_details_information');
							?>
						</div>

						<div class="box-footer">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="status" value="active">
							<?php $this->load->view('button_save_and_back_page_in_form');?>
						</div>
							</form>
					</div><!-- box box-info box-solid-->
				</div><!-- nenu1 -->

				<div id="menu2" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">ผู้รับเรื่อง</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php	
								if ($id != '') {
									echo form_open_multipart('break_motorcycle_pad/stor_detective');	
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
															$query = $this->db->where(['id' => $complainter['recorder']])->get('users');
															$detective = $query->result_array();

															echo $detective[0]['name']; 
														?>
													</td>

													<td class="text-center">
														<?php echo $detective[0]['roles']; ?>
													</td>
			

													<td class="text-center">
														<a href="javascript:removeItem_break_mc_pad('<?php echo $complainter['id']; ?>', '<?php echo site_url('break_motorcycle_pad/remove_complainter');?>', 'complainter')"
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

				<div id="menu3" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'upload_images' ? 'active in' : '';?>">
			
					<?php 
						if ($id != '') {
							echo form_open_multipart('break_motorcycle_pad/upload_images');	
						?>
							<input type="hidden" name="id" value="<?php echo $id; ?>">

					<?php 
							$this->load->view('upload_images', array('images' =>$images)); 
						}
					?>
					
				</div><!-- menu3 -->
			</div><!-- tab-content -->
			

		</div>

	</div>

	<script>
		$(document).ready(function () {
			var people_type = '<?php echo $people_type;?>';
			var victim_department_name = '<?php echo $victim_department_name;?>';

			if (people_type == 'student') {
				$('#div_victim_department_name').show();
				$('#label_victim_department_name').html('คณะ');
				$('#victim_department_name').val(victim_department_name).attr("placeholder", "คณะ");
			} else if (people_type == 'staff') {
				$('#div_victim_department_name').show();
				$('#label_victim_department_name').html('สังกัดหน่วยงาน');
				$('#victim_department_name').val(victim_department_name).attr("placeholder", "สังกัดหน่วยงาน");
			} else {
				$('#div_victim_department_name').hide();
				$('#victim_department_name').val('');
			}

			$('input[name="people_type"]').on('ifClicked', function (event) {
				if (this.value == 'people_outside') {
					$('#victim_department_name').val('');
					$('#div_victim_department_name').hide();
				} else {
					if (this.value == 'student') {
						console.log(this.value)
						$('#victim_department_name').val('').attr("placeholder", "คณะ");
						$('#label_victim_department_name').html('คณะ');
					} else if (this.value == 'staff') {
						$('#victim_department_name').val('').attr("placeholder", "สังกัดหน่วยงาน");
						$('#label_victim_department_name').html('สังกัดหน่วยงาน');
					}
					$('#div_victim_department_name').show();
				}
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

	</script>
