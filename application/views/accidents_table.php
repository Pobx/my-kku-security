<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">
				<?php echo $head_sub_topic_label; ?>
			</h3>

			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
			<div class="row">
				<div class="col-md-12 text-right">
					<a href="<?php echo $link_go_to_form.'/0/index'; ?>" class="btn btn-primary">
						<i class="fa fa-plus-circle"></i>
						เพิ่มข้อมูลใหม่
					</a>
				</div>
			</div>

			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped mydataTable2" id="myTable">
					<thead>
						<?php foreach ($header_columns as $key => $value){ ?>
						<th>
							<?php echo $value; ?>
						</th>
						<?php }?>
					</thead>
					<tbody>
						<?php foreach ($results as $key => $value)
{
    ?>
						<tr>
							<td class="text-center">
								<?php echo $value['accident_date']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['period_time_name']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['accident_place_name']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['count_car']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['count_motocycles']; ?>
							</td>

							<td class="text-center">
								<?php echo $value['count_injury']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['count_dead']; ?>
							</td>


							<td class="text-center">
								<?php echo $value['count_officer']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['count_student']; ?>
							</td>
							<td class="text-center">
								<?php echo $value['count_people_outside']; ?>
							</td>

							<!-- <td class="text-center">
							<a data-toggle="collapse" href="#<php echo "acc_info".$value['id']; ?>" role="button" aria-expanded="false" 
								class="btn btn-info" aria-controls="<php echo "acc_info".$value['id']; ?>"><i class="fa fa-eye"></i></a>
				
							</td> -->
							<td class="text-center">
								<a href="javascript::void()" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo "m_acc_info".$value['id']; ?>">
									<i class="fa fa-eye"></i></a>
								<!-- Modal -->
								<div class="modal fade " id="<?php echo "m_acc_info".$value['id']; ?>" tabindex="-1" role="dialog"
									aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลการเกิดอุบัติเหตุ</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-4">
														<div class="info-box bg-aqua">
															<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
															<div class="info-box-content">
																<span class="info-box-text">สาเหตู</span>
																<span class="info-box-number">
																	<?php echo $value['accident_cause_name']; ?></span>
																<div class="progress">
																	<div class="progress-bar" style="width: 70%"></div>
																</div>
															</div><!-- /.info-box-content -->
														</div> <!-- /.info-box -->

														<div class="box box-primary col-md-12">
															<div class="box-header with-border">
																<h3 class="box-title">รถที่เกิดเหตุ</h3>
																<!-- <div class="box-tools pull-right"> -->
															</div><!-- /.box-header -->
															<div class="box-body">
																<div>
																	<div class="direct-chat-msg">
																		<div class="direct-chat-info clearfix">
																			<!-- <span class="direct-chat-name pull-left">Alexander Pierce</span>
															<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span> -->
																		</div><!-- /.direct-chat-info -->
																		<?php foreach ($value['results_participate'] as $car) { ?>
																		<div class="direct-chat-text">
																			<?php echo $car['car_body'];?>
																		</div>
																		<?php } ?>
																	</div><!-- /.direct-chat-text -->
																</div><!-- /.direct-chat-msg -->
															</div><!-- /.box-body -->
														</div><!-- box box-primary col-md-12 -->
														<div class="box box-primary col-md-12">
															<div class="box-header with-border">
																<h3 class="box-title">เจ้าหน้าที่ที่รับผิดชอบ</h3>
																<!-- <div class="box-tools pull-right"> -->
															</div><!-- /.box-header -->
															<div class="box-body">
																<div>
																	<div class="direct-chat-msg">
																		<div class="direct-chat-info clearfix">
																		</div><!-- /.direct-chat-info -->
																		<div class="direct-chat-text">
																			<?php 
																// print_r($results);
																	$complainter = $users_model->find($value['recorder']);
																	echo $complainter['results']->name;
																?>
																		</div>
																	</div><!-- /.direct-chat-text -->
																</div><!-- /.direct-chat-msg -->
															</div><!-- /.box-body -->
														</div><!-- box box-primary col-md-12 -->
													</div>
													<!-- --------------------- -->
													<div class="col-md-8">
														<!-- USERS LIST -->
														<div class="box box-danger">
															<div class="box-header with-border">
																<h3 class="box-title">ผู้ประสบเหตุ / คู่กรณี</h3>
																<div class="box-tools pull-right">
																	<span class="label label-danger"></span>
																	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
																</div>
															</div><!-- /.box-header -->
															<div class="box-body no-padding">
																<div class="row">
																	<?php foreach ($value['results_participate'] as $people) { ?>
																	<div class="col-md-6">
																		<div class="box-body box-profile">
																			<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('dist/img/user4-128x128.jpg')?>"
																			 alt="User profile picture">
																			<h3 class="profile-username text-center">
																				<?php echo $people['people_name'];?>
																			</h3>
																			<p class="text-muted text-center">
																				<?php echo $people['people_type_name'];?>
																			</p>

																			<ul class="list-group list-group-unbordered">
																				<li class="list-group-item">
																					<b> หน่วยงานสังกัด</b> <a class="pull-right">
																						<?=$people['people_department_name'];?></a>
																				</li>
																				<li class="list-group-item">
																					<b>ประเภทบุคคล</b> <a class="pull-right">
																						<?php echo $people['victim_type_name'];?></a>
																				</li>
																			</ul>
																		</div><!-- /.box-body -->
																	</div>
																	<?php } ?>
																</div><!-- row -->
															</div><!-- /.box-body -->
														</div>
														<!--/.box -->
													</div>
												</div>
												<!--row -->

												<?php 
									$query = $this->db->where(array('image_category'=>'accd', 'category_id' => $results[0]['id']))->get('images');
									$images = $query->result_array();
									// print_r($images);
									$images_num_rows = $query->num_rows();
									if($images_num_rows > 0){
								?>

												<div class="row">
													<div class="box box-success box-solid mr-20 ml-20">
														<div class="box-header with-border">
															<h3 class="box-title">ภาพถ่ายเหตุการณ์</h3>
														</div><!-- /.box-header -->
														<div class="box-body">
															<?php foreach($images as $img){ ?>
															<div class="col-sm-12 col-md-4">
																<img class='img-responsive shadow-none p-3 mb-5 bg-light rounded' src="<?php echo base_url()."/uploads/".$img['image_path'];?>">
																 </div> <?php }//foreach ?>
															</div>
														</div>
													</div><!-- row -->
													<?php }//if ?>
												</div>
												<!--modal-body -->
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
							</td>

							<td class="text-center">
								<a href="<?php echo $link_go_to_form . '/' . $value['id'].'/index'; ?>" class="btn btn-warning">
									<i class="fa fa-pencil"></i>
								</a>
							</td>
							<td class="text-center">
								<a href="javascript:removeItem('<?php echo $value['id']; ?>', '<?php echo $link_go_to_remove; ?>')" class="btn btn-danger">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>

						</tr>
						<!-- <tr id="<php echo "acc_info".$value['id']; ?>" class="collapse content-wrapper">
							<td colspan="13">
								<div class="row">
									<div class="col-md-4">
										<div class="info-box bg-aqua">
											<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
											<div class="info-box-content">
												<span class="info-box-text">สาเหตู</span>
												<span class="info-box-number"><php echo $value['accident_cause_name']; ?></span>
												<div class="progress">
													<div class="progress-bar" style="width: 70%"></div>
												</div>
											</div><-- /.info-box-content --
										</div>	<-- /.info-box --

										<div class="box box-primary col-md-12">
            								<div class="box-header with-border">
              									<h3 class="box-title">รถที่เกิดเหตุ</h3>
              									<-- <div class="box-tools pull-right"> --
											</div><-- /.box-header --
            								<div class="box-body">
            									<div>
                									<div class="direct-chat-msg">
                  										<div class="direct-chat-info clearfix">
															<-- <span class="direct-chat-name pull-left">Alexander Pierce</span>
															<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span> --
														</div><-- /.direct-chat-info --
				  										<php foreach ($value['results_participate'] as $car) { ?>
															<div class="direct-chat-text">
																<php echo $car['car_body'];?>
														  	</div>
														<php } ?>
													</div><-- /.direct-chat-text --
                								</div><-- /.direct-chat-msg --
											</div><-- /.box-body --
            							</div><-- box box-primary col-md-12 --
										<div class="box box-primary col-md-12">
            								<div class="box-header with-border">
              									<h3 class="box-title">เจ้าหน้าที่ที่รับผิดชอบ</h3>
              									<-- <div class="box-tools pull-right"> --
											</div><-- /.box-header --
            								<div class="box-body">
            									<div>
                									<div class="direct-chat-msg">
                  										<div class="direct-chat-info clearfix">
														</div><-- /.direct-chat-info --
															<div class="direct-chat-text">
																<php 
																// print_r($results);
																	$complainter = $users_model->find($value['recorder']);
																	echo $complainter['results']->name;
																?>
														  	</div>
													</div><-- /.direct-chat-text --
                								</div><-- /.direct-chat-msg --
											</div><-- /.box-body --
            							</div><-- box box-primary col-md-12 --
									</div>
										<-- --------------------- --
									<div class="col-md-8">
										<-- USERS LIST --
										<div class="box box-danger">
											<div class="box-header with-border">
												<h3 class="box-title">ผู้ประสบเหตุ / คู่กรณี</h3>
												<div class="box-tools pull-right">
													<span class="label label-danger"></span>
													<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
												</div>
											</div><-- /.box-header --
											<div class="box-body no-padding">
												<div class="row">
													<php foreach ($value['results_participate'] as $people) { ?>
														<div class="col-md-6">
															<div class="box-body box-profile">
																<img class="profile-user-img img-responsive img-circle" src="<php echo base_url('dist/img/user4-128x128.jpg')?>" alt="User profile picture">
																<h3 class="profile-username text-center"><php echo $people['people_name'];?></h3>
																<p class="text-muted text-center"><php echo $people['people_type_name'];?></p>
																
																<ul class="list-group list-group-unbordered">
																	<li class="list-group-item">
																		<b> หน่วยงานสังกัด</b> <a class="pull-right"><=$people['people_department_name'];?></a>
																	</li>
																	<li class="list-group-item">
																		<b>ประเภทบุคคล</b> <a class="pull-right"><php echo $people['victim_type_name'];?></a>
																	</li>		
																</ul>
															</div><-- /.box-body --
														</div>
													<php } ?>
												</div><-- row --
											</div><-- /.box-body --
										</div><--/.box --
									</div>
								</div><--row 

								<php 
									$query = $this->db->where(array('image_category'=>'accd', 'category_id' => $results[0]['id']))->get('images');
									$images = $query->result_array();
									// print_r($images);
									$images_num_rows = $query->num_rows();
									if($images_num_rows > 0){
								?>

										<div class="row">
											<div class="box box-success box-solid mr-20 ml-20">
												<div class="box-header with-border">
													<h3 class="box-title">ภาพถ่ายเหตุการณ์</h3>
												</div><-- /.box-header --
												<div class="box-body">
													<php foreach($images as $img){ ?>
														<div class="col-sm-12 col-md-4">
															<img class='img-responsive shadow-none p-3 mb-5 bg-light rounded' src="<?php echo base_url()."/uploads/".$img['image_path'];?>">
														</div>
													<php	}//foreach ?>
												</div>
											</div>
										</div>-- row --
								<php }//if ?>

							</td>
						</tr> -->
						<?php }?>
					</tbody>

				</table>
			</div>

		</div>

		<div class="box-footer">
		</div>
	</div>
	<?php $this->load->view('dashboard_admin_bar_chart_monthly');?>
