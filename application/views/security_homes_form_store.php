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
					'topic' => 'security_home',
					'main_info' =>array(
						'topic' => 'ผู้ฝากบ้าน'
					),
					'complainter' =>  array(
						'topic' => 'เจ้าหน้าที่ผู้รับผิดชอบ'
					),
					'upload_image' => array(),
				);
				$this->load->view('header_form_store', array('header_content' => $header_content));
			?>

			<!-- <form class="form-horizontal form_submit_data"> -->
			<div class="tab-content">
				<!-- <form class="form-horizontal form_submit_data"> -->
				<div id="menu1" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'main_info' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">ข้อมูลผู้ฝากบ้าน</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php $this->load->view('header_form_submit_data');?>
								<div class="box-header"></div>
								<div class="box-body">
									<div class="form-group">
										<label for="start_date" class="col-sm-2 control-label">วันที่</label>

										<div class="col-sm-2">
											<input type="text" class="form-control datepicker" id="start_date" name="start_date" data-provide="datepicker"
											data-date-language="th-th" placeholder="วันที่" value="<?php echo $start_date;?>">
										</div>

										<label for="end_date" class="col-sm-1 control-label">ถึง</label>

										<div class="col-sm-2">
											<input type="text" class="form-control datepicker" id="end_date" name="end_date" data-provide="datepicker"
											data-date-language="th-th" placeholder="ถึง" value="<?php echo $end_date;?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">ช่วง</label>

										<div class="col-sm-4">
											<label>
												<input type="radio" name="period" class="flat-red" value="normal" <?php if ($status=='nornal' ) { echo "checked"
												;}?>>&nbsp;ปกติ
												<input type="radio" name="period" class="flat-red" value="festival" <?php if ($status=='festival' ) { echo
												"checked" ;}?>>&nbsp;เทศกาล
											</label>
										</div>
									</div>

									<div class="form-group">
										<label for="owner_home_name" class="col-sm-2 control-label">ชื่อ&nbsp;-&nbsp;สกุล</label>

										<div class="col-sm-4">
											<input type="text" class="form-control" id="owner_home_name" name="owner_home_name" placeholder="ชื่อ - สกุล"
											value="<?php echo $owner_home_name;?>">
										</div>
									</div>

									<div class="form-group">
										<label for="owner_home_position_name" class="col-sm-2 control-label">ตำแหน่ง</label>

										<div class="col-sm-4">
											<input type="text" class="form-control" id="owner_home_position_name" name="owner_home_position_name" placeholder="ตำแหน่ง"
											value="<?php echo $owner_home_position_name;?>">
										</div>
									</div>

									<div class="form-group">
										<label for="owner_home_department_name" class="col-sm-2 control-label">สังกัดหน่วยงาน</label>

										<div class="col-sm-4">
											<input type="text" class="form-control" id="owner_home_department_name" name="owner_home_department_name"
											placeholder="สังกัดหน่วยงาน" value="<?php echo $owner_home_department_name;?>">
										</div>
									</div>

									<div class="form-group">
										<label for="owner_home_office_name" class="col-sm-2 control-label">สำนักงาน&nbsp;/&nbsp;ศูนย์</label>

										<div class="col-sm-4">
											<input type="text" class="form-control" id="owner_home_office_name" name="owner_home_office_name" placeholder="สำนักงาน / ศูนย์"
											value="<?php echo $owner_home_office_name;?>">
										</div>
									</div>

									<div class="form-group">
										<label for="address" class="col-sm-2 control-label">ที่อยู่&nbsp;/&nbsp;หมู่บ้าน</label>

										<div class="col-sm-4">
											<textarea class="form-control" rows="3" id="address" name="address" placeholder="ที่อยู่ / หมู่บ้าน"><?php echo $address;?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">การส่งมอบ</label>

										<div class="col-sm-4">
											<label>
												<input type="radio" name="status" class="flat-red" value="stable" <?php if ($status=='stable' ) { echo "checked"
												;}?>>&nbsp;ปกติ
												<input type="radio" name="status" class="flat-red" value="not-stable" <?php if ($status=='not-stable' ) { echo
												"checked" ;}?>>&nbsp;ไม่ปกติ
											</label>
										</div>
									</div>

								</div><!-- inner box-body -->

								<div class="box-footer">
									<input type="hidden" name="id" value="<?php echo $id;?>">
									<?php $this->load->view('button_save_and_back_page_in_form');?>
								</div>
							</form>

						</div><!--- outside box-body -->
					</div><!-- box box-info box-solid -->
				</div><!-- menu1 -->
				
				<div id="menu2" class="tab-pane fade <?php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'active in' : '';?>">
					<div class="box box-info box-solid">
						<div class="box-header with-border">
							<h3 class="box-title">ผู้รับเรื่อง</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<?php	
								if ($id != '') {
									echo form_open_multipart('security_homes/store_detective');	
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
														<a href="javascript:removeItem_break_mc_pad('<?php echo $complainter['id']; ?>', '<?php echo site_url('security_homes/remove_complainter');?>', 'complainter')"
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
							echo form_open_multipart('security_homes/upload_images');	
						?>
							<input type="hidden" name="id" value="<?php echo $id; ?>">

					<?php 
							$this->load->view('upload_images', array('images' =>$images)); 
						}
					?>
					
				</div><!-- menu3 -->
				<!-- <div id="menu2" class="tab-pane fade <php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'active in' : '';?>">

					<php //print_r($users);
						if ($id == '') {
							$arr_detective_info = array(
								'header_sub_topic_label_detective' => 'ฝากบ้าน',
								'header_columns_detective' => array('ชื่อ-สกุล', 'สังกัดหน่วยงาน', 'หมายเหตุ'),
								'detective' => array(array('id'=>1, 'name' =>1, 'department_name' =>'security', 'remark' =>'ทดสอบ')),
								'link_go_to_detective_remove' => ''
							);
							$arr_detective_form_store = array(
								'header_sub_topic_label_detective' => 'ฝากบ้าน',
								'key_id' => $id, 
								'form_submit_data_url_modal' => 'security_homes/detective_store',
								'users' => $users
							);
							$this->load->view('detective_information',array('arr_detective_info' =>  $arr_detective_info));
							$this->load->view('detective_form_store_modal', array('arr_detective_form_store' =>  $arr_detective_form_store));
						}
					?>
				</div> -->
			</div><!-- tab-content -->
		</div><!-- box-body -->
	</div><!-- box box-primary -->
</section>

<?php $this->load->view('script_tab_controller');?>
