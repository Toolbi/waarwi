<script type="text/javascript">
/*
 * jQuery TagBox - jQuery Plugin
 * Simple way to input tag like data through a form
 *
 * Examples and documentation at: http://www.geektantra.com
 *
 * Copyright (c) 2011 GeekTantra
 *
 * Version: 1.0.1 (02/06/2011)
 * Requires: jQuery v1.4+
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
(function(jQuery) {
  jQuery.fn.tagBox = function(options) {
    var defaults = {
      separator: '~',
      className: 'tagBox',
      tagInputClassName: 'fleft padding10 marginleft10',
      tagButtonClassName: 'btn tagbox-btn tagbox colorwhite',
      tagButtonTitle: '<?php echo lang('add_route_btn');?>',
      confirmRemoval: true,
      confirmRemovalText: '<?php echo lang('remove_tag_confirm');?>',
      completeOnSeparator: true,
      completeOnBlur: false,
      readonly: false,
      enableDropdown: false,
      dropdownSource: function() {},
      dropdownOptionsAttribute: "title",
      removeTagText: "<?php echo lang('remove_tag');?>",
      maxTags: -1,
      maxTagsErr: function(max_tags) { alert("A maximum of "+max_tags+" tags can be added!"); },
      beforeTagAdd: function(tag_to_add) {},
      afterTagAdd: function(added_tag) {}
    }
    
    
    if (options) {
      options = jQuery.extend(defaults, options);
    } else {
      options = defaults;
    }
    options.tagInputClassName = ( options.tagInputClassName != '' ) ? options.tagInputClassName + ' ' : '';
    options.tagButtonClassName = ( options.tagButtonClassName != '' ) ? options.tagButtonClassName + ' ' : '';
//  Hide Element
    var $elements = this;
    if($elements.length < 1) return;
    
    $elements.each(function(){
      var uuid = Math.round( Math.random()*0x10000 ).toString(16) + Math.round( Math.random()*0x10000 ).toString(16);
      
      var $element = jQuery(this);
      
      $element.hide();
      try {
        var options_from_attribute = jQuery.parseJSON($element.attr(options.dropdownOptionsAttribute));
        options = jQuery.extend(options_from_attribute, options);
      } catch(e) {
        console.log(e);
      }
      if($element.is(":disabled")) 
        options.readonly = true;
      if( (jQuery.isArray($element)) && $element[0].hasAttribute("readonly") )
        options.readonly = true
      
  //  Create DOM Elements
      if( (options.enableDropdown) && options.dropdownSource() != null ) {
        if(options.dropdownSource().jquery) {
          var $tag_input_elem = (options.readonly) ? '' : options.dropdownSource();
          $tag_input_elem.attr("id", options.className+'-input-'+uuid);
          $tag_input_elem.addClass(options.className+'-input');
        } else {
          var tag_dropdown_items_obj = jQuery.parseJSON(options.dropdownSource());
          var tag_dropdown_options = new Array('<option value=""></option>');
          jQuery.each(tag_dropdown_items_obj, function(i, v){
            if((jQuery.isArray(v)) && v.length == 2 ) {
              tag_dropdown_options.push( '<option value="'+v[0]+'">'+v[1]+'</option>' );
            } else if ( !jQuery.isArray(v) ) {
              tag_dropdown_options.push( '<option value="'+i+'">'+v+'</option>' );
            }
          });
          var tag_dropdown = '<select class="'+options.tagInputClassName+' '+options.className+'-input" id="'+options.className+'-input-'+uuid+'">'+tag_dropdown_options.join("")+'</select>';
          var $tag_input_elem = (options.readonly) ? '' : jQuery(tag_dropdown);
        }
      } else {
        var $tag_input_elem = (options.readonly) ? '' : jQuery('<input type="text" class="row padding10 row59 '+options.className+'-input" value="" id="welcome" placeholder="<?php echo lang('deviation_holder');?>"/>');
      }
    
    var $tag_add_elem = (options.readonly) ? '' : jQuery('<a href="javascript:void(0)"  class="'+options.tagButtonClassName+''+options.className+'-add-tag" id="'+options.className+'-add-tag-'+uuid+'">'+options.tagButtonTitle+'</a>');
      var $tag_list_elem = jQuery('<div class="fleft width100 margintop20"><span class="'+options.className+'-list" id="'+options.className+'-list-'+uuid+'"></span>');
      
      var $tagBox = jQuery('<span class="'+options.className+'-container"></span>').append($tag_input_elem).append($tag_add_elem).append($tag_list_elem);
      
      $element.before($tagBox);
      
      $element.addClass("jQTagBox");
      $element.unbind('reloadTagBox');
      $element.bind('reloadTagBox', function(){
        $tagBox.remove();
        $element.tagBox(options);
      });
      
  //  Generate Tags List from Input item
      generate_tags_list( get_current_tags_list() );
      if(!options.readonly) {
        $tag_add_elem.click(function() {
      checkroute();
        
      setTimeout(function() {
        
        var value = $tag_input_elem.val();
        //valu = value.split(',');
        //var vals = '';
        
        if(value!=''){  
            vals = value;
            $('#edited').val('1');
        }else{
          alert('Please fill the route');
          return false
        }
        
        var selected_tag = vals; 
         options.beforeTagAdd(selected_tag);
         add_tag(selected_tag);
         if($tag_input_elem.is("select")) {
        $tag_input_elem.find('option[value="'+selected_tag+'"]').attr("disabled", "disabled");
         }
         $tag_input_elem.val('');
         options.afterTagAdd(selected_tag);
          
      }, 1000); 
        
      
      
        });
        $tag_input_elem.keypress(function(e) {
          var code = (e.keyCode ? e.keyCode : e.which);
          var this_val = jQuery(this).val();
     // alert(this_val);
          if(code==13 || (code == options.separator.charCodeAt(0) && options.completeOnSeparator) ) {
            $tag_add_elem.trigger("click");
            return false;
          }
        });
        if( options.completeOnBlur ) {
          $tag_input_elem.blur(function() {
            if(jQuery(this).val() != "")
              $tag_add_elem.trigger("click");
          });
        }
        jQuery('.'+options.className+'-remove-'+uuid).live( "click", function () {
          if(options.confirmRemoval) {
            var c = confirm(options.confirmRemovalText);
            if(!c) return false;
          }
          var tag_item = jQuery(this).attr('rel');
          if($tag_input_elem.is("select")) {
            $tag_input_elem.find('option[value="'+tag_item+'"]').removeAttr("disabled");
          }
          $tag_input_elem.val('');
      
          remove_tag(tag_item);
        });
      }
  //  Methods
      function separator_encountered(val) {
        return (val.indexOf( options.separator ) != "-1") ? true : false;
      }

      function get_current_tags_list() {
      //alert($element.val());
        var tags_list = $element.val().split(options.separator);
        tags_list = jQuery.map(tags_list, function (item) { return jQuery.trim(item); });
        return tags_list;
      }
      
      function generate_tags_list(tags_list) {

      // var tags_list = jQuery.unique(tags_list);
     var tags_list = tags_list;
        $tag_list_elem.html('');
        jQuery.each(tags_list, function(key, val) {
         
      if(val != "") {
            var remove_tag_link = (options.readonly) ? '' : '<a href="javascript:void(0)"  class="'+options.className+'-remove '+options.className+'-remove-'+uuid+' btn cancel-btn fright" title="Remove Tag" rel="'+val+'">'+options.removeTagText+'</a>';
            if((options.enableDropdown) && jQuery('#'+options.className+'-input-'+uuid).find("option").length > 0) {
              var display_val = jQuery('#'+options.className+'-input-'+uuid).find("option[value='"+val+"']").text();
            } else {
              var display_val = val;
            }
            $tag_list_elem.append('<span class="'+options.className+'-item tag-box-space"><span class="'+options.className+'-bullet"></span><p class="cs-grey-bg row "><span class="'+options.className+'-item-content padding10 fleft">'+display_val+'</span>'+remove_tag_link+'</p></span></div>');
          }
        });
        $element.val(tags_list.join(options.separator));
    filter_route();
      }
      
      function add_tag(new_tag_items) {
        var tags_list = get_current_tags_list();
        new_tag_items = new_tag_items.split(options.separator);
        new_tag_items = jQuery.map(new_tag_items, function (item) { return jQuery.trim(item); });
        tags_list = tags_list.concat(new_tag_items);

        tags_list = jQuery.map( tags_list, function(item) { if(item != "") return item } );
        if( tags_list.length > options.maxTags && options.maxTags != -1 ) {
          options.maxTagsErr(options.maxTags);
          return;
        }
        generate_tags_list(tags_list);
      }
      
      function remove_tag(old_tag_items) {
      $('#edited').val('1');
        var tags_list = get_current_tags_list();
        old_tag_items = old_tag_items.split(options.separator);
        old_tag_items = jQuery.map(old_tag_items, function (item) { return jQuery.trim(item); });
        jQuery.each( old_tag_items, function(key, val) {
          tags_list = jQuery.grep(tags_list, function(value) { return value != val; });
        });
        generate_tags_list(tags_list);
    
      }
    });
  }
})(jQuery);
</script>