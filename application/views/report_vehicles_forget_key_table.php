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
				<div class="col-md-12">
					<?php $this->load->view('header_form_search_data');?>
					<div class="form-group">
						<label for="start_date" class="col-sm-2 control-label">วันที่</label>

						<div class="col-sm-2">
							<input type="text" class="form-control datepicker" id="start_date" name="start_date" data-provide="datepicker"
							 data-date-language="th-th" placeholder="วันที่" value="<?php echo $start_date; ?>">
						</div>
						<label for="end_date" class="col-sm-1 control-label">ถึง</label>

						<div class="col-sm-2">
							<input type="text" class="form-control datepicker" id="end_date" name="end_date" data-provide="datepicker"
							 data-date-language="th-th" placeholder="ถึง" value="<?php echo $end_date; ?>">
						</div>

						<div class="col-sm-2">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button>
						</div>

					</div>
					</form>
				</div>
			</div>

			<br />

			<div class="table-responsive">
				<table class="table table-bordered table-striped mydataTable">
					<thead>
						<tr>
							<th>#</th>
							<?php foreach ($header_columns as $key => $value){?>
							<th class="text-center">
								<?php echo $value; ?>
							</th>
							<?php }?>
							<th>หมายเหตุ</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach ($results as $key => $value){?>

						<tr>
							<td class="text-center"><?php echo $i++;?></td>
							<td class="text-center">
								<?php echo $value['date_forget_key'];?>
							</td>
							<td class="text-center">
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
							<td>
							<?php
							
							$query = $this->db->where('vehicles_forget_key_id',$value['id'])
							->join('users','users.id = vehicles_forget_key_detective.name' ,'left')
							->get('vehicles_forget_key_detective');
							
							$complainters = $query->result_array();
							$complainters['rows'] = $query->num_rows();
							if($complainters['rows'] >0){
								foreach($complainters as $complainter){
									echo '<p class="text-muted"> ' .$complainter['name'].'</p>';
								}
							}else{
								echo '<p class="text-muted"> ไม่ได้ระบุ</p>';

							}
					
							?>
						</td>
						<td><?php echo $value['detective_remark'];?></td>
						</tr>
						<?php }?>

					</tbody>

				</table>

			</div>

		</div>

		<div class="box-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<a href="<?php echo $link_excel_monthly_summary;?>" target="_blank" class="btn btn-success"><i class="fa  fa-file-excel-o"></i>
						Excel สรุปแต่ละพื้นที่</a>
					<a href="<?php echo $link_excel_monthly;?>" target="_blank" class="btn btn-success"><i class="fa  fa-file-excel-o"></i>
						Excel ทั้งหมด</a>
				</div>
			</div>
		</div>
	</div>

	<?php 
    $this->load->view('dashboard_admin_bar_chart_monthly');
    $this->load->view('report_barchart_values_forget_keys_count_each_people_types');
  ?>
