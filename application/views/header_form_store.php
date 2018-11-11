<style>
	.process-step .btn:focus{outline:none}
    .process{display:table;width:100%;position:relative}
    .process-row{display:table-row}
    .process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
    .process-row:before{top:40px;bottom:0;position:absolute;content:" ";width:100%;height:1px;background-color:#ccc;z-order:0}
    .process-step{display:table-cell;text-align:center;position:relative}
    .process-step p{margin-top:4px}
    .btn-circle{width:80px;height:80px;text-align:center;font-size:12px;border-radius:50%}

</style>
<?php //echo "<pre>";print_r($header_content); ?>
<div class="row">
	<div class="process">
		<div class="process-row nav nav-tabs">
			<div class="process-step">
				<button type="button" class="btn  btn-circle <?php echo  $this->session->flashdata('tab_status') == 'main_info' ? 'btn-info' : 'btn-default';?>"
				 data-toggle="tab" href="#menu1"><i class="fa fa-info fa-3x"></i></button>
				<p><small>ข้อมูล<br /><?php echo $header_content['main_info']['topic'];?></small></p>
			</div>
            <?php if($header_content['complainter'] != false){ ?>
			<div class="process-step">
				<button type="button" class="btn  btn-circle <?php echo  $this->session->flashdata('tab_status') == 'complainter' ? 'btn-info' : 'btn-default';?>"
				 data-toggle="tab" href="#menu2"><i class="fa fa-file-text-o fa-3x"></i></button>
				<p><small>ข้อมูล<br /><?php echo $header_content['complainter']['topic'];?></small></p>
			</div>
            <?php } ?>
			<div class="process-step">
				<button type="button" class="btn  btn-circle  <?php echo  $this->session->flashdata('tab_status') == 'upload_images' ? 'btn-info' : 'btn-default';?>"
				 data-toggle="tab" href="#menu3"><i class="fa fa-image fa-3x"></i></button>
				<p><small>อัพโหลด<br />รูปภาพ</small></p>
			</div>
			<!-- <div class="process-step">
							<button type="button" class="btn btn-default btn-circle" data-toggle="tab" href="#menu4"><i class="fa fa-cogs fa-3x"></i></button>
							<p><small>บันทึก<br />ข้อมูลเรียบร้อย</small></p>
						</div> -->
		</div>
	</div>
</div>
