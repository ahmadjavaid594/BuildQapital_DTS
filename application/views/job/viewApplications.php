<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?= empty($validation_error) ? 'active' : '' ?>">
                <a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Challans List</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="list" class="tab-pane <?= empty($validation_error) ? 'active' : '' ?>">
                <div class="mb-md">
                    <table class="table table-bordered table-hover table-condensed mb-none table-export">
                        <thead>
                            <tr>
                                <th width="50"><?= translate('sl') ?></th>
                                <th>Application Id</th>
                                <th>Organization</th>
                                <th>Designation</th>
                                <th>Quota</th>
                                <th>Job Type</th>
                                <th>Name</th>
                                <th>CNIC</th>
                                <th>Mobile No</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Applied On</th>
                                <th>Payment Date</th>
                                <th>Paid Amount</th>
                                <th>Bank</th>
                                <th>Transaction Id</th>
								<th>Challan Proof</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th>View Application Details</th>
								<th>Approve/Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                foreach ($jobs as $job): 
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $job['unique_id'] ?></td>
                                <td><?= $job['organization'] ?></td>
                                <td><?= $job['designation'] ?></td>
                                <td><?= $job['qouta'] ?></td>
                                <td><?= $job['job_type'] ?></td>
                                <td><?= $job['applicant_name'] ?></td>
                                <td><?= $job['cnic'] ?></td>
                                <td><?= $job['mobileno'] ?></td>
                                <td><?= $job['birthday'] ?></td>
                                <td><?= $job['sex'] ?></td>
                                <td><?= $job['email'] ?></td>
                                <td><?= $job['application_date'] ?></td>
                                <td><?= $job['payment_date'] ?></td>
                                <td><?= $job['amount'] ?></td>
                                <td><?= $job['bank_name'] ?></td>
                                <td><?= $job['transaction_id'] ?></td>
								 
                                <td>
									<?php 
									if($job['image_path'])
									{ ?>
										<a href="<?= base_url($job['image_path']); ?>" target="_blank"> View Challan Proof
                                	
									<?php } ?>
								</td>	
								<td><?= $job['job_status'] ?></td>
                                <td><?= $job['remarks'] ?></td>
								<td class="min-w-c">
								<a href="<?=base_url('job/viewApplicationDetail/'.$job['unique_id'])?>" class="btn btn-default btn-circle icon">
										<i class="fas fa-eye"></i>
									</a>
									
								</td>
                                <td class="min-w-c">
                                    <button 
                                        class="btn btn-default btn-circle icon open-modal-btn" 
                                        data-toggle="modal" 
                                        data-target="#applicationReviewModal" 
                                        data-unique-id="<?= $job['unique_id'] ?>" 
                                        data-name="<?= $job['applicant_name'] ?>" 
                                        data-designation="<?= $job['designation'] ?>" 
                                        data-organization="<?= $job['organization'] ?>" 
                                        data-job-status="<?= $job['job_status'] ?>" 
                                        data-email="<?= $job['email'] ?>">
                                        <i class="fa fa-check-circle"></i>
                                    </button>
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

<div id="applicationReviewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="applicationReviewModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationReviewModalLabel">Application Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                <input type="hidden" name="job_application_id" value="" />
                <input type="hidden" name="name" value="" />
                <input type="hidden" name="job_position" value="" />
                <input type="hidden" name="company_name" value="" />
                <input type="hidden" name="application_status" value="" />
                <input type="hidden" name="email" value="" />
                
                <div class="form-group mt-md">
                    <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                    <div class="col-md-9">
                        <?php
                            $qouta = $this->app_lib->getSelectList('status');
                            echo form_dropdown(
                                "status_id",
                                $qouta,
                                set_value('id'),
                                "class='form-control' required='' id='status_id'
                                data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'"
                            );
                        ?>
                        <span class="error"></span>
                    </div>
                </div>
                
                <div class="form-group mt-md" id="test_schedule_group">
                    <label class="col-md-3 control-label">Test Schedule</label>
                    <div class="col-md-9">
                        <?php
                            $schedule = $this->app_lib->getSelectList('test_schedule');
                            echo form_dropdown(
                                "test_schedule_id",
                                $schedule,
                                set_value('id'),
                                "class='form-control' id='test_schedule_id'
                                data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'"
                            );
                        ?>
                        <span class="error"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Remarks <span class="required">*</span></label>
                    <div class="col-md-9">
                        <input type="text" required="" class="form-control" name="remarks" value="" />
                        <span class="error"><?= form_error('description') ?></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit" value="updateShort">
                        <i class="fas fa-plus-circle"></i> <?=translate('update')?>
                    </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalElement = document.querySelector('#applicationReviewModal');
    const formFields = {
        jobApplicationId: document.querySelector('input[name="job_application_id"]'),
        name: document.querySelector('input[name="name"]'),
        jobPosition: document.querySelector('input[name="job_position"]'),
        companyName: document.querySelector('input[name="company_name"]'),
        applicationStatus: document.querySelector('input[name="application_status"]'),
        email: document.querySelector('input[name="email"]'),
    };

    // Function to set form values
    function setFormValues(button) {
        formFields.jobApplicationId.value = button.getAttribute('data-unique-id');
        formFields.name.value = button.getAttribute('data-name');
        formFields.jobPosition.value = button.getAttribute('data-designation');
        formFields.companyName.value = button.getAttribute('data-organization');
        formFields.applicationStatus.value = button.getAttribute('data-job-status');
        formFields.email.value = button.getAttribute('data-email');
    }

    // Event delegation to handle dynamic elements
    document.querySelector('table').addEventListener('click', function (event) {
        if (event.target.closest('.open-modal-btn')) {
            const button = event.target.closest('.open-modal-btn');
            setFormValues(button);

            // Ensure modal is active
            modalElement.removeAttribute('inert');
        }
    });

    // Add inert attribute when modal is closed
    modalElement.addEventListener('hidden.bs.modal', function () {
        modalElement.setAttribute('inert', '');
    });
	
});

</script>
