<section class="panel">
    <div class="tabs-custom">
    <ul class="nav nav-tabs">
            <li class="<?=(empty($validation_error) ? 'active' : '') ?>">
                <a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Test Schedules List</a>
            </li>
            <li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
                <a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Test Schedule</a>
            </li>
        </ul>
      
        <div class="tab-content">
            <div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
                <div class="mb-md">
                    <table class="table table-bordered table-hover table-condensed mb-none table-export">
                        <thead>
                            <tr>
                                <th width="50"><?=translate('sl')?></th>
                                <th>Test Name</th>
                                <th>Test Center</th>
                                <th>Job</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Seats Available</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                foreach ($test_schedules as $schedule):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $schedule['name']; ?></td>
                                <td><?php echo $schedule['test_center_name']; ?></td>
                                <td><?php echo $schedule['job_title']; ?></td>
                                <td><?php echo $schedule['date']; ?></td>
                                <td><?php echo $schedule['start_time']; ?></td>
                                <td><?php echo $schedule['end_time']; ?></td>
                                <td><?php echo $schedule['seats_available']; ?></td>
                                <td><?php echo $schedule['status']; ?></td>
                                <td class="min-w-c">
                                    <!-- Update link -->
                                    <a href="<?=base_url('testSchedule/edit/'.$schedule['id'])?>" class="btn btn-default btn-circle icon">
                                        <i class="fas fa-pen-nib"></i>
                                    </a>
                                    <!-- Delete link -->
                                    <?php echo btn_delete('testSchedule/delete/'. $schedule['id']); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
              <div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                <div class="form-group">
                    <label class="col-md-3 control-label">Test Name<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="test_name" required="" value="<?=set_value('test_name')?>" placeholder="Enter test name" />
                        <span class="error"><?=form_error('test_name')?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Test Center<span class="required">*</span></label>
                    <div class="col-md-6">
                        <?php
                            $test_centers = $this->app_lib->getSelectList('test_centers');
                            echo form_dropdown("test_center_id", $test_centers, set_value('test_center_id'), "class='form-control' required='' id='test_center_id'
                            data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'");
                        ?>
                        <span class="error"><?=form_error('test_center_id')?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Job<span class="required">*</span></label>
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
                    <label class="col-md-3 control-label">Date<span class="required">*</span></label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                            <input type="text" class="form-control" name="test_date" required="" value="<?=set_value('date')?>" data-plugin-datepicker data-plugin-options='{ "todayHighlight" : true }' />
                        </div>
                        <span class="error"><?=form_error('date')?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Start Time<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="time" class="form-control" name="start_time" required="" value="<?=set_value('start_time')?>" />
                        <span class="error"><?=form_error('start_time')?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">End Time<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="time" class="form-control" name="end_time" required="" value="<?=set_value('end_time')?>" />
                        <span class="error"><?=form_error('end_time')?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Seats Available<span class="required">*</span></label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="seats_available" required="" value="<?=set_value('seats_available')?>" />
                        <span class="error"><?=form_error('seats_available')?></span>
                    </div>
                </div>
                
                <footer class="panel-footer mt-lg">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-3">
                            <button type="submit" class="btn btn-default btn-block" name="submit" value="save">
                                <i class="fas fa-plus-circle"></i> <?=translate('save')?>
                            </button>
                        </div>
                    </div>
                </footer>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</section>
