<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }

        .container {
            max-width: 1100px;
        }

        .card {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .card-title {
            font-size: 28px;
            font-weight: 600;
            color: #007bff;
        }

        .card-text {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

        .btn {
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #6c757d;
        }

        iframe {
            border: none;
            border-radius: 8px;
        }

        .back-btn {
            margin-top: 20px;
            font-weight: 500;
        }

        .details-section {
            margin-bottom: 20px;
        }

        .details-section strong {
            color: #007bff;
        }

        .job-description {
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .mt-4, .mt-3 {
            margin-top: 1.5rem !important;
        }

    </style>
</head>
<body>

<div class="container my-5">
    <br><br>
    <h1 class="mb-4 text-center"><?= htmlspecialchars($job['designation']) ?></h1>

    <div class="card">
        <div class="card-body">
            <!-- Job Information -->
            <div class="details-section">
                <h5 class="card-title"><?= htmlspecialchars($job['organization']) ?></h5>
                <p class="card-text"><strong>Industry:</strong> <?= htmlspecialchars($job['industry']) ?></p>
                <p class="card-text"><strong>Quota:</strong> <?= htmlspecialchars($job['qouta']) ?></p>
                <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                <p class="card-text"><strong>Job Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>
                <p class="card-text"><strong>Description:</strong> <?= nl2br(htmlspecialchars($job['description'])) ?></p>
                <!--<p class="card-text"><strong>Number of Positions:</strong> <?= htmlspecialchars($job['no_of_positions']) ?></p>!-->
                <p class="card-text"><strong>Age Limit:</strong> <?= htmlspecialchars($job['age_limit_start']) ?> - <?= htmlspecialchars($job['age_limit_end']) ?> years</p>
                <p class="card-text"><strong>Job Start Date:</strong> <?= date("F j, Y", strtotime($job['job_start_date'])) ?></p>
                <p class="card-text"><strong>Application Deadline:</strong> <?= date("F j, Y", strtotime($job['job_end_date'])) ?></p>
                <p class="card-text"><strong>Qualifications Required:</strong> <?= htmlspecialchars($job['qualifications']) ?></p>
                <p class="card-text"><strong>Status:</strong> <?= ($job['is_active'] == 1) ? 'Active' : 'Inactive' ?></p>
            </div>

            <!-- Apply Button -->
            <div class="d-flex justify-content-between mt-3">
                <?php if($job['status']=="Active" && $job['job_end_date'] >= date("Y-m-d"))  { ?>
                <a href="<?= base_url('register') ?>" class="btn btn-success">Apply Now</a>
                <?php } ?>   

            </div>

            <!-- Advertisement File Display/Download Section -->
            <?php if (!empty($job['job_file_path'])): ?>
                <div class="mt-4">
                    <h5>Advertisement:</h5>
                    <?php 
                        $file_extension = pathinfo($job['job_file_path'], PATHINFO_EXTENSION);
                        if (strtolower($file_extension) === 'pdf'): 
                    ?>
                        <!-- Embed PDF File -->
                        <iframe src="<?= base_url($job['job_file_path']) ?>" width="100%" height="500px"></iframe>
                    <?php else: ?>
                        <!-- Download Link for Non-PDF Files -->
                        <a href="<?= base_url($job['job_file_path']) ?>" class="btn btn-outline-secondary" download>Download Advertisement</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Back to Job Listings Button -->
            <div class="back-btn mt-3">
                <a href="<?= base_url('jobs') ?>" class="btn btn-primary">Back to Job Listings</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
