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
			<?php $i=1;?>
			<table class="table table-bordered table-striped mydataTable2" id="myTable">
				<thead>
					<tr>
						<th>#</th>
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
						<td><?php echo $i++;?></td>
						<td class="text-center">
							<?php echo $value['date_forget_key'];?>
						</td>
						<td class="text-left">
							<?php echo $value['owner_assets_name']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['owner_assets_department']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['owner_assets_age']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['owner_assets_phone']; ?>
						</td>
						<td>
							<?php echo $value['owner_assets_forget_key_place']; ?>
						</td>
						<td class="text-center">
							<?php echo $value['status_name']; ?>
						</td>

						<td class="text-center">
							<a href="javascript::void()" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo "m_vh-fg-key_info".$value['id']; ?>">
								<i class="fa fa-eye"></i></a>
							<!-- Modal -->
							<div class="modal fade " id="<?php echo "m_vh-fg-key_info".$value['id']; ?>" tabindex="-1" role="dialog"
								aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลการลืมกุญแจรถจักรยานยนต์</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										<?php
											$data = array(
												'case' => 'vehicles_forget_key',
												'cause_title' => 'สถานที่ลืม',
												'vh_fg_key_info' => $value,
												'image_category'=> 'vh-fg-k',
												'category_id' => $value['id']
											);
											
											$this->load->view('show_info_toggle', $data);
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
							<a data-toggle="collapse" href="#<php echo "vh-fg-key_info".$value['id']; ?>" role="button" aria-expanded="false" 
								class="btn btn-info" aria-controls="<php echo "vh-fg-key_info".$value['id']; ?>"><i class="fa fa-eye"></i></a>
				
						</td> -->
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
					 <!-- แสดงข้อมูล -->
					<!-- <tr id="<php echo "vh-fg-key_info".$value['id']; ?>" class="collapse content-wrapper">
						<td colspan="11">
							<php
								$data = array(
									'case' => 'vehicles_forget_key',
									'cause_title' => 'สถานที่ลืม',
									'vh_fg_key_info' => $value,
									'image_category'=> 'vh-fg-k',
									'category_id' => $value['id']
								);
								 
								$this->load->view('show_info_toggle', $data);
							?>
						</td>
						
					</tr>  -->
					<!-- end แสดงข้อมูล -->
					<?php }?>
				</tbody>
				
			</table>
		</div>

		<div class="box-footer">
			
		</div>
	</div>

	<?php $this->load->view('dashboard_admin_bar_chart_monthly');?>
