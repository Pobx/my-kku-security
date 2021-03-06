
		<div class="form-group">
		<label for="accident_date" class="col-sm-2 control-label">วันที่</label>

		<div class="col-sm-2">
			<input type="text" class="form-control datepicker" id="accident_date" name="accident_date" data-provide="datepicker"
			data-date-language="th-th" placeholder="วันที่" value="<?php echo $accident_date; ?>">
		</div>

		<label for="date_break" class="col-sm-1 control-label">เวลา</label>

		<div class="col-sm-2">
			<input type="text" class="form-control" id="accident_time" name="accident_time" placeholder="เวลา" value="<?php echo $accident_time; ?>"
			data-inputmask='"mask": "99:99"' data-mask>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">ช่วงเวลา</label>

		<div class="col-sm-4">
			<label></label>
				<input type="radio" name="period_time" class="flat-red" value="morning" <?php if ($period_time=='morning' ) { echo
				"checked" ;}?>>&nbsp;เช้า
				<input type="radio" name="period_time" class="flat-red" value="afternoon" <?php if ($period_time=='afternoon' ) {
				echo "checked" ;}?>>&nbsp;บ่าย
				<input type="radio" name="period_time" class="flat-red" value="night" <?php if ($period_time=='night' ) { echo
				"checked" ;}?>>&nbsp;ดึก
			</label>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">สถานที่</label>
		<div class="col-sm-4">
			<select class="form-control select2" name="place" id="place">
				<option>เลือก</option>
				<?php foreach ($accident_place as $key => $value) {?>
				<option value="<?php echo $value['id'];?>" <?php if ($place==$value['id']) { echo 'selected' ;}?>>
					<?php echo $value['name'];?>
				</option>
				<?php }?>
			</select>

			<input type="text" name="place_text" id="place_text" class="form-control">
		</div>

		<div class="col-sm-2">
			<input type="checkbox" class="flat-red" name="chk_place" value="checked_new_place">&nbsp;สถานที่(อื่นๆ)
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">สาเหตุ</label>
		<div class="col-sm-4">
			<select class="form-control select2" name="accident_cause" id="accident_cause">
				<option>เลือก</option>
				<?php foreach ($accident_causes as $key => $value) {?>
				<option value="<?php echo $value['id'];?>" <?php if ($accident_cause==$value['id']) { echo 'selected' ;}?>>
					<?php echo $value['name'];?>
				</option>
				<?php }?>
			</select>

			<input type="text" name="accident_cause_text" id="accident_cause_text" class="form-control">
		</div>

		<div class="col-sm-2">
			<input type="checkbox" class="flat-red" name="chk_accident_cause" value="checked_new_accident_cause">&nbsp;สาเหตุ(อื่นๆ)
		</div>
	</div>

	<?php  $i=0; 
		if($accident_asset_destroyed['numrows']>0 ){ ?>
		<?php foreach($accident_asset_destroyed['data'] as $key =>  $data){ ?>
			<div class="form-group" id="assets_name_".$key>
				<label for="" class="col-sm-2 control-label"><?php echo  $i == 0 ? 'ทรัพย์สินราชการเสียหาย' : '';  $i=1;?></label>
				<!-- <label for="assets_name" class="col-sm-1 control-label">ชื่อทรัพย์สิน</label> -->
				<div class="col-sm-4">
					<input type="text" class="form-control" id="assets_name" name="assets_name[]" placeholder="ชื่อทรัพย์สิน" value="<?php echo $data['asset_name']; ?>">
				</div>

				<label for="assets_amount" class="col-sm-1 control-label">จำนวน</label>

				<div class="col-sm-1">
					<input type="number" class="form-control" id="assets_amount[]" name="assets_amount[]"  value="<?php echo $data['asset_amount']; ?>">
				</div>
				<div class="col-sm-1"><a href="javascript:append_assets_amount(<?=$data['id'];?>)" class="btn btn-info sm" id="append_assets_form_<?=$data['id'];?>" style="display:''"><b>+</b></a></div>
				<div class="col-sm-1"><a href="javascript:_delete(<?=$data['id'];?>)" class="btn btn-danger sm" id="del_assets_form_<?=$data['id'];?>" style="display:none"><b>-</b></a></div>
				<input type="hidden"  id="assets_destroyed_id" name="assets_destroyed_id[]"  value="<?php echo $data['id']; ?>">
			</div>
		<?php } ?>
	<?php }else{ ?>

	<div class="form-group" id="assets_name_0">
	
		<label for="" class="col-sm-2 control-label">ทรัพย์สินราชการเสียหาย</label>
		<!-- <label for="assets_name" class="col-sm-1 control-label">ชื่อทรัพย์สิน</label> -->
		<div class="col-sm-4">
			<input type="text" class="form-control" id="assets_name" name="assets_name[]" placeholder="ชื่อทรัพย์สิน" value="<?php echo $assets_name; ?>">
		</div>

		<label for="assets_amount" class="col-sm-1 control-label">จำนวน</label>

		<div class="col-sm-1">
			<input type="number" class="form-control" id="assets_amount[]" name="assets_amount[]"  value="<?php echo $assets_amount; ?>">
		</div>
		<div class="col-sm-1"><a href="javascript:append_assets_amount(0)" class="btn btn-info sm"><b>+</b></a></div>

	</div>

	<?php } ?>
	<div id="append_assets_name"></div>
	<?php if($this->session->userdata('roles') == 'admin'){ ?>	
		<div class="form-group">
			<label for="assets_remark" class="col-sm-2 control-label">เจ้าหน้าที่ผู้รับเรื่อง</label>
			<div class="col-sm-4">
				<select name="recorder" id="recorder" class="form-control accedent_recorder select2">
					<option>เลือก...</option>
					<?php foreach($users['results'] as $user){ ?>
					<option value="<?php echo $user['id'];?>" <?php echo   $recorder == $user['id'] ? 'selected' : '' ?>><?php echo $user['name'];?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	<?php } ?>
	<div class="form-group">
	<label for="assets_remark" class="col-sm-2 control-label">หมายเหตุ</label>

		<div class="col-sm-4">
			<textarea class="form-control" id="assets_remark" name="assets_remark" placeholder="หมายเหตุ"><?php echo $assets_remark; ?></textarea>
			<!-- <input type="text" class="form-control" id="assets_remark" name="assets_remark" placeholder="หมายเหตุ" value="<php echo $assets_remark; ?>"> -->
		</div>
	</div>
	
	
