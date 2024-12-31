<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-md-12 card service-card" style="padding:10px; text-align:center; margin:auto;">
                    <h3 style="margin-top:5px; margin-bottom:5px; color:Red; padding:10px;">
                      <?php if (is_applicant_loggedin()) { ?>
                        Please note that Roll no slips will be issued soon and you will be notified via email. If you have any other queries please feel free to contact us
                      <?php } ?>
                      <?php if (is_superadmin_loggedin()) { ?>
                         The following are the queries asked by the Applicants.
                         <?php } ?>  
                    </h3>
                    
                    <!-- Add button -->
					      </div>
            </div>
        </div>
    </div>
</div>
<section class="panel" >
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            
            <li class="<?=(!empty($validation_error) ? 'active' : 'active') ?>">
                <a href="#create" data-toggle="tab"><i class="far fa-edit"></i> Queries</a>
            </li>
        </ul>
        <div class="tab-content">
            
        <?php if (is_applicant_loggedin()) { ?>
            <div class="tab-pane <?=(!empty($validation_error) ? 'active' : 'active')?>" id="create">
                <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered validate')); ?>
                    <div class="form-group mt-md">
       

    <!-- Position -->
    <div class="form-group">
                    <label class="col-md-3 control-label">Position Applied For<span class="required">*</span></label>
                    <div class="col-md-6">
                    <?php
    $options = ['' => 'Select Job']; // Default option
    foreach ($jobs as $job) {
        $options[$job['designation']] = $job['designation'];
    }
    
    echo form_dropdown(
        "position", 
        $options, 
        set_value('job_id'), 
        "class='form-control' required='' '
        data-width='100%' data-plugin-selectTwo data-minimum-results-for-search='Infinity'"
    );
?>
                        <span class="error"><?=form_error('position')?></span>
                    </div>
                </div>

    <!-- Query -->
    <div class="form-group mt-md">
        <label class="col-md-3 control-label">Query<span class="required">*</span></label>
        <div class="col-md-6">
            <textarea class="form-control" 
                      name="query" 
                      required 
                      title="Query cannot be empty."><?= set_value('query') ?></textarea>
            <span class="error text-danger"><?= form_error('query') ?></span>
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
           <?php  } ?> 
           <?php if (is_superadmin_loggedin()) { ?>
           <div class="mb-md">
					<table class="table table-bordered table-hover table-condensed mb-none table-export">
						<thead>
							<tr>
								<th width="50"><?=translate('sl')?></th>
								<th>Name</th>	
								<th>Cnic</th>
								<th>Mobile No</th>
								<th>Applied For </th>
								<th>Query</th>
								<th>Created At</th>
							</tr>
						</thead>
						<tbody>
            <?php 
								$count = 1;
								$contact_us = $this->db->get('contact_us')->result();
								foreach($contact_us as $cu):
							?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $cu->name;?></td>			
								<td><?php echo $cu->cnic;?></td>
								<td><?php echo $cu->mobile;?></td>
								<td><?php echo $cu->position;?></td>
                <td><?php echo $cu->query;?></td>
                <td><?php echo $cu->created_at;?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
          <?php } ?>
				</div>
        </div>
    </div>
</section>