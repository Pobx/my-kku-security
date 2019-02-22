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
					<a href="<?php echo $link_go_to_form; ?>" class="btn btn-primary">
						<i class="fa fa-plus-circle"></i>
						เพิ่มข้อมูลใหม่
					</a>
				</div>
			</div>

			<br />

			<table class="table table-bordered table-striped mydataTable2">
				<thead>
					<tr>
						<?php foreach ($header_columns as $key => $value)
{
    ?>
						<th class="text-center">
							<?php echo $value; ?>
						</th>
						<?php }?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($results as $key => $value)
{
    ?>
					<tr>
						<td class="text-center">
							<?php echo $value['period_time_name'];?>
						</td>
						<td class="text-center">
							<?php echo $value['inspect_date']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['place']; ?>
						</td>
						<td class="text-center">
							<?php 
								echo $value['people_type_name'];
							?>
						</td>
						<td class="text-center">
							<?php echo $value['people_name']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['people_code']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['department_name']; ?>
						</td>
						<td>
							<?php echo $value['car_body']; ?>
						</td>

						<td class="text-center">
							<a href="javascript::void()" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo "
							 m_std_no_hm_info".$value['id']; ?>">
								<i class="fa fa-eye"></i></a>
							<!-- Modal -->
							<div class="modal fade " id="<?php echo " m_std_no_hm_info".$value['id']; ?>" tabindex="-1" role="dialog"
								aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลการงัดที่พักอาศัย</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<?php
												$data = array(
													'case' => 'break_homes',
													'cause_title' => 'สถานที่เกิดเหตุ',
													'std_no_hm_info' => $value,
													'image_category'=> 'std-no-hm',
													'category_id' => $value['id']
												);
												
												$this->load->view('student_no_helmet_show_info_toggle', $data);
											?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</td>

						<!-- <td class="text-center">
							<a data-toggle="collapse" href="#<php echo "std_no_hm_info".$value['id']; ?>" role="button" aria-expanded="false" 
								class="btn btn-info" aria-controls="<php echo "std_no_hm_info".$value['id']; ?>"><i class="fa fa-eye"></i></a>
						</td> -->

						<td class="text-center">
							<a href="<?php echo $link_go_to_form . '/' . $value['id']; ?>" class="btn btn-warning">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td class="text-center">
							<a href="javascript:removeItem('<?php echo $value['id']; ?>', '<?php echo $link_go_to_remove; ?>')" class="btn btn-danger">
								<i class="fa fa-trash-o"></i>
							</a>
						</td>

					</tr>

					<!-- แสดงข้อมูล -->
					<!-- <tr id="<php echo "std_no_hm_info".$value['id']; ?>" class="collapse content-wrapper">
						<td colspan="11">
							<php
								$data = array(
									'case' => 'break_homes',
									'cause_title' => 'สถานที่เกิดเหตุ',
									'std_no_hm_info' => $value,
									'image_category'=> 'std-no-hm',
									'category_id' => $value['id']
								);
								 
								$this->load->view('student_no_helmet_show_info_toggle', $data);
							?>
						</td>
					</tr> -->
					<!-- end แสดงข้อมูล -->
					<?php }?>
				</tbody>

			</table>
		</div>

		<div class="box-footer">
		</div>
	</div>

	<?php $this->load->view('dashboard_admin_bar_chart_monthly');?>
