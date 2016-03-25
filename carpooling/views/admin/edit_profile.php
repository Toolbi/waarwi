<?php include('header.php'); ?>
<?php include('left.php'); ?>
<div id="content-wrapper">
					<div class="row">
						<div class="col-lg-12">
							
							<div class="row">
								<div class="col-lg-12">
									<ol class="breadcrumb">
										<li><a href="#"><?php echo lang('admin_home');?></a></li>
										<li class="active"><span><?php echo lang('edit_profile');?></span></li>
									</ol>
									
									
								</div>
							</div>
							<div class="row">
								
								<div class="col-lg-12">
									<div class="main-box">
										<header class="main-box-header clearfix">
											<h1 class="pull-left">
								               
								                <?php echo  lang('edit_profile') ?>
								               
							              </h1>
										</header>
										 
                                         <?php echo form_open($this->config->item('admin_folder').'/admin/edit_profile/'.$id); ?>
										<div class="main-box-body clearfix">
                                    <div class="row">
                                    <div class="form-group col-xs-5">
                                    <label><b><?php echo lang('first_name');?></b></label>
		<?php
		$data	= array('name'=>'first_name', 'value'=>set_value('first_name', $first_name),  'class'=>'form-control');
		echo form_input($data);
		?></div>
        							
                                    <div class="form-group col-xs-5">
                                    <label><b><?php echo lang('last_name');?></b></label>
									<?php
                                    $data	= array('name'=>'last_name', 'value'=>set_value('last_name', $last_name),  'class'=>'form-control');
                                    echo form_input($data);
                                    ?></div>                                   
                                    <div class="form-group col-xs-5">
                                    <label><b><?php echo lang('company_name')?></b></label>
									<?php
                                    $data	= array('name'=>'company_name', 'value'=>set_value('company_name', $company_name),  'class'=>'form-control');
                                    echo form_input($data);
                                    ?></div>                                   
                              
                                    <div class="form-group col-xs-5">
                                    <label><b><?php echo lang('company_email');?></b></label>
		<?php
		$data	= array('name'=>'company_email', 'value'=>set_value('company_email', $company_email),  'class'=>'form-control');
		echo form_input($data);
		?>
                                    
                                    </div>
                                    <div class="form-group col-xs-5">
                                    <label><b><?php echo lang('company_mobile');?></b></label>
		<?php
		$data	= array('name'=>'company_mobile', 'value'=>set_value('company_mobile', $company_mobile),  'class'=>'form-control');
		echo form_input($data);
		?>
                                    
                                    </div>
                                    </div>               
											</div>
										</div>
                                   
						</div>
					</div>	
                    </div>
						
						
						<div class="col-lg-12">
                    <div style="padding:15px;overflow: hidden;" class="main-box">
                        <div class="row">
                            <div class="row actions">
                                <div class="col-md-3">&nbsp;</div>
                                <div class="col-md-3"><button type="submit" style="margin-left: 35px;" class="col-md-9 btn btn-primary"><?php echo lang('save_form');?></button></div>
                                <div class="col-md-3"><button type="button" onClick="redirect();" style="margin-left: 35px;" class="col-md-9 btn btn-default"><?php echo lang('cancel');?></button></div>
                                <div class="col-md-3">&nbsp;</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
						
						
						
						

<script type="text/javascript">
if ($.browser.webkit) {
    $('input').attr('autocomplete', 'off');
}
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>
<script>
var baseurl = "<?php print base_url(); ?>";
function redirect()
{
	window.location = baseurl +'admin/dashboard'
}
</script>
<?php include('footer.php');