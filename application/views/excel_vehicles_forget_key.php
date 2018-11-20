<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=excel.xls");
header("Pragma: public");
header("Cache-Control: max-age=0");
set_time_limit(0);
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table border="1">
	<tr>
		<th class="text-center">นักศึกษา (คน)</th>
		<th class="text-center">บุคลากร (คน)</th>
		<th class="text-center">บุคคลภายนอก (คน)</th>
		<th class="text-center">ไม่ได้ระบุประเภท (คน)</th>

		<th class="text-center">รวม</th>
	</tr>
	<tr>
		<td class="text-center"><?php echo $count_students =='' ? 0 : $count_students; ?> </td>
		<td class="text-center"><?php echo $count_staff == '' ? 0 : $count_staff; ?> </td>
		<td class="text-center"><?php echo $count_people_outside == '' ? 0 : $count_people_outside; ?> </td>
		<td class="text-center"><?php echo $no_people_type == '' ? 0 : $no_people_type; ?> </td>

		<td class="text-center"><?php echo $count_students+ $count_staff +$count_people_outside+$no_people_type; ?> </td>

	</tr>
</table>
<br>
<table border="1">
	<thead>
		<tr>
			<?php foreach ($header_columns as $key => $value)
			{
			?>
			<th>
				<?php echo $value; ?>
			</th>
			<?php }?>
			<th>ประเภทบุคคล</th>
		</tr>
		
	</thead>
	<tbody>
		<?php foreach ($results as $key => $value)
{
    ?>
		<tr>	
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
					$i=0;
					foreach($complainters as $complainter){
						echo $complainter['name'];
						$i++; 
						if($i != $complainters['rows']){
							echo $complainter['name'] !="" ? ',    ' : '';
						}									
					}
				}else{
					echo 'ไม่ได้ระบุ';

				}
				
			
					// $query = $this->db->where('id', $value['detective_name'])->get('users');
					// $detective = $query->result_array();
					// $detective_rows = $query->num_rows();
					// echo $detective_rows>0 ? $detective[0]['name'] : 'ยังไม่ระบุ'; 
				?>
			</td>
			<td><?php 
					if($value['people_type'] == 'student'){
						$str = 'นักศึกษา';
					}else if($value['people_type'] == 'people_outside'){
						$str = 'บุคคลภายนอก';
					}else{
						$str = 'บุคลากร';
					}
					echo $str;?></td>
		</tr>	
		<?php }?>
	</tbody>
	
</table>
