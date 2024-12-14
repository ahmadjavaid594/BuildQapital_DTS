<section class="panel">
    <style>
        .tabs-custom .nav-tabs {
            border-bottom: 2px solid #ddd;
        }
        .tabs-custom .nav-tabs li a {
            color: #333;
            font-weight: bold;
            padding: 10px 15px;
        }
        .tabs-custom .nav-tabs .active a {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card .card-body {
            padding: 15px;
        }
        .mb-md {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .col-md-4 {
            flex: 0 0 calc(33.333% - 1rem);
            box-sizing: border-box;
        }
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 calc(50% - 1rem);
            }
        }
        @media (max-width: 576px) {
            .col-md-4 {
                flex: 0 0 100%;
            }
        }
    </style>

    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?= empty($validation_error) ? 'active' : '' ?>">
                <a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Test Syllabus</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="list" class="tab-pane <?= empty($validation_error) ? 'active' : '' ?>">
                <div class="mb-md">
                    <?php foreach ($syllabuses as $record): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <?php if (!empty($record['syllabus_file_path'])): ?>
                                    <a class="card-img-top" href="<?= base_url($record['syllabus_file_path']); ?>" target="_blank"> <img src="<?= base_url($record['syllabus_file_path']); ?>"  alt="Syllabus File"></a>
                                <?php else: ?>
                                    <img src="default-placeholder.png"  alt="No Image Available">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($record['designation'] ?? 'No Designation'); ?></h5>
                                    <p class="card-text">
                                        <?= htmlspecialchars($record['organization'] ?? 'No Organization'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
