<?php include('header.php'); ?>
<?php include('left.php'); ?>

<div id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="#"><?php echo lang('admin_home');?></a></li>
                        <li class="active"><span><?php echo lang('add_new_language');?></span></li>
                    </ol>


                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="main-box">
                        <header class="main-box-header clearfix">
                            <h2><?php echo lang('add_new_language');?></h2>
                        </header>
                        <?php echo form_open($this->config->item('admin_folder') . '/language/form/' . $languageid, ' id="req-form"'); ?>
                        <div class="main-box-body clearfix">
                            <div class="row">
                                <div class="form-group col-xs-3">
                                    <label><b><?php echo lang('language_name');?></b></label>
                                        <?php
                                        $data = array('name' => 'languagename', 'value' => set_value('name', $languagename), 'class' => 'form-control');
                                        echo form_input($data);
                                        ?>
                                </div>                            
                                <div class="form-group col-xs-3">
                                    <label><b><?php echo lang('language_prefix');?> (Ex - EN,IN,FR)</b></label>
                                        <?php
                                        $data = array('name' => 'languagecode', 'value' => set_value('name', $languagecode), 'class' => 'form-control');
                                        echo form_input($data);
                                        ?>
                                </div>
                            </div>
							<div>
                            
                            <br/><br/>
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
            </div>
        </div>
    


    <script type="text/javascript" src="<?php echo admin_js('jquery.validate.js'); ?>"></script>
    <?php echo admin_js('jquery.validate-rules.js', true); ?>

    <script src="<?php echo admin_js('jquery.maskedinput.min.js'); ?>"></script>
    <script src="<?php echo admin_js('bootstrap-datepicker.js'); ?>"></script>

    <script>
        var baseurl = "<?php print base_url(); ?>";
        function redirect()
        {
            window.location = baseurl + 'admin/language'
        }
    </script> 

    <?php include('footer.php'); ?>
