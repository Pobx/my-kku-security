<style>
	.hide{
		display:none;
	}
	.show{
		display:block;
	}
</style>
<section class="content">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">
				<?php echo $head_sub_topic_label; ?>
			</h3>
		</div>

		<div class="box-body">

			<!-- <form class="form-horizontal form_submit_data"> -->
			<?php $this->load->view('header_form_submit_data');?>
			<div class="box-header">
				<?php $this->load->view('button_save_and_back_page_in_form');?>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label for="date_break" class="col-sm-2 control-label">วันที่</label>
					<div class="col-sm-4">
						<input type="text" class="form-control datepicker" id="date_break" name="date_break" data-provide="datepicker"
						data-date-language="th-th" placeholder="วันที่" value="<?php echo $date_break;?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="time_break" class="col-sm-2 control-label">เวลา</label>
					<div class="col-sm-4">
						<input type="text" class="form-control"  data-date-language="th-th" id="time_break" name="time_break" placeholder="เวลา" value="<?php echo $time_break;?>">
					</div>
				</div>

				<div class="form-group">
					<label for="owner_home_name" class="col-sm-2 control-label">ชื่อ&nbsp;-&nbsp;สกุล</label>

					<div class="col-sm-4">
						<input type="text" class="form-control" id="victim_name" name="victim_name" placeholder="ชื่อ - สกุล" value="<?php echo $victim_name;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="victim_phone" class="col-sm-2 control-label">เบอร์ติดต่อ</label>

					<div class="col-sm-4">
						<input type="text" class="form-control" id="victim_phone" name="victim_phone" placeholder="เบอร์ติดต่อ" value="<?php echo $victim_phone;?>">
					</div>
				</div>
				<div class="form-group">
					<label for="department" class="col-sm-2 control-label">สังกัด/หน่วยงาน</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="department" name="department" placeholder="สังกัด/หน่วยงาน" value="<?php echo $department;?>">
					</div>
				</div>

				<div class="form-group">
					<label for="type_address" class="col-sm-2 control-label">ประเภทสถานที่เกิดเหตุ</label>
					<div class="col-sm-4">
					  <select class="form-control" id="type_address" name="type_address">
					   <option value="">เลือก</option>
					   <option value="home" <?php if($type_address=="home"){ echo "selected"; } ?>>บ้านพัก</option>
					   <option value="flat" <?php if($type_address=="flat"){ echo "selected"; } ?> >แฟลต</option>
					   <option value="office" <?php if($type_address=="office"){ echo "selected"; } ?>  >สำนักงาน</option>
					   <option value="other"  <?php if($type_address=="other"){ echo "selected"; } ?> >อื่นๆ</option>
					  </select>
 					</div>
				</div>
   
           
				<div class="<?=$address !="" ? 'form-group show' : 'form-group show';?>" id="adress_info">
					<label for="address" class="col-sm-2 control-label">ที่อยู่สถานที่เกิดเหตุ</label>
					<div class="col-sm-4">
						<textarea class="form-control" rows="3" id="address" name="address" placeholder="สถานที่เกิดเหตุ"><?php echo $address;?></textarea>
					</div>
				</div>
          

				<div class="form-group">
					<label for="assets_loses" class="col-sm-2 control-label">ทรัพย์สินที่เสียหาย</label>

					<div class="col-sm-4">
						<textarea class="form-control" rows="3" id="assets_loses" name="assets_loses" placeholder="ทรัพย์สินที่เสียหาย"><?php echo $assets_loses;?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="victim_process" class="col-sm-2 control-label">การดำเนินการ</label>
					<div class="col-sm-4">
						<input type="radio"  id="victim_process1" class="victim_process" name="victim_process" value="bill"  <?php if($victim_process=="bill"){ echo "checked"; } ?>>
						<label for="victim_process">มีบันทึกประจำวัน</label><br>
						<input type="radio"  id="victim_process2" class="victim_process" name="victim_process" value="camera" <?php if($victim_process=="amera"){ echo "checked"; } ?>>
						<label for="victim_process">ขอดูกล้องวงจรปิด</label><br>
						<input type="radio"  id="victim_process3" class="victim_process" name="victim_process" value="other" <?php if($victim_process=="other"){ echo "checked"; } ?>>
						<label for="victim_process">อื่นๆ</label>
						<input type="text" class="<?=$victim_process == 'other' ? 'form-control show' : 'form-control hide';?>" id="victim_process_note" name="victim_process_note" placeholder="" value="<?php echo $victim_process_note;?>">
					</div>
				</div>

				<div class="form-group">
					<label for="staff_process" class="col-sm-2 control-label">การติดตามจับกุม</label>
					<div class="col-sm-4">
					    <input type="radio"  id="staff_process" name="staff_process" value="yes"  <?php if($staff_process=="yes"){ echo "checked"; } ?>>
						<label for="staff_process">จับได้</label><br>
						<input type="radio"  id="staff_process" name="staff_process" value="no"  <?php if($staff_process=="no"){ echo "checked"; } ?>>
						<label for="staff_process">จับไม่ได้</label><br>
 					</div>
				</div>

				<div class="form-group">
					<label for="remark" class="col-sm-2 control-label">หมายเหตุ</label>

					<div class="col-sm-4">
						<input type="text" class="form-control" id="remark" name="remark" placeholder="หมายเหตุ" value="<?php echo $remark;?>">
					</div>
				</div>

			</div>

			<div class="box-footer">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="hidden" name="status" value="active">
				<?php $this->load->view('button_save_and_back_page_in_form');?>
			</div>
			</form>
		</div>
	</div>
<script>
/*
	 $('#type_address').change(function(){
		 var address =  $(this).val();
		 if(address == ""){
			$('#adress_info').attr('class', 'form-group hide');
		 }else{
			$('#adress_info').attr('class', 'form-group show');
		 } 
	 })
*/
	  $('.victim_process').click(function(){
		var vprocess =  $(this).val();
		if(vprocess == "other"){
			$('#victim_process_note').attr('class', 'form-control show');
		 }
		else{
			$('#victim_process_note').attr('class', 'form-control hide');
		 }
	  })
</script>