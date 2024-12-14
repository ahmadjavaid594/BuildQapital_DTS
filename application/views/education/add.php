<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-md-12 card service-card" style="padding:10px; text-align:center; margin:auto;">
                    <h3 style="margin-top:5px; margin-bottom:5px; color:Red; padding:10px;">
                        Please enter academic education in the following order:
                    </h3>
                    <div style="background-color: #fff;text-align:left; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); width: 300px; margin: 10px; padding: 20px; display: inline-block; vertical-align: top;">
                        <p style="margin: 5px 0; color: #555;">1- SSC/ Matriculation / O-level</p>
                        <p style="margin: 5px 0; color: #555;">2- HSSC/ Intermediate/ A-level</p>
                        <p style="margin: 5px 0; color: #555;">3- Bachelor Degree (14 Years)</p>
                        <p style="margin: 5px 0; color: #555;">4- Bachelor Degree (16 Years)</p>
                        <p style="margin: 5px 0; color: #555;">5- Master Degree (16 Years)</p>
                        <p style="margin: 5px 0; color: #555;">6- Master/ MS/ M-Phil Degree (18 Years)</p>
                        <p style="margin: 5px 0; color: #555;">7- Doctor of Philosophy (Ph.D.)</p>
                    </div>
                    <!-- Add button -->
					<br>

                    <button class="btn btn-primary" onclick="focusAddEducation()">Add Education</button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="panel" >
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?=(empty($validation_error) ? 'active' : '') ?>">
                <a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> My Education</a>
            </li>
            <li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
                <a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Add Education</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
                <div class="mb-md">
                    <table class="table table-bordered table-hover table-condensed mb-none table-export">
                        <thead>
                            <tr>
                                <th width="50"><?=translate('sl')?></th>
                                <th>Institution</th>    
                                <th>Degree</th>
                                <th>Field</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Grade</th>
                                <th>Marks/GPA</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                foreach($educations as $education):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $education['institution'];?></td>            
                                <td><?php echo $education['degree'];?></td>
                                <td><?php echo $education['field_of_study'];?></td>
                                <td><?php echo $education['start_date'];?></td>
                                <td><?php echo $education['end_date'];?></td>
                                <td><?php echo $education['grade'];?></td>
                                <td><?php echo $education['obtained_marks'].'/'.$education['total_marks'];?></td>
                                <td class="min-w-c">
                                    <!--update link-->
                                    <a href="<?=base_url('education/edit/'.$education['id'])?>" class="btn btn-default btn-circle icon">
                                        <i class="fas fa-pen-nib"></i>
                                    </a>
                                    <!-- delete link -->
                                    <?php echo btn_delete('education/delete_data/' . $education['id']);?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Institution<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="institution" value="<?=set_value('institution')?>" />
                            <span class="error"><?=form_error('institution') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Degree <span class="required">*</span></label>
                        <div class="col-md-6 mb-md">
                        <?php
                            $qualifications = $this->app_lib->getSelectListName('qualification');
                            echo form_dropdown("degree", $qualifications, set_value('id'), "class='form-control' required='' id='qualification_id'
                            data-width='100%' data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
                        ?>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Field of Study<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="field_of_study" value="<?=set_value('field_of_study')?>" />
                            <span class="error"><?=form_error('field_of_study') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Start Date<span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" required="" name="start_date" value="<?=set_value('start_date', date('Y-m-d'))?>" data-plugin-datepicker
                                data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                        </div>
                        <span class="error"><?=form_error('start_date')?></span>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">End Date<span class="required">*</span></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                <input type="text" class="form-control" name="end_date" required="" value="<?=set_value('end_date', date('Y-m-d'))?>" data-plugin-datepicker
                                data-plugin-options='{ "todayHighlight" : true }' />
                            </div>
                        </div>
                        <span class="error"><?=form_error('end_date')?></span>
                    </div>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Total Marks/GPA<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="total_marks" value="<?=set_value('total_marks')?>" />
                            <span class="error"><?=form_error('total_marks') ?></span>
                        </div>
                    </div>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Obtained Marks/GPA<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="obtained_marks" value="<?=set_value('obtained_marks')?>" />
                            <span class="error"><?=form_error('obtained_marks') ?></span>
                        </div>
                    </div>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Grade/Division<span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="grade" value="<?=set_value('grade')?>" />
                            <span class="error"><?=form_error('grade') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Degree Image</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="image_path" onchange="validateFile(this)" />
                            <span class="error"><?=form_error('image_path') ?></span>
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
<script>
    function focusAddEducation() {
        // Switch to the "Add Education" tab
        document.querySelector('a[href="#create"]').click();

        // Scroll the page to the tab content
        document.querySelector('#create').scrollIntoView({ behavior: 'smooth' });
    }

    function validateFile(input) {
        const file = input.files[0];
        const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"]; // Allowed image types

        if (file) {
            // Check file size (1 MB = 1048576 bytes)
            if (file.size > 1048576) {
                alert("File size must be less than 1 MB.");
                input.value = ""; // Clear the input
                return;
            }
            
            // Check file type
            if (!allowedTypes.includes(file.type)) {
                alert("Only image files (JPEG, PNG, GIF, WebP) are allowed.");
                input.value = ""; // Clear the input
                return;
            }
        }
    }
</script>
