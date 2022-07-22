<!DOCTYPE html>
<html>
<head>
	<title>Spare Table</title>
	<link rel="icon" href="<?=base_url()?>assets/elevation logo.PNG" type="image/gif" sizes="32x32">
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url().'assets/css/datatables.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
	  <div class="row justify-content-md-center">
	    <div class="col col-lg-12">
	    	<h3>Report Table</h3>
	    	<?php echo $this->session->flashdata('msg');?>
			<a href="http://crm.elevationworld.co.ke/admin/" class="btn btn-primary mb-2">Dashboard </a>&nbsp; 
	    	<a href="<?php echo site_url('product/add_new');?>" class="btn btn-success mb-2 ">Add New Spare</a><hr/>
			<a href ="<?php echo site_url('product/generate_pdf/');?>"class = "btn btn-sm btn-info"> Download PDF Report</a> <hr/>
	      	<table class="table table-striped" id="mytable" style="font-size: 18;">
	      		<thead>
	      			<tr>
	      				<th>No</th>
						<th>Date of Replacement</th>
	      				<th>Technician Name</th>
						<th>Number of Spare Parts</th>
	      				<th>Category of Spare</th>
	      				<th>Sub Category of Spare</th>
	      				<th>House Address</th>
						<th>Damage Description</th>
	      				<th>Action</th>
						<th>Download </th>
	      			</tr>
	      		</thead>
	      		<tbody>
				  
	      			<?php
	      				$no = 0;
	      				foreach ($spares->result() as $row):
	      					$no++;
	      			?>
	      			<tr>
					  <td><?php echo $no;?></td>
					  <td><?php echo $row->spare_date;?></td>
					  <td><?php echo $row->spare_name_of_technician;?></td>
					  <td><?php echo $row->spare_number;?></td>
					  <td><?php echo $row->category_name;?></td>
					  <td><?php echo $row->subcategory_name;?></td>
					  <td><?php echo $row->spare_house;?></td>
					  <td><?php echo $row->spare_damage_description;?></td>
					  <td>
	      					<a href="<?php echo site_url('product/get_edit/'.$row->spare_id);?>" class="btn btn-sm btn-primary">Edit</a>
	      					<a href="<?php echo site_url('product/delete/'.$row->spare_id);?>" class="btn btn-sm btn-danger">Delete</a>
	      			  </td>
					  <td><a href ="<?php echo site_url('product/generate_pdf/'.$row->spare_id);?>"class = "btn btn-sm btn-info"> Download</a> </td>
	      			</tr>
	      			<?php endforeach;?>
	      		</tbody>
	      	</table>


	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/datatables.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#mytable').DataTable();
		});
	</script>
</body>
</html>