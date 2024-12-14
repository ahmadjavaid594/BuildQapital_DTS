<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 1200px;
        }

        header h1 {
            font-size: 32px;
            font-weight: 600;
            color: #343a40;
        }

        header p {
            font-size: 18px;
            color: #6c757d;
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

        .filters-container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .filters-container label {
            font-weight: 500;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }

        .pagination .page-item .page-link {
            border-radius: 50%;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #e9ecef;
            border-color: #e9ecef;
        }

        .pagination {
            justify-content: center;
        }

        .job-card-body p strong {
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <header class="text-center mb-5">
        <br><br>
        <h1>Job Search</h1>
        <p>Find your next career opportunity</p>
    </header>

    <div class="row">
        <!-- Sidebar for Filters -->
        <div class="col-md-3">
            <div class="filters-container">
                <h5>Filters</h5>
                <form action="<?= base_url('/jobs') ?>" method="get">
                    <!-- Organization Filter -->
                    <div class="form-group">
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

                    <!-- Quota Filter -->
                    <div class="form-group">
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

                    <!-- Designation Filter -->
                    <div class="form-group">
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

                    <!-- Job Type Filter -->
                    <div class="form-group">
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

                    <!-- Location Filter -->
                    <div class="form-group">
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

                    <!-- Qualification Filter -->
                    <div class="form-group">
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

                    <!-- Submit and Reset Buttons -->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block">Apply Filters</button>
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('/jobs') ?>" class="btn btn-secondary btn-block">Reset Filters</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="col-md-9">
            <div class="row">
                <?php if (isset($jobs) && is_array($jobs) && count($jobs) > 0): ?>
                    <?php foreach ($jobs as $job): ?>
                        <div class="col-md-12">
                            <div class="job-card">
                                <div class="job-card-header">
                                    <?= htmlspecialchars($job['organization']) ?> - <?= htmlspecialchars($job['designation']) ?>
                                </div>
                                <div class="job-card-body">
                                    <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                                    <p><strong>Job Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>
                                    <!--<p><strong>Positions Available:</strong> <?= htmlspecialchars($job['no_of_positions']) ?></p>!-->
                                    <p><strong>Age Limit:</strong> <?= htmlspecialchars($job['age_limit_start']) ?> - <?= htmlspecialchars($job['age_limit_end']) ?> years</p>
                                    <p><strong>Application Deadline:</strong> <?= date("F j, Y", strtotime($job['job_end_date'])) ?></p>
                                    <p><strong>Qualifications:</strong> <?= htmlspecialchars($job['qualifications']) ?></p>
                                    <p><strong>Status:</strong> <?= htmlspecialchars($job['status']) ?></p>

                                    <div class="d-flex justify-content-end mt-4">
    <a href="<?= base_url('jobs/' . htmlspecialchars($job['id'])) ?>" class="btn btn-primary btn-sm view-btn mr-2" style="font-size: 16px; padding: 10px 20px;margin:2px; border-radius: 6px;">View Job</a>

    <?php if (!empty($job['job_file_path'])): ?>
        <a href="<?= base_url($job['job_file_path']) ?>" class="btn btn-warning btn-sm download-btn mr-2" target="_blank" style="font-size: 16px; padding: 10px 20px;margin:2px; border-radius: 6px; border-width: 2px;">Download Advertisement</a>
    <?php endif; ?>

    <a href="<?= base_url('register') ?>" class="btn btn-success btn-sm apply-btn" style="font-size: 16px; padding: 10px 20px; border-radius: 6px;">Apply Now</a>
    <!--<a href="https://forms.gle/wCM474brRzdUjiEz5" class="btn btn-success btn-sm apply-btn" style="font-size: 16px; padding: 10px 20px;margin:2px; border-radius: 6px;">Apply Now</a>!-->

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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?php if ($total_pages > 1): ?>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg">
                            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= base_url('/jobs?page=' . ($page - 1)) ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= base_url('/jobs?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= ($page == $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= base_url('/jobs?page=' . ($page + 1)) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
