<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li>
                <a href="<?=base_url('testCenters')?>"><i class="fas fa-list-ul"></i> Test Centers List</a>
            </li>
            <li class="active">
                <a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> Update Test Center</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="edit">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <input type="hidden" name="test_center_id" id="test_center_id" value="<?php echo $data->id; ?>">
                    <div class="form-group mt-md">
                        <label class="col-md-3 control-label">Test Center Name <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="<?=set_value('name', $data->name)?>" />
                            <span class="error"><?=form_error('name') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="address" value="<?=set_value('address', $data->address)?>" />
                            <span class="error"><?=form_error('address') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">City <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="city" value="<?=set_value('city', $data->city)?>" />
                            <span class="error"><?=form_error('city') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">State <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="state" value="<?=set_value('state', $data->state)?>" />
                            <span class="error"><?=form_error('state') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Country <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="country" value="<?=set_value('country', $data->country)?>" />
                            <span class="error"><?=form_error('country') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Postal Code</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="postal_code" value="<?=set_value('postal_code', $data->postal_code)?>" />
                            <span class="error"><?=form_error('postal_code') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact Number</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="contact_number" value="<?=set_value('contact_number', $data->contact_number)?>" />
                            <span class="error"><?=form_error('contact_number') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?=translate('email')?> <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="<?=set_value('email', $data->email)?>" />
                            <span class="error"><?=form_error('email') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Capacity <span class="required">*</span></label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="capacity" value="<?=set_value('capacity', $data->capacity)?>" />
                            <span class="error"><?=form_error('capacity') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Operating Hours</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="operating_hours" value="<?=set_value('operating_hours', $data->operating_hours)?>" />
                            <span class="error"><?=form_error('operating_hours') ?></span>
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
