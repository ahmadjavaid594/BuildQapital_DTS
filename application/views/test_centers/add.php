<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?=(empty($validation_error) ? 'active' : '') ?>">
                <a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> Test Centers List</a>
            </li>
            <li class="<?=(!empty($validation_error) ? 'active' : '') ?>">
                <a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Create Test Center</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="list" class="tab-pane <?=(empty($validation_error) ? 'active' : '')?>">
                <div class="mb-md">
                    <table class="table table-bordered table-hover table-condensed mb-none table-export">
                        <thead>
                            <tr>
                                <th width="50"><?=translate('sl')?></th>
                                <th>Test Center Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Postal Code</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Capacity</th>
                                <th>Operating Hours</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                $test_centers = $this->db->get('test_centers')->result();
                                foreach($test_centers as $center):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $center->name; ?></td>
                                <td><?php echo $center->address; ?></td>
                                <td><?php echo $center->city; ?></td>
                                <td><?php echo $center->state; ?></td>
                                <td><?php echo $center->country; ?></td>
                                <td><?php echo $center->postal_code; ?></td>
                                <td><?php echo $center->contact_number; ?></td>
                                <td><?php echo $center->email; ?></td>
                                <td><?php echo $center->capacity; ?></td>
                                <td><?php echo $center->operating_hours; ?></td>
                                <td class="min-w-c">
                                    <!-- Update link -->
                                    <a href="<?=base_url('testCenters/edit/'.$center->id)?>" class="btn btn-default btn-circle icon">
                                        <i class="fas fa-pen-nib"></i>
                                    </a>
                                    <!-- Delete link -->
                                    <?php echo btn_delete('testCenters/delete_data/' . $center->id); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane <?=(!empty($validation_error) ? 'active' : '')?>" id="create">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Test Center Name <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="<?=set_value('name')?>" />
                            <span class="error"><?=form_error('name') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="address" value="<?=set_value('address')?>" />
                            <span class="error"><?=form_error('address') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">City <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="city" value="<?=set_value('city')?>" />
                            <span class="error"><?=form_error('city') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">State <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="state" value="<?=set_value('state')?>" />
                            <span class="error"><?=form_error('state') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Country <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="country" value="<?=set_value('country')?>" />
                            <span class="error"><?=form_error('country') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Postal Code</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="postal_code" value="<?=set_value('postal_code')?>" />
                            <span class="error"><?=form_error('postal_code') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="contact_number" value="<?=set_value('contact_number')?>" />
                            <span class="error"><?=form_error('contact_number') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="<?=set_value('email')?>" />
                            <span class="error"><?=form_error('email') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Capacity <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="capacity" value="<?=set_value('capacity')?>" />
                            <span class="error"><?=form_error('capacity') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Operating Hours</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="operating_hours" value="<?=set_value('operating_hours')?>" />
                            <span class="error"><?=form_error('operating_hours') ?></span>
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
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
