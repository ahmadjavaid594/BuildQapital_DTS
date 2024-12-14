<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li>
                <a href="<?=base_url('testSchedule')?>"><i class="fas fa-list-ul"></i> Test Schedule List</a>
            </li>
            <li class="active">
                <a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Update Test Schedule</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="edit">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo $data->id; ?>">
                    
                    <!-- Job Dropdown -->
                    <div class="form-group">
                    <div class="form-group">
                    <label class="col-md-3 control-label">Test Name<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="test_name" required="" value="<?=set_value('test_name',$data->name)?>" placeholder="Enter test name" />
                        <span class="error"><?=form_error('test_name')?></span>
                    </div>
                    </div>
                        <label class="col-md-3 control-label">Job <span class="required">*</span></label>
                        <div class="col-md-6">
                        <?php
    $options = ['' => 'Select Job']; // Default option
    foreach ($jobs as $job) {
        $options[$job['id']] = $job['designation'];
    }
    
    echo form_dropdown(
        "job_id", 
        $options, 
        set_value('job_id',$data->job_id), 
        "class='form-control' required='' id='job_id'
        data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'"
    );
?>
                            <span class="error"><?=form_error('job_id') ?></span>
                        </div>
                    </div>
                    
                    <!-- Test Center Dropdown -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Test Center <span class="required">*</span></label>
                        <div class="col-md-6">
                            <?php
                                $test_centers = $this->app_lib->getSelectList('test_centers');
                                echo form_dropdown("test_center_id", $test_centers, set_value('test_center_id', $data->test_center_id), "class='form-control' required='' id='test_center_id' data-plugin-selectTwo data-width='100%'");
                            ?>
                            <span class="error"><?=form_error('test_center_id') ?></span>
                        </div>
                    </div>

                    <!-- Test Date -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Test Date <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" name="test_date" value="<?=set_value('test_date', $data->date)?>" required data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                            <span class="error"><?=form_error('test_date') ?></span>
                        </div>
                    </div>

                    <!-- Start Time -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Start Time <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-clock"></i></span>
                                <input type="text" class="form-control" name="start_time" value="<?=set_value('start_time', $data->start_time)?>" required placeholder="HH:MM" />
                            </div>
                            <span class="error"><?=form_error('start_time') ?></span>
                        </div>
                    </div>

                    <!-- End Time -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">End Time <span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-clock"></i></span>
                                <input type="text" class="form-control" name="end_time" value="<?=set_value('end_time', $data->end_time)?>" required placeholder="HH:MM" />
                            </div>
                            <span class="error"><?=form_error('end_time') ?></span>
                        </div>
                    </div>

                    <!-- Total Seats -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Total Seats <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="seats_available" value="<?=set_value('total_seats', $data->seats_available)?>" required />
                            <span class="error"><?=form_error('seats_available') ?></span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-6">
                            <?php
                                $status_options = ['1' => 'Active', '0' => 'Inactive'];
                                echo form_dropdown("status", $status_options, set_value('status', $data->status), "class='form-control' required='' id='status' data-plugin-selectTwo data-width='100%'");
                            ?>
                            <span class="error"><?=form_error('status') ?></span>
                        </div>
                    </div>

                    <footer class="panel-footer mt-lg">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-default btn-block" name="submit" value="save">
                                    <i class="fas fa-plus-circle"></i> <?=translate('update')?>
                                </button>
                            </div>
                        </div>  
                    </footer>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
