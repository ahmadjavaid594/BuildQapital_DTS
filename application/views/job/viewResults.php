
<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="<?=(empty($validation_error) ? 'active' : '') ?>">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Results</a>
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
								<th>Applied On</th>
								
								<th>Marks Obtained</th>
                                <th>Total Marks</th>
                                <th>Test Status</th>
                                <th>Test Remarks</th>

								
							</tr>
						</thead>
						<tbody>
							<?php 
								$count = 1;
								foreach($jobs as $job):
											
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $job['unique_id'];?></td>	
								<td><?php echo $job['organization'];?></td>	
								<td><?php echo $job['designation'];?></td>			
								<td><?php echo $job['application_date'];?></td>
								<td><?php echo $job['marks_obtained'];?></td>			
								<td><?php echo $job['total_marks'];?></td>
							    <td><?php echo $job['test_status'];?></td>
                                <td><?php echo $job['test_remarks'];?></td>	
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