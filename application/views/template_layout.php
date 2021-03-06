<?php
$sess_userprofile = $this->session->userdata();
if (!isset($sess_userprofile['logged']) || $sess_userprofile['logged'] == false)
{
    redirect('authen');
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ระบบ ร.ป.ภ มหาวิทยาลัยขอนแก่น</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css'); ?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/Ionicons/css/ionicons.min.css'); ?>">
	<!-- DataTables -->
	<!-- <link rel="stylesheet" href="<php echo base_url('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>"> -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/all.css'); ?>">
	<!-- bootstrap datepicker-thai -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/bootstrap-datepicker-thai/css/datepicker.css'); ?>">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/select2/dist/css/select2.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css'); ?>">

	<link rel="stylesheet" href="<?php echo base_url('dist/css/my.css'); ?>">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css'); ?>">
	<!-- Morris chart -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/morris.js/morris.css'); ?>">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/jvectormap/jquery-jvectormap.css'); ?>">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

	<!-- jQuery 3 -->
	<script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url('bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>

	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="#" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>ร.ป.ภ</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>ระบบ ร.ป.ภ มข</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">

						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url('dist/img/avatar04.png'); ?>" class="user-image" alt="User Image">
								<span class="hidden-xs">
									<?php echo $sess_userprofile['name']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?php echo base_url('dist/img/avatar04.png'); ?>" class="img-circle" alt="User Image">

									<p>
										<?php echo $sess_userprofile['name']; ?>
										<!-- <small>Member since Nov. 2012</small> -->
									</p>
								</li>
								<!-- Menu Body -->
								<li class="user-body">

								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-right">
										<a href="<?php echo site_url('authen/logout'); ?>" class="btn btn-default btn-flat">ออกจากระบบ</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url('dist/img/avatar04.png'); ?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?php echo $sess_userprofile['name']; ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<?php
						// if ($sess_userprofile['roles'] != 'security')
						// {
							$this->load->view('sidebar_admin');
						// }
					?>

					<li>
						<a href="<?php echo site_url('authen/logout'); ?>"><i class="fa fa-sign-out"></i> <span class="text-red">ออกจากระบบ</span></a>
					</li>
				</ul>
			</section>


		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?php
$head_topic_label = (isset($head_topic_label) ? $head_topic_label : '');
echo $head_topic_label;
?>
					<small>
						<?php
$head_sub_topic_label = (isset($head_sub_topic_label) ? $head_sub_topic_label : '');
echo $head_sub_topic_label;
?>
					</small>
				</h1>

				<!-- <ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Dashboard</li>
				</ol> -->
			</section>

			<!-- Main content -->
			<section class="content">
				<?php if ($this->session->flashdata('alert_type') != '')
{
    ?>
				<div class="alert alert-<?php echo $this->session->flashdata('alert_type'); ?> alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-<?php echo $this->session->flashdata('alert_icon'); ?>"></i> ระบบแจ้งเตือน</h4>
					<?php echo $this->session->flashdata('alert_message'); ?>
				</div>
				<?php }?>

				<?php
        $bar_chart_data = (isset($bar_chart_data)? $bar_chart_data : 'off');
        $barchart_values_accidents_summary_of_months = (isset($barchart_values_accidents_summary_of_months)? $barchart_values_accidents_summary_of_months : 'off');
        $pie_chart_display = (isset($pie_chart_display)? $pie_chart_display : 'off');
        $reports_evaluations_dispaly = (isset($reports_evaluations_dispaly)? $reports_evaluations_dispaly : 'off');
        $piechart_values_between_ages = (isset($piechart_values_between_ages)? $piechart_values_between_ages : json_encode(array()));
        $barchart_values_status = (isset($barchart_values_status)? $barchart_values_status : json_encode(array()));
        $barchart_values_performance = (isset($barchart_values_performance)? $barchart_values_performance : json_encode(array()));
        $barchart_values_success = (isset($barchart_values_success)? $barchart_values_success : json_encode(array()));
        $barchart_values_timeline = (isset($barchart_values_timeline)? $barchart_values_timeline : json_encode(array()));
        $barchart_values_service_clear = (isset($barchart_values_service_clear)? $barchart_values_service_clear : json_encode(array()));
        $barchart_values_materials = (isset($barchart_values_materials)? $barchart_values_materials : json_encode(array()));
        $barchart_values_servicemind = (isset($barchart_values_servicemind)? $barchart_values_servicemind : json_encode(array()));
        $barchart_values_communication = (isset($barchart_values_communication)? $barchart_values_communication : json_encode(array()));
        $barchart_values_knowlage = (isset($barchart_values_knowlage)? $barchart_values_knowlage : json_encode(array()));
        $barchart_values_questions = (isset($barchart_values_questions)? $barchart_values_questions : json_encode(array()));
        $barchart_values_followup = (isset($barchart_values_followup)? $barchart_values_followup : json_encode(array()));
        $barchart_values_forget_keys = (isset($barchart_values_forget_keys)? $barchart_values_forget_keys : 'off');

        $count_accidents = (isset($count_accidents)? $count_accidents : 0);
        $count_break_homes = (isset($count_break_homes)? $count_break_homes : 0);
        $count_security_home = (isset($count_security_home)? $count_security_home : 0);
        $count_vehicles_forget_key = (isset($count_vehicles_forget_key)? $count_vehicles_forget_key : 0);
        $count_break_motorcycle_pad = (isset($count_break_motorcycle_pad)? $count_break_motorcycle_pad : 0);
        $count_student_do_not_wear_helmet = (isset($count_student_do_not_wear_helmet)? $count_student_do_not_wear_helmet : 0);
        
if (isset($content))
{
	$this->load->view($content);
	
}
else
{
    $this->load->view('blank_page');
}
?>
			</section>

		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1
			</div>
			<!-- <strong>Copyright &copy; 2018 <a href="#">Itechs Development Team</a>.</strong> All rights -->
			<!-- <strong>ระบบ ร.ป.ภ มหาวิทยาลัยขอนแก่น.</strong> -->
			<strong>
				<?php
$now_date = date('d/m') . '/' . (date('Y') + 543) . ' ' . date('H:i:s');
echo 'ขณะนี้เวลา  ' . $now_date;
?>
			</strong>
		</footer>

		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->

	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);

	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!-- Morris.js charts -->
	<script src="<?php //echo base_url('bower_components/raphael/raphael.min.js'); ?>"></script>
	<script src="<?php //echo base_url('bower_components/morris.js/morris.min.js'); ?>"></script>
	<!-- Sparkline -->
	<script src="<?php //echo base_url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
	<!-- jvectormap -->
	<script src="<?php //echo base_url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
	<script src="<?php //echo base_url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php //echo base_url('bower_components/jquery-knob/dist/jquery.knob.min.js'); ?>"></script>
	<!-- daterangepicker -->
	<script src="<?php echo base_url('bower_components/moment/min/moment.min.js'); ?>"></script>
	<script src="<?php //echo base_url('bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php //echo base_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
	<!-- Slimscroll -->
	<script src="<?php //echo base_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
	<!-- FastClick -->
	<script src="<?php //echo base_url('bower_components/fastclick/lib/fastclick.js'); ?>"></script>
	<!-- DataTables -->
  <script src="<?php echo base_url('bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>

	<!-- iCheck 1.0.1 -->
	<script src="<?php echo base_url('plugins/iCheck/icheck.min.js'); ?>"></script>

	<!-- InputMask -->
	<script src="<?php echo base_url('plugins/input-mask/jquery.inputmask.js'); ?>"></script>
	<script src="<?php echo base_url('plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
	<script src="<?php echo base_url('plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>

	<!-- bootstrap datepicker -->
	<script src="<?php //echo base_url('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url('bower_components/chart.js/Chart.js'); ?>"></script>

	<!-- bootstrap datepicker-thai -->
	<script src="<?php echo base_url('plugins/bootstrap-datepicker-thai/js/bootstrap-datepicker.js'); ?>"></script>
	<script src="<?php echo base_url('plugins/bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js'); ?>"></script>
	<script src="<?php echo base_url('plugins/bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js'); ?>"></script>

	<!-- Select2 -->
	<script src="<?php echo base_url('bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>

	<script src="<?php echo base_url('assets/demo/Chart.bundle.min.js');?>"></script>

	<!-- my demo -->
	<script src="<?php echo base_url('assets/demo/dashboard_admin_donut_chart.js'); ?>"></script>
	<script src="<?php echo base_url('assets/demo/dashboard_admin_bar_chart_monthly.js'); ?>"></script>
	<script src="<?php echo base_url('assets/demo/piechart.js'); ?>"></script>
	<script src="<?php echo base_url('assets/demo/barchart.js'); ?>"></script>
	
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('dist/js/adminlte.min.js'); ?>"></script>
	<script>
		$(function () {
			$('.accident_recorder').select2()
			$('.vehicle_forget_key_recorder').select2()
			Chart.defaults.global.defaultFontFamily = "'Kanit', sans-serif";
			var pie_chart_display = '<?php echo $pie_chart_display;?>';

			if (pie_chart_display == 'on') {
				var pie_chart_data = {
					data: [
						'<?php echo $count_accidents;?>',
						'<?php echo $count_break_homes;?>',
						'<?php echo $count_security_home;?>',
						'<?php echo $count_vehicles_forget_key;?>',
						'<?php echo $count_break_motorcycle_pad;?>',
						'<?php echo $count_student_do_not_wear_helmet;?>'
					],
					backgroundColor: [
						'#dd4b39',
						'#00a65a',
						'#00c0ef',
						'#f39c12',
						'#ff851b',
						'#0073b7',
					],
					labels: [
						'สถิติอุบัติเหตุ',
						'โครงการฝากบ้าน',
						'สถิติการลืมกุญแจ',
						'สถิติเหตุทรัพย์งัดที่พักอาศัย',
						'สถิติงัดเบาะรถจักยานยนต์',
						'สถิติไม่สวมหมวกนิรภัย',
					]
				}

				// console.log(pie_chart_data)
				myPieChart(pie_chart_data, '#dashboard_piechart');
			}

			var bar_chart_data = '<?php echo $bar_chart_data;?>';
			var barchart_values_accidents_summary_of_months = '<?php echo $barchart_values_accidents_summary_of_months;?>';
			var barchart_values_forget_keys = '<?php echo $barchart_values_forget_keys;?>';

			if (bar_chart_data != 'off') {
				bar_chart_data = JSON.parse(bar_chart_data);
				myBarChart(bar_chart_data, '#barChart');
			}

			if (barchart_values_accidents_summary_of_months != 'off') {
				barchart_values_accidents_summary_of_months = JSON.parse(barchart_values_accidents_summary_of_months);
				myBarChart(barchart_values_accidents_summary_of_months, '#bar_chart_accidents_summary_of_months');
			}

			if (barchart_values_forget_keys != 'off') {
				barchart_values_forget_keys = JSON.parse(barchart_values_forget_keys);
				myBarChart(barchart_values_forget_keys, '#barchart_values_forget_keys_count_each_people_types');
			}

			var reports_evaluations_dispaly = '<?php echo $reports_evaluations_dispaly;?>';
			if (reports_evaluations_dispaly == 'on') {
				var piechart_values_between_ages = '<?php echo $piechart_values_between_ages;?>';
				var barchart_values_status = '<?php echo $barchart_values_status;?>';
				var barchart_values_performance = '<?php echo $barchart_values_performance;?>';
				var barchart_values_success = '<?php echo $barchart_values_success;?>';
				var barchart_values_timeline = '<?php echo $barchart_values_timeline;?>';
				var barchart_values_service_clear = '<?php echo $barchart_values_service_clear;?>';
				var barchart_values_materials = '<?php echo $barchart_values_materials;?>';
				var barchart_values_servicemind = '<?php echo $barchart_values_servicemind;?>';
				var barchart_values_communication = '<?php echo $barchart_values_communication;?>';
				var barchart_values_knowlage = '<?php echo $barchart_values_knowlage;?>';
				var barchart_values_questions = '<?php echo $barchart_values_questions;?>';
				var barchart_values_followup = '<?php echo $barchart_values_followup;?>';

				// piechart_values_between_ages = JSON.parse(piechart_values_between_ages);

				// console.log(JSON.parse(barchart_values_success));
				myPieChart(JSON.parse(piechart_values_between_ages), '#pieChartEvaluations');
				myBarChart(JSON.parse(barchart_values_status), '#barChart');
				myBarChart(JSON.parse(barchart_values_performance), '#bar_chart_performance');
				myBarChart(JSON.parse(barchart_values_success), '#bar_chart_success');
				myBarChart(JSON.parse(barchart_values_timeline), '#bar_chart_timeline');
				myBarChart(JSON.parse(barchart_values_service_clear), '#bar_chart_service_clear');
				myBarChart(JSON.parse(barchart_values_materials), '#bar_chart_materials');
				myBarChart(JSON.parse(barchart_values_servicemind), '#bar_chart_servicemind');
				myBarChart(JSON.parse(barchart_values_communication), '#bar_chart_communication');
				myBarChart(JSON.parse(barchart_values_knowlage), '#bar_chart_knowlage');
				myBarChart(JSON.parse(barchart_values_questions), '#bar_chart_questions');
				myBarChart(JSON.parse(barchart_values_followup), '#bar_chart_followup');
			}
			$('#myTable2').DataTable();
			$('.mydataTable2').DataTable();
			// $('#sec_home_datatable').DataTable();
			// $('.mydataTable tfoot th').each(function () {
			// 	var title = $(this).text();
			// 	$(this).append('<br /><input type="text" class="form-control" placeholder="ค้นหา... ' + title + '" />');
			// });

			// $('.mydataTable').DataTable({
			// 	"language": {
			// 		"emptyTable": "ไม่พบรายการ",
			// 		"lengthMenu": "แสดง _MENU_ จำนวน",
			// 		"info": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ จำนวน",
			// 		"infoEmpty": "รายการ 0 ถึง 0 จาก 0 รายการ",
			// 		"thousands": ",",
			// 		"loadingRecords": "กำลังโหลดข้อมูล...",
			// 		"processing": "กำลังดำเนินการ...",
			// 		"search": "ค้นหา:",
			// 		"zeroRecords": "ไม่พบรายการ",
			// 		"paginate": {
			// 			"first": "หน้าแรก",
			// 			"last": "สุดท้าย",
			// 			"next": "ต่อไป",
			// 			"previous": "ย้อนกลับ"
			// 		},
					
			// 	}
			// })
			// .columns().every(function () {
			// 	var that = this;

			// 	$('input', this.footer()).on('keyup change', function () {
			// 		if (that.search() !== this.value) {
			// 			that
			// 				.search(this.value)
			// 				.draw();
			// 		}
			// 	});
			// });

			$(".form_submit_data").submit(function () {
				if (confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่ ?') == true) {
					return true;
				}
				return false;
			});

			//Flat red color scheme for iCheck
			$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
				checkboxClass: 'icheckbox_flat-blue',
				radioClass: 'iradio_flat-blue'
			});

			//Date picker
			$('.datepicker').datepicker({
				autoclose: true
			});

			// Input mask
			$('[data-mask]').inputmask();

			// Initialize Select2 Elements
			$('.select2').select2();

			// active side menu
			var controller_link = '<?php echo $this->uri->segment(1);?>';

			$('li#' + controller_link).addClass('active');

			if (controller_link.search('report') != -1) {
				$('#reports').addClass('active');
			} else if (controller_link.search('users') != -1) {
				$('#setting').addClass('active');
			}

		});

		function removeItem(id, url, flag = '') {
			console.log(id);
			console.log(url);
			console.log('remove url => ' + url + '/' + id);
			if (confirm('คุณต้องการลบข้อมูลใช่หรือไม่ ?') == true) {
				window.location.href = url + '/' + id + '/' + flag;
			}
		}

		function removeItem_break_mc_pad(id, url, flag = '') {
			console.log(id);
			console.log(url);
			console.log('remove url => ' + url + '/' + id);
			if (confirm('คุณต้องการลบข้อมูลใช่หรือไม่ ?') == true) {
				window.location.href = url + '/' + id + '/' + flag;
			}
		}

	</script>


	<script>
		function openInfo(id){
			$('#'+id).toggle();
		}

		$('#chk_keeper').change(function(){
				$('#keeper_no_as_security').val("")
				$('#keeper_no_as_security').toggle()
				$('#vehicles_forget_key_security_id').val("").change();
		})

		
	</script>

	<script>
	var table = $('#example').DataTable();
	function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.extn+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}

	$('#example tbody').on('click', '.btn-info', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 console.log(row)
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
	</script>
</body>

</html>
