<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('headdata') ?>
<title>Upload </title>
</head>
<body>
    
    <div class="container">
        <h2>Upload Excel file</h2>
        <br>
		
		 <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create-item"> Create Router</button> -->
		 <a href="<?php echo base_url().'hostname_view/importdata/'?>"><button class="btn btn-primary"> Upload Data</button></a>
        <br><br>
        
        <table class="table table-bordered table-striped" id="exercise1">
            <thead>
                <tr>
               
                    <th>#</th>
                    <th>Sap ID</th>
                    <th>HostName</th>
                    <th>LoopBack</th>
                    <th>MacAddress</th>
                    <th>Action</th>
                </tr>
            </thead>
			<?php  $i=1; $sap_count = [];?>
			<tbody><?php foreach($result as $value){ 
			
				$sap_id = $value['sap_id'];

				if (isset($sap_count[$sap_id])) {
						$sap_count[$sap_id]++;
				} else {
						$sap_count[$sap_id] = 1;
				}
				
				$host_name = $value['host_name'];

				if (isset($host_count[$host_name])) {
						$host_count[$host_name]++;
				} else {
						$host_count[$host_name] = 1;
				}
				$loopback = $value['loopback'];

				if (isset($loopback_count[$loopback])) {
						$loopback_count[$loopback]++;
				} else {
						$loopback_count[$loopback] = 1;
				}
				$mac_address = $value['mac_address'];

				if (isset($mac_count[$mac_address])) {
						$mac_count[$mac_address]++;
				} else {
						$mac_count[$mac_address] = 1;
				}
			}

foreach($result as $value) {
    if($sap_count[$value['sap_id']] > 1){
        $row_color = "#808080";
		$row_color_dup = "1";
    }else{
        $row_color = "#008000";  
		$row_color_dup = " ";		
    }
	if($host_count[$value['host_name']] > 1){
        $row_color_host = "#808080"; 
		$row_color_dup1 = "1";		
    }else{
        $row_color_host = "#008000";		
		$row_color_dup1 = "";			
    }
	if($loopback_count[$value['loopback']] > 1){
        $row_color_loop = "#808080"; 
		$row_color_dup2 = "1";			
    }else{
        $row_color_loop = "#008000";
		$row_color_dup2 = "";			
    }
	if($mac_count[$value['mac_address']] > 1){
        $row_color_mac = "#808080";  
		$row_color_dup3 = "1";		
    }else{
        $row_color_mac = "#008000"; 
		$row_color_dup3 = "";		
    }
	if($row_color_dup=='1' || $row_color_dup1=='1' || $row_color_dup2=='1' || $row_color_dup3=='1')
	{
		$row_color_entry="Duplicate Entry";
	}
	else{
		
		$row_color_entry="";
	}
   

			?>					
            <tr >  
            <td>
            <label><?php echo $i;?></label>   
			 </td>
			 <td style='color:<?php echo $row_color?>'><?php if(!empty($value['sap_id'])) { echo $value['sap_id'] ; } else { echo "Sap id is missing" ; } ?> </td>
			<td style='color:<?php echo $row_color_host?>'><?php if(!empty($value['host_name'])) { echo $value['host_name']; } else { echo "HostName id is missing" ; } ?></td>
			 
			 <td style='color:<?php echo $row_color_loop?>'><?php if(!empty($value['loopback'])) { echo $value['loopback'] ; } else { echo "Loopback id is missing" ; }?></td>
			 <td style='color:<?php echo $row_color_mac?>'><?php if(!empty($value['mac_address'])) { echo $value['mac_address'] ; } else { echo "Mac Address id is missing" ; } ?></td>
		     <td><?php if($value['status'] == 1){?>
			<!-- <a href="<?php echo base_url().'hostname_view/active/'.$value['id'];?>" class="btn btn-primary w-md m-b-5">Delete</a>
			 <?php }?>-->
			 <?php echo $row_color_entry ?>&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-info btn-xs btn-edit" data-id="<?= $value['id']?>" data-sap_id="<?= $value['sap_id']?>" data-host_name="<?= $value['host_name']?>"  data-loopback="<?=  $value['loopback']?>" data-mac_address="<?=  $value['mac_address']?>">Edit</a>
			 <a href="#" class="btn btn-danger btn-sm btn-delete" style="height:36px;" data-id="<?= $value['id'];?>">Delete</a></td>
			 </tr>
		     <?php $i++; } ?>
             </tbody>
			</table>
    </div>
    

    <!-- Modal Edit Router-->
    <form action="<?php echo base_url(); ?>hostname_view/submit" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Router</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                    <label>Sap Id</label>
                    <input type="text" class="form-control sap_id" name="sap_id" placeholder="Sap Id">
                </div>
                
                <div class="form-group">
                    <label>Host Name</label>
                    <input type="text" class="form-control host_name" name="host_name" placeholder="Host Name">
                </div>
				<div class="form-group">
                    <label>Loopback</label>
                    <input type="text" class="form-control loopback" name="loopback" placeholder="Loopback">
                </div>
				<div class="form-group">
                    <label>Mac Address</label>
                    <input type="text" class="form-control mac_address" name="mac_address" placeholder="Mac Address">
                </div>

            
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" class="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Edit Router-->
	
	    <!-- Modal Delete Router-->
    <form action="<?php echo base_url(); ?>hostname_view/active" method="post">
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete router</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
               <h4>Are you sure want to delete this router?</h4>
            
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" class="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Delete Router-->
	
<script >


$(document).ready(function(){

        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
			const id = $(this).data('id');
            const sap_id = $(this).data('sap_id');
            const host_name = $(this).data('host_name');
            const type = $(this).data('type');
            const loopback = $(this).data('loopback');
			const mac_address = $(this).data('mac_address');
			
            // Set data to Form Edit
            $('.id').val(id);
            $('.sap_id').val(sap_id);
            $('.host_name').val(host_name);
			$('.loopback').val(loopback);
			$('.mac_address').val(mac_address);
            // Call Modal Edit
            $('#editModal').modal('show');
        });
		$('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.id').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
       
    });
</script> 
</html>