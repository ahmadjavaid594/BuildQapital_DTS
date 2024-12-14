<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <style>
       
        .container {
            max-width: 1200px;
            margin: auto;
        }

        header h1 {
            font-size: 32px;
            font-weight: 600;
            color: #343a40;
        }

        .filters-container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .filters-container label {
            font-weight: 500;
        }

        .job-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .job-card-header {
            font-size: 20px;
            font-weight: 600;
            color: #007bff;
        }

        .job-card-body p {
            font-size: 14px;
            color: #555;
        }

        .apply-btn, .view-btn, .download-btn {
            font-size: 14px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .apply-btn:hover, .view-btn:hover, .download-btn:hover {
            background-color: #218838;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <!-- Filters Section -->
        <div class="row">
            <div class="col-md-11">
            <div class="filters-container">
            <h5>Filters</h5>
            <form action="<?= base_url('/job/viewJobs') ?>" method="get" class="row">
                <div class="form-group col-md-4">
                    <label for="organization">Organization</label>
                    <select class="form-control" name="organization" id="organization">
                        <option value="">Select Organization</option>
                        <?php foreach ($organizations as $organization): ?>
                            <option value="<?= htmlspecialchars($organization['id']) ?>" <?= ($organization['id'] == $organization_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($organization['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="qouta">Quota</label>
                    <select class="form-control" name="qouta" id="qouta">
                        <option value="">Select Quota</option>
                        <?php foreach ($qoutas as $qouta): ?>
                            <option value="<?= htmlspecialchars($qouta['id']) ?>" <?= ($qouta['id'] == $qouta_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($qouta['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="designation">Designation</label>
                    <select class="form-control" name="designation" id="designation">
                        <option value="">Select Designation</option>
                        <?php foreach ($designation as $des): ?>
                            <option value="<?= htmlspecialchars($des['id']) ?>" <?= ($des['id'] == $designation_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($des['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="job-type">Job Type</label>
                    <select class="form-control" name="job_type" id="job-type">
                        <option value="">Select Job Type</option>
                        <?php foreach ($job_type as $type): ?>
                            <option value="<?= htmlspecialchars($type['id']) ?>" <?= ($type['id'] == $job_type_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="location">Location</label>
                    <select class="form-control" name="location" id="location">
                        <option value="">Select Location</option>
                        <?php foreach ($locations as $location): ?>
                            <option value="<?= htmlspecialchars($location['id']) ?>" <?= ($location['id'] == $location_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($location['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="qualification">Qualification</label>
                    <select class="form-control" name="qualification" id="qualification">
                        <option value="">Select Qualification</option>
                        <?php foreach ($qualifications as $qualification): ?>
                            <option value="<?= htmlspecialchars($qualification['id']) ?>" <?= ($qualification['id'] == $qualification_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($qualification['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="status">Status</label>
                    <div id="status" class="d-flex align-items-center">
                        <div class="form-check mr-4">
                            <input 
                                type="radio" 
                                class="form-check-input" 
                                name="status" 
                                id="status_active" 
                                value="active" 
                                <?= (isset($status) && $status == 'active') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_active">Active</label>
                        </div>
                        <div class="form-check mr-4">
                            <input 
                                type="radio" 
                                class="form-check-input" 
                                name="status" 
                                id="status_inactive" 
                                value="inactive" 
                                <?= (isset($status) && $status == 'inactive') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="status_inactive">Inactive</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                </div>
                <div class="form-group col-md-6">
                    <a href="<?= base_url('/jobs') ?>" class="btn btn-secondary btn-block">Reset Filters</a>
                </div>
            </form>
        </div>
            </div>
        </div>
        

        <!-- Job Listings -->
        <div class="row">
            <?php if (isset($jobs) && is_array($jobs) && count($jobs) > 0): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="col-md-11">
                        <div class="job-card">
                            <div class="job-card-header">
                                <?= htmlspecialchars($job['organization']) ?> - <?= htmlspecialchars($job['designation']) ?>
                            </div>
                            <div class="job-card-body">
                                <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                                <p><strong>Job Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>
                                <p><strong>Age Limit:</strong> <?= htmlspecialchars($job['age_limit_start']) ?> - <?= htmlspecialchars($job['age_limit_end']) ?> years</p>
                                <p><strong>Application Deadline:</strong> <?= date("F j, Y", strtotime($job['job_end_date'])) ?></p>
                                <p><strong>Qualifications:</strong> <?= htmlspecialchars($job['qualifications']) ?></p>
                                <p><strong>Status:</strong> <?= htmlspecialchars($job['status']) ?></p>
                                <?php if(isset($job['job_status'])){ ?>  
                                      <p><strong class="alert-success">Application ID: <?= htmlspecialchars($job['unique_id']) ?></p></strong>
                                      <p><strong class="alert-success">Application Status: <?= htmlspecialchars($job['job_status']) ?></p></strong>
                                      <p><strong class="alert-success">Applied On: <?= date("F j, Y", strtotime($job['application_date'])) ?></p></strong>
                                      <?php if($job['status_id']=="9"){ ?> 
                                            <p class="alert-danger"><strong>You are required to submit the application fee (Rs. <?= htmlspecialchars($job['challan_amount']) ?>) through bank transfer to Faysal Bank Account Title: Domestic testing services Pvt Ltd, IBAN: PK61FAYS3459301000003492. Once done you need to upload paid fee pic in Paid Challans Menu (<strong>Against Application ID:</strong> <?= htmlspecialchars($job['unique_id']) ?>) to confirm you application submission </strong></p>
                                       <?php } ?>
                                        <?php if($job['status_id']=="16"){ ?> 
                                            <p class="alert-success"><strong>Challan updated verification is in process you will be notified soon</strong></p>
                                       <?php } ?>
                               <?php } ?> 
                                <div class="d-flex justify-content-end mt-6">
                                    <?php if($job['status']=="Active" && $job['job_end_date'] >= date("Y-m-d"))  { ?>
                                        <?php echo form_open($this->uri->uri_string()); ?>
					
                                        <a href="<?= base_url('job/viewDetail/' . htmlspecialchars($job['id'])) ?>" class="btn btn-primary btn-sm view-btn mr-2">View Job</a>
                                    <?php if (!empty($job['job_file_path'])): ?>
                                        <a href="<?= base_url($job['job_file_path']) ?>" class="btn btn-warning btn-sm download-btn mr-2" target="_blank">Download Advertisement</a>
                                    <?php endif; ?>
                                         <input type ="hidden" value="<?php echo $job['id']; ?>" name ="job_id" />
                                         <input type ="hidden" value="<?php echo $job['identifier']; ?>" name ="job_identifier" />
                                        <?php if(!isset($job['job_status'])){ ?>    
                                            <button type="submit" class="btn btn-success  download-btn mr-3" name="submit" value="Apply">
                                                Apply Now
                                            </button>
                                        <?php } ?>  
			                            	<?php echo form_close();?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No jobs found for your search criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
