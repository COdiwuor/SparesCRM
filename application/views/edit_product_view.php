<!DOCTYPE html>
<html>
<head>
	<title>Edit Product</title>
	<link rel="icon" href="<?=base_url()?>assets/elevation logo.PNG" type="image/gif" sizes="32x32">
	<link href="<?php echo base_url().'assets/css/bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">

	  <div class="row justify-content-md-center">
	    <div class="col col-lg-6">
	    	<h3>Edit Spares Info:</h3>
	    	
	      	<form action="<?php echo site_url('product/update_product');?>" method="post">

			  <div class="form-group">
				    <label>Date of Replacement</label>
				    <input type="date" class="form-control" name="spare_date" placeholder="Date of Replacement" required>
				</div>

	      		<div class="form-group">
				    <label>Technician Name</label>
				    <input type="text" class="form-control" name="spare_name_of_technician" placeholder="Technician Name" required>
				</div>

				<div class="form-group">
				    <label>Number of Spare Parts</label>
				    <input type="number" class="form-control" name="spare_number" placeholder="Number of Spare Parts" required>
				</div>

				<div class="form-group">
				    <label>Category of Spare</label>
				    <select class="form-control category" name="category" required>
				    	<option value="">No Selected</option>
				    	<?php foreach($category as $row):?>
				    	<option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
				    	<?php endforeach;?>
				    </select>
				</div>

				<div class="form-group">
				    <label>Sub Category of Spare</label>
				    <select class="form-control sub_category" name="sub_category" required>
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

				<input type="hidden" name="spare_id" value="<?php echo $spare_id?>" required>
				<button class="btn btn-success" type="submit">Update Data</button>
				<a href="<?php echo site_url('product/index/');?>" class="btn btn-primary">Back</a>

			</form>
	    </div>
	  </div>

	</div>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//call function get data edit
			get_data_edit();

			$('.category').change(function(){ 
                var id=$(this).val();
                var subcategory_id = "<?php echo $sub_category_id;?>";
                $.ajax({
                    url : "<?php echo site_url('product/get_sub_category');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){

                        $('select[name="sub_category"]').empty();

                        $.each(data, function(key, value) {
                            if(subcategory_id==value.subcategory_id){
                                $('select[name="sub_category"]').append('<option value="'+ value.subcategory_id +'" selected>'+ value.subcategory_name +'</option>').trigger('change');
                            }else{
                                $('select[name="sub_category"]').append('<option value="'+ value.subcategory_id +'">'+ value.subcategory_name +'</option>');
                            }
                        });

                    }
                });
                return false;
            }); 

			//load data for edit
            function get_data_edit(){
            	var spare_id = $('[name="spare_id"]').val();
            	$.ajax({
            		url : "<?php echo site_url('product/get_data_edit');?>",
                    method : "POST",
                    data :{spare_id :spare_id},
                    async : true,
                    dataType : 'json',
                    success : function(data){
                        $.each(data, function(i, item){
                            $('[name="spare_date"]').val(data[i].spare_date);
							$('[name="spare_name_of_technician"]').val(data[i].spare_name_of_technician);
							$('[name="spare_number"]').val(data[i].spare_number);
                            $('[name="category"]').val(data[i].spare_category_id).trigger('change');
                            $('[name="sub_category"]').val(data[i].spare_subcategory_id).trigger('change');
                            $('[name="spare_house"]').val(data[i].spare_house);
							$('[name="spare_damage_description"]').val(data[i].spare_damage_description);
                        });
                    }

            	});
            }
            
		});
	</script>
</body>
</html>