<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>

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
        <h1>Results</h1>
        <p>Find your test result</p>
    </header>

    <div class="row">
       
        <!-- Job Listings -->
        <div class="col-md-12">
            <div class="row">
                <?php if (isset($results) && is_array($results) && count($results) > 0): ?>
                    <?php foreach ($results as $result): ?>
                        <div class="col-md-12">
                            <div class="job-card">
                                <div class="job-card-header">
                                <a href="<?= base_url('resultsList/' . htmlspecialchars($result['id'])) ?>">  <?= htmlspecialchars($result['organization']) ?> - <?= htmlspecialchars($result['designation']) ?> </a>
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
    </div>
</div>

</body>
</html>
