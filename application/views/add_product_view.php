<!DOCTYPE html>
<html>
<head>
	<title>Add New</title>
	<link rel="icon" href="<?=base_url()?>assets/elevation logo.PNG" type="image/gif" sizes="32x32">
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">

	  <div class="row justify-content-md-center">
	    <div class="col col-lg-6">
	    	<h3>Add New Spares Info:</h3>
	    	
	      	<form action="<?php echo site_url('product/save_product');?>" method="post">

			  <div class="form-group">
				    <label>Date of Replacement</label>
				    <input type="date" class="form-control" name="spare_date" placeholder="Date of Replacement" required>
				</div>

	      		<div class="form-group">
				    <label>	Technician Name</label>
				    <input type="text" class="form-control" name="spare_name_of_technician" placeholder="Technician Name" required>
				</div>

				<div class="form-group">
				    <label>Number of Spare Parts</label>
				    <input type="number" class="form-control" name="spare_number" placeholder="Number of Spare Parts" required>
				</div>

				<div class="form-group">
				    <label>Category of Spare</label>
				    <select class="form-control" name="category" id="category" required>
				    	<option value="">No Selected</option>
				    	<?php foreach($category as $row):?>
				    	<option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>

				<div class="form-group">
				    <label>Sub Category of Spare</label>
				    <select class="form-control" id="sub_category" name="sub_category" required>
				    	<option value="">No Selected</option>

				    </select>
				</div>
				

				<div class="form-group">
				    <label>	House Address</label>
				    <input type="text" class="form-control" name="spare_house" placeholder="House Address" required>
				</div>

				<div class="form-group">
				    <label>	Damage Description</label>
				    <input type="text" class="form-control" name="spare_damage_description" placeholder="Damage Description" required>
				</div>

				<button class="btn btn-success" type="submit">Save Data</button>
				<a href="<?php echo site_url('product/index/');?>" class="btn btn-primary">Back</a>

			</form>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#category').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('product/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].subcategory_id+'>'+data[i].subcategory_name+'</option>';
                        }
                        $('#sub_category').html(html);

                    }
                });
                return false;
            }); 
            
		});
	</script>
</body>
</html>