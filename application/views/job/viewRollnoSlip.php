
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Roll No Slips</a>
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
								<th>Payment Date</th>
								<th>Paid Amount</th>
								<th>Bank</th>
								<th>Transaction Id</th>	
								<th>Status</th>	
								<th>Test Center</th>
								<th>Test Date</th>
								<th>Start Time</th>
								<th>End Time</th>

								<th>Remarks</th>
								<th>Print Slip</th>
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
								<td><?php echo $job['payment_date'];?></td>
								<td><?php echo $job['amount'];?></td>
								<td><?php echo $job['bank_name'];?></td>
								<td><?php echo $job['transaction_id'];?></td>
								<td><?php echo $job['job_status'];?></td>
								<td><?php echo $job['center'];?></td>
								<td><?php echo $job['date'];?></td>
								<td><?php echo $job['start_time'];?></td>
								<td><?php echo $job['end_time'];?></td>
                                <td><?php echo $job['remarks'];?></td>								
								<td class="min-w-c">
									<!--update link-->
									<a href="<?=base_url('job/downloadRollNoSlip/'.$job['unique_id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-print"></i>
									</a>
									<!-- delete link -->
									<!--<?php echo btn_delete('job/delete_data1/' . $job['id']);?>!-->
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