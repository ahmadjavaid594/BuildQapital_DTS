<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <style>
        /* General Reset */
        body, h1, h2, h3, p, table, th, td {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #f3f4f7;
            color: #2e3b4e;
            font-size: 16px;
            line-height: 1.6;
            padding: 0 15px;
        }
        h2 {
            text-align: center;
            font-size: 2.2rem;
            color: #34495e;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Card Styles */
        .card {
            background-color: #ffffff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 40px;
            padding: 25px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }
        .card h3 {
            font-size: 1.8rem;
            color: #2980b9;
            margin-bottom: 20px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f7f9fc;
            color: #2980b9;
            font-weight: 600;
            text-transform: uppercase;
        }
        td {
            background-color: #fafbfc;
            border-bottom: 1px solid #ecf0f1;
        }
        /* New Layout for Images */
        td img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 0 auto;
            display: block;
        }
        td img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        /* Section Styles */
        .info-section {
            margin-bottom: 40px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .container {
                padding: 20px;
            }
            .card {
                padding: 20px;
            }
            .card h3 {
                font-size: 1.6rem;
            }
            table th, table td {
                padding: 10px;
            }
            td img {
                width: 150px;
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Job Application Details</h2>

        <!-- Personal Information -->
        <div class="info-section">
            <div class="card">
                <h3>Personal Information</h3>
                <table>
                    <tr>
                        <th>Name</th>
                        <td><?= $application['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Birthday</th>
                        <td><?= $application['birthday']; ?></td>
                    </tr>
                    <tr>
                        <th>Sex</th>
                        <td><?= ucfirst($application['sex']); ?></td>
                    </tr>
                    <tr>
                        <th>Religion</th>
                        <td><?= $application['religion']; ?></td>
                    </tr>
                    <tr>
                        <th>Blood Group</th>
                        <td><?= $application['blood_group']; ?></td>
                    </tr>
                    <tr>
                        <th>CNIC</th>
                        <td><?= $application['cnic']; ?></td>
                    </tr>
                    <tr>
                        <th>Mobile No</th>
                        <td><?= $application['mobileno']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $application['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Present Address</th>
                        <td><?= $application['present_address']; ?></td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td><?= $application['permanent_address']; ?></td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><img src="<?= base_url($application['photo']); ?>" alt="Profile Photo"></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Job Information -->
        <div class="info-section">
            <div class="card">
                <h3>Job Information</h3>
                <table>
                    <tr>
                        <th>Organization</th>
                        <td><?= $application['organization']; ?></td>
                    </tr>
                    <tr>
                        <th>Industry</th>
                        <td><?= $application['industry']; ?></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><?= $application['location']; ?></td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td><?= $application['designation']; ?></td>
                    </tr>
                    <tr>
                        <th>Job Type</th>
                        <td><?= ucfirst($application['job_type']); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?= $application['status']; ?></td>
                    </tr>
                    <tr>
                        <th>Job Status</th>
                        <td><?= $application['job_status']; ?></td>
                    </tr>
                    <tr>
                        <th>Application Date</th>
                        <td><?= $application['application_date']; ?></td>
                    </tr>
                    <tr>
                        <th>Unique ID</th>
                        <td><?= $application['unique_id']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="info-section">
            <div class="card">
                <h3>Payment Information</h3>
                <table>
                    <tr>
                        <th>Amount</th>
                        <td><?= $application['amount'] ? 'Rs. ' . $application['amount'] : 'Not Paid'; ?></td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td><?= $application['payment_date'] ? 'Paid on ' . $application['payment_date'] : 'Fee Pending'; ?></td>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td><?= $application['transaction_id'] ?: 'Not Available'; ?></td>
                    </tr>
                    <tr>
                        <th>Bank Name</th>
                        <td><?= $application['bank_name'] ?: 'Not Provided'; ?></td>
                    </tr>
                    <tr>
                        <th>Document</th>
                        <td><a href="<?= base_url($application['image_path']); ?>" target="_blank"> <img src="<?= base_url($application['image_path']); ?>" alt="Challan Document"></a></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Educational Details -->
        <div class="info-section">
            <div class="card">
                <h3>Educational Details</h3>
                <?php if (!empty($education)): ?>
                    <?php foreach ($education as $edu): ?>
                        <div class="doc-header">Institution: <?= $edu['institution']; ?></div>
                        <table>
                            <tr>
                                <th>Degree</th>
                                <td><?= $edu['degree']; ?></td>
                            </tr>
                            <tr>
                                <th>Field of Study</th>
                                <td><?= $edu['field_of_study']; ?></td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td><?= $edu['start_date']; ?></td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td><?= $edu['end_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Grade</th>
                                <td><?= $edu['grade']; ?></td>
                            </tr>
                            <tr>
                                <th>Total Marks</th>
                                <td><?= $edu['total_marks']; ?></td>
                            </tr>
                            <tr>
                                <th>Obtained Marks</th>
                                <td><?= $edu['obtained_marks']; ?></td>
                            </tr>
                            <tr>
                                <th>Document</th>
                                <td><a href="<?= base_url($edu['image_path']); ?>" target="_blank"><img src="<?= base_url($edu['image_path']); ?>" alt="Educational Document"></a></td>
                            </tr>
                        </table>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No educational records available.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Experience Details -->
        <div class="info-section">
            <div class="card">
                <h3>Experience Details</h3>
                <?php if (!empty($experience)): ?>
                    <?php foreach ($experience as $exp): ?>
                        <div class="doc-header">Company: <?= $exp['company']; ?> | Job Title: <?= $exp['job_title']; ?></div>
                        <table>
                            <tr>
                                <th>Start Date</th>
                                <td><?= $exp['start_date']; ?></td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td><?= $exp['end_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Responsibilities</th>
                                <td><?= $exp['responsibilities']; ?></td>
                            </tr>
                            <tr>
                                <th>Document</th>
                                <td><a href="<?= base_url($exp['image_path']); ?>" target="_blank"><img src="<?= base_url($exp['image_path']); ?>" alt="Experience Document"></a></td>
                            </tr>
                        </table>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No experience records available.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Certification Details -->
        <div class="info-section">
            <div class="card">
                <h3>Certification Details</h3>
                <?php if (!empty($certifications)): ?>
                    <?php foreach ($certifications as $cert): ?>
                        <div class="doc-header">Certification Name: <?= $cert['certification_name']; ?></div>
                        <table>
                            <tr>
                                <th>Issued By</th>
                                <td><?= $cert['issued_by']; ?></td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <td><?= $cert['issue_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Expiration Date</th>
                                <td><?= $cert['expiration_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Credential ID</th>
                                <td><?= $cert['credential_id']; ?></td>
                            </tr>
                            <tr>
                                <th>Document</th>
                                <td><a href="<?= base_url($cert['image_path']); ?>" target="_blank"> <img src="<?= base_url($cert['image_path']); ?>"  alt="Certification Document"></a></td>
                            </tr>
                        </table>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No certification records available.</p>
                <?php endif; ?>
            </div>
        </div>
        <!---- document ---->
        <div class="info-section">
            <div class="card">
                <h3>Uploaded Documents</h3>
                <?php if (!empty($document)): ?>
                    <?php foreach ($document as $doc): ?>
                        <div class="doc-header">Document Name: <?= $doc['name']; ?></div>
                        <table>
                            <tr>
                                <th>Document</th>
                                <td><a href="<?= base_url($doc['image_path']); ?>" target="_blank"> <img src="<?= base_url($doc['image_path']); ?>"  alt="Document"></a></td>
                            </tr>
                        </table>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No Documents uploaded.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="info-section">
            <div class="card">
                <h3>Application Review</h3>
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                <div class="form-group mt-md">
    <input type="hidden" name="job_application_id" value="<?= $application['unique_id']; ?>" />
    <input type="hidden" name="name" value="<?= $application['name']; ?>" />
    <input type="hidden" name="job_position" value="<?= $application['designation']; ?>" />
    <input type="hidden" name="company_name" value="<?= $application['organization']; ?>" />
    <input type="hidden" name="application_status" value="<?= $application['job_status']; ?>" />
    <input type="hidden" name="email" value="<?= $application['email']; ?>" />
    
    <label class="col-md-3 control-label">Status <span class="required">*</span></label>
    <div class="col-md-6">
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
<input type="hidden" id="job_status_id" value="<?= $application['status_id']; ?>" />
<div class="form-group mt-md" id="test_schedule_group" style="display: none;">
    <label class="col-md-3 control-label">Test Schedule <span class="required">*</span></label>
    <div class="col-md-6">
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
    <div class="col-md-6">
        <input type="text" required="" class="form-control" name="remarks" value="<?= set_value('remarks') ?>" />
        <span class="error"><?= form_error('description') ?></span>
    </div>
</div>

					<footer class="panel-footer mt-lg">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" name="submit" value="update">
									<i class="fas fa-plus-circle"></i> <?=translate('update')?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close();?>
            </div>
        </div>

    </div>
</body>
</html>
<script>
$(document).ready(function () {
    // Trigger when the status dropdown value changes
    $('#status_id').on('change', function () {
        const selectedValue = $(this).val(); // Get the selected value of the status dropdown
       
        if (selectedValue === "12" && ($('#job_status_id').val()==16 || $('#job_status_id').val()==12)) {
            $('#test_schedule_group').show(); // Show the test schedule dropdown
        } else {
            $('#test_schedule_group').hide(); // Hide the test schedule dropdown
            
            // Reset values in the test schedule group
            $('#test_schedule_id').val('').trigger('change'); // Reset the dropdown
        }
    });

    // Initialize the visibility and reset values on page load
    if ($('#status_id').val() === "12") {
        $('#test_schedule_group').show();
    } else {
        $('#test_schedule_group').hide();
        $('#test_schedule_id').val('').trigger('change'); // Reset the dropdown
    }
});


</script>