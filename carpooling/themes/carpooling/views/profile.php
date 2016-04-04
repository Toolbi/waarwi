<?php include('header.php');?>
<?php echo theme_js('jquery_tab.min.js',true) ?>
<?php echo theme_js('jquery.ba-hashchange.js',true) ?>
<?php echo theme_js('tab_script.js',true) ?>
<?php echo theme_js('jquery.wallform.js',true) ?>
<?php echo theme_js('notification/goNotification.js',true) ?>
<link href="<?php echo theme_js('notification/goNotification.css') ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo theme_js('popup/css/jquery-confirm.css') ?>" />

<link rel="stylesheet" href="<?php echo theme_js('popup/boxy.css') ?>">
<?php echo theme_js('popup/jquery.boxy.js',true) ?>
<?php echo theme_css('checkbox.css',true) ?>





<script>
$(document).ready(function() {	
	
		<?php if (empty($txtphone)){ ?>
		$('#txtphone').attr('readonly', false);
		$('#txtphone').removeClass('disable');
		<?php } ?>
		
		<?php
		//lets have the flashdata overright "$message" if it exists
		if($this->session->flashdata('message'))
		{
			$message	= $this->session->flashdata('message'); ?>
			$.goNotification('<?=$message?>', { 
			type: 'success', // success | warning | error | info | loading
			position: 'top center', // bottom left | bottom right | bottom center | top left | top right | top center
			timeout: 5000, // time in milliseconds to self-close; false for disable 4000 | false
			animation: 'fade', // fade | slide
			animationSpeed: 'slow', // slow | normal | fast
			allowClose: true, // display shadow?true | false
			});
		<?php }
		
		if($this->session->flashdata('error'))
		{
			$error	= $this->session->flashdata('error'); 
			?>
			$.goNotification("<?=trim($error)?>", { 
			type: 'error', // success | warning | error | info | loading
			position: 'top center', // bottom left | bottom right | bottom center | top left | top right | top center
			timeout: 5000, // time in milliseconds to self-close; false for disable 4000 | false
			animation: 'fade', // fade | slide
			animationSpeed: 'slow', // slow | normal | fast
			allowClose: true, // display shadow?true | false
			});
		<?php
		}
		
		if(function_exists('validation_errors') && validation_errors() != '')
		{
			$error	= validation_errors();
			?>
			$.goNotification('<?=trim($error)?>', { 
			type: 'error', // success | warning | error | info | loading
			position: 'top center', // bottom left | bottom right | bottom center | top left | top right | top center
			timeout: 200000, // time in milliseconds to self-close; false for disable 4000 | false
			animation: 'fade', // fade | slide
			animationSpeed: 'slow', // slow | normal | fast
			allowClose: true, // display shadow?true | false
			});
		<?php
		}
		?>
		
			
	});
	

<?php /*?>function areyousure()
{
	//return confirm('<?php echo 'Are you want to delete this Vehicle';?>');
	 Boxy.confirm("Please confirm:", function() { return true; }, {title: 'Message'});
    //return false;

}	<?php */?>
	
 
var baseurl = "<?php print base_url(); ?>";  
</script>
<script type="text/javascript" src="<?php echo theme_js('jquery.validate.js');?>"></script>
<?php echo theme_js('profile.js',true) ?>

<div class="container-fluid margintop40">
  <div class="container">
    <div class="row"> 
    <!-- Breadcrumb -->
        <ul class="row brd-crmb">
          <li><a href="<?php echo base_url('home');?>"> <img src="<?php echo theme_img('home-ico.png') ?>"> </a></li>
          <li> / </li>
          <li><a href="<?php echo base_url('profile');?>"><?php echo lang('personal_information');?></a></li>
          <div class="col-lg-12">                 
            <h2 class="pull-right">
              <?php echo lang('dashboard');?>  <?=$customer->user_first_name ?>
            </h2>            
          </div>
        </ul>
       
    </div>
    <!-- Photo de profil -->
    <div class="profile-picture">
      <div class="profile-pic" id="ProfilePic"> 
        <img src="<?php if($customer->user_profile_img) { echo theme_profile_img($customer->user_profile_img); } else { echo theme_img('default.png');  }?>" id="old-image" width="100" height="100">
      </div>
      <span><a class="add-picture-btn btn btn-info" href="javascript:void(0)" id="edit-profile">
      <?php echo lang('edit_photo');?> </a></span>
      
      <div id='imageloadstatus' style="display:none">
        <img src='<?php echo theme_img('ajaxloader.gif'); ?>'/> <?php echo lang('uploading_message');?>
      </div>
    </div>
     <!-- Formulaire cachée pour la modification de l'image de profil -->
    <?php 
      $attributes = array('id' => 'profileimageform');
        echo form_open_multipart(base_url('profile/profile_image_upload'),$attributes);
      ?>
    <div  class="uploadFile timelineUploadImg" style="display:none">
      <input type="file"  name="profileimg" id="profileimg">
    </div>          
    </form>

    <!-- test nav tab  -->
    <div class="panel panel-tabs">
      <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="emerald-bg active"><a href="#tab1primary" data-toggle="tab">
              <i class="fa fa-user"></i>
              <span><?php echo lang('profile');?></span>
            </a></li>
            <li class="colored green-bg"><a href="#tab2primary" data-toggle="tab">
              <i class="fa fa-cogs"></i>
              <span><?php echo lang('settings');?></span>
            </a></li>
            <li class="colored purple-bg"><a href="#tab3primary" data-toggle="tab">
              <i class="fa fa-car"></i>
              <span><?php echo lang('my_vehicles');?></span>
            </a></li>
            <li class="colored red-bg"><a href="#tab4primary" data-toggle="tab">
              <i class="fa fa-road"></i>
              <span><?php echo lang('my_trips');?></span>
            </a></li>
            <li class="colored yellow-bg"><a href="#tab5primary" data-toggle="tab">
              <i class="fa fa-star"></i>
              <span><?php echo lang('my_ratings');?></span>
              </a></li>
            <li class="colored gray-bg"><a href="#tab6primary" data-toggle="tab">
              <i class="fa fa-question"></i>
              <span><?php echo lang('my_enquiries');?></span>
            </a></li>
        </ul>
      </div>

      <div class="container-fluid">
        <div class="container">
          <div class="row">
            <div id="v-nav" >
            <!-- Tab info.personnelles -->
            <div class="tab-content" style="display: block;"> 
              <div class="tab-pane fade in active" id="tab1primary">
                <?php include('personal-infos.php');?>
              </div>
              <!-- Tab paramètres  -->
              <div class="tab-pane fade" id="tab2primary">
                <?php include('settings.php');?>
              </div>
              <!-- Tab voitures -->
              <div class="tab-pane fade" id="tab3primary">
                <?php include('vechicles.php');?>
              </div>
              <!-- Tab annonces/trajets -->
              <div class="tab-pane fade" id="tab4primary">
                <div class="active-red padding10">
                  <h4> <?php echo lang('trips');?> </h4>
                </div>
                En cours de développement...
              </div>
              <!-- Tab avis -->
              <div class="tab-pane fade" id="tab5primary">
                <div class="active-yellow padding10">
                  <h4> <?php echo lang('ratings');?> </h4>
                </div>
              En cours de développement...
              </div>
              <!-- Tab demandes -->
              <div class="tab-pane fade" id="tab6primary">
                <div class="active-gray padding10">
                  <h4> <?php echo lang('enquiry');?> </h4>
                </div>
              En cours de développement...
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal des messages -->  
<div class="modal"></div>
