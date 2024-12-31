
<!--<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-md-12 card service-card" style="padding:10px; text-align:center; margin:auto;">
                    <h3 style="margin-top:5px; margin-bottom:5px; color:Red; padding:10px;">
                        To make payment, you can deposit the fee to the following bank accounts or use JazzCash.
                    </h3>

                  
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">Faysal Bank</h3>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Title:</strong> Domestic Testing Services Pvt Ltd</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Number:</strong> PK61FAYS3459301000003492</p>
                    </div>
                    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">JazzCash</h3>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Title:</strong> Domestic Testing Services Pvt Ltd</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">Account Number:</strong> 141331124</p>
                        <p style="margin: 5px 0; color: #555;"><strong style="color: #000;">IBAN:</strong> PK21JCMA0000000141331124</p>
                    </div>

                    
                    
                </div>
            </div>
        </div>
    </div>
</div>!-->
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Challans List</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
				<div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Application Id</th>
								<th>Organization</th>
								<th>Designation</th>
								<th>Qouta</th>
								<th>Job type</th>
								<th>Applied On</th>
								<th>Challan Amount</th>
								<th>Payment Date</th>
								<th>Paid Amount</th>
								<th>Bank</th>
								<th>Transaction Id</th>	
								<th>Status</th>	
								<th>Remarks</th>	
								<th>Payment Mode</th>
								<th>Pay Challan</th>
								<th>View Receipt</th>
								<th>Recheck Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								//$qualifications = $this->db->get('qualification')->result();
								foreach($jobs as $job):
											
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $job['unique_id'];?></td>	
								<td><?php echo $job['organization'];?></td>	
								<td><?php echo $job['designation'];?></td>			
								<td><?php echo $job['qouta'];?></td>		
								<td><?php echo $job['job_type'];?>
							    </td><td><?php echo $job['application_date'];?></td>
							    <td><?php echo $job['challan_amount'];?></td>
								<td><?php echo $job['payment_date'];?></td>
								<td><?php echo $job['amount'];?></td>
								<td><?php echo $job['bank_name'];?></td>
								<td><?php echo $job['transaction_id'];?></td>
								<td><?php echo $job['job_status'];?></td>
                                <td><?php echo $job['remarks'];?></td>
								<td><?php echo $job['payment_mode'];?></td>
														
								<td class="min-w-c">
									<!--update link-->
									<?php  
									   if(($job['status_id'] == 9 || $job['status_id'] == 16) && ($job['status']=="Active" && $job['job_end_date'] >= date("Y-m-d") && $job['payment_mode'] =="" )  )
									   {

									?>  
									<a href="<?=base_url('job/paymentModeSelection/'.$job['unique_id'])?>" class="btn btn-default btn-circle icon">
										Pay Now   <i class="fas fa-credit-card"></i>
									</a>
								<?php  }
								?>
								</td>
								
								<td>
								<?php  if ( $job['status_id'] == 16 || $job['payment_mode'] == 'OTC' ) { ?>
									<a href="<?=base_url('job/viewReceipt/'.$job['unique_id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-eye"></i>
									</a>
								<?php }
								?>
								</td>
								<td>
									<!--update link-->
									<?php  
									   if(($job['transaction_id'] )  )
									   {

									?>  
									<a href="<?=base_url('job/checkPaymentStatusUser/'.$job['transaction_id'])?>" class="btn btn-warning">
										Recheck Payment Status
									</a>
								<?php  }
								?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		
		</div>
	</div>
	
</section>

<script>
    function validateFileSize(input) {
        const file = input.files[0];
        if (file && file.size > 1048576) { // 1 MB in bytes
            alert("File size must be less than 1 MB.");
            input.value = ""; // Clear the input
        }
    }
</script>