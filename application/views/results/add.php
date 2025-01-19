<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?= (empty($validation_error) ? 'active' : '') ?>">
                <a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Test Results List</a>
            </li>
            <li class="<?= (!empty($validation_error) ? 'active' : '') ?>">
                <a href="#upload" data-toggle="tab"><i class="fas fa-upload"></i> Upload Test Results</a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- List of Test Results -->
            <div id="list" class="tab-pane <?= (empty($validation_error) ? 'active' : '') ?>">
                <div class="mb-md">
                    <table class="table table-bordered table-hover table-condensed mb-none table-export">
                        <thead>
                            <tr>
                                <th width="50"><?= translate('sl') ?></th>
                                <th>Job Name</th>
                                <th>CNIC</th>
                                <th>Roll Number</th>
                                <th>Marks Obtained</th>
                                <th>Total Marks</th>
                                <th>Status</th>
                                <th>Remarks</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $test_results = $this->db->query("SELECT r.*, o.name as org, d.name as desig  FROM test_result_records r JOIN job j ON r.job_id = j.id inner join organization o on j.organization_id =  o.id  inner join designation d on j.designation_id = d.id")->result();
                            foreach ($test_results as $result):
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $result->desig.' - '.$result->org ?></td>
                                <td><?= $result->cnic ?></td>
                                <td><?= $result->roll_no ?></td>
                                <td><?= $result->marks_obtained ?></td>
                                <td><?= $result->total_marks ?></td>
                                <td><?= $result->status ?></td>
                                <td><?= $result->remarks ?></td>
                                <td class="min-w-c">

                                    <!-- Delete link -->
                                    <?php echo btn_delete('results/delete/' . $result->id); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Upload Results Tab -->
            <div class="tab-pane <?= (!empty($validation_error) ? 'active' : '') ?>" id="upload">
                <?php echo form_open_multipart('results/upload', array('class' => 'form-horizontal form-bordered validate')); ?>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Select Job <span class="required">*</span></label>
                        <div class="col-md-6">
                    <?php
    $options = ['' => 'Select Job']; // Default option
    foreach ($jobs as $job) {
        $options[$job['id']] = $job['designation'];
    }
    
    echo form_dropdown(
        "job_id", 
        $options, 
        set_value('job_id'), 
        "class='form-control' required='' id='job_id'
        data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'"
    );
?>
                        <span class="error"><?=form_error('job_id')?></span>
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Upload Excel File <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="csv_file" accept=".csv"  required />
                            <span class="error"><?= form_error('excel_file') ?></span>
                        </div>
                    </div>
                    <footer class="panel-footer mt-lg">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-default btn-block" name="submit" value="upload">
                                    <i class="fas fa-upload"></i> <?= translate('upload') ?>
                                </button>
                            </div>
                        </div>
                    </footer>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
