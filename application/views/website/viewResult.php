<br><br>

<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
           <h3><?= htmlspecialchars('   Result For The Post of '.$job['designation'].' In '.$job['organization']) ?></h3>
        </ul>
        
        <div class="tab-content">
            <div id="search" class="tab-pane active">
            
            <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Roll Number/Cnic <span class="required">*</span></label>
                        <div class="col-md-6">
                           <input type="hidden" class="form-control" name="job_id" value="<?= $job['id'] ?>" />
                          
                            <input type="text" class="form-control" name="roll_no" value="<?= set_value('roll_no') ?>" />
                            <span class="error"><?= form_error('roll_no') ?></span>
                        </div>
                    </div>
                    <footer class="panel-footer mt-lg">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-default btn-block" name="submit" value="search">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>  
                    </footer>
                <?php echo form_close();?>
       
                <?php if (isset($result) ): ?>

        <br>
        <div class="panel-body">
            <h4>Result Details</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Cnic</th>
                    <td><?= htmlspecialchars($result['cnic']) ?></td>
                </tr>
                
                <tr>
                    <th>Roll Number</th>
                    <td><?= htmlspecialchars($result['roll_no']) ?></td>
                </tr>
                <tr>
                    <th>Marks Obtained</th>
                    <td><?= htmlspecialchars($result['marks_obtained']) ?></td>
                </tr>
                <tr>
                    <th>Total Marks</th>
                    <td><?= htmlspecialchars($result['total_marks']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= htmlspecialchars($result['status']) ?></td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td><?= htmlspecialchars($result['remarks']) ?></td>
                </tr>
            </table>
        </div>
    <?php else: ?>
        <br>
        <div class="panel-body">
           
            <p class="text-danger">Please enter roll number or cnic to search</p>
        </div>
    <?php endif; ?>


            </div>
        </div>
    </div>
</section>
