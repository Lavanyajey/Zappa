/*notification plugin*/
(function($){
  
  /**
  * Set it up as an object under the jQuery namespace
  */
  $.notification = {};
  
  /**
  * Set up global options that the user can over-ride
  */
  $.notification.options = {
      title: '',
      msg: 'message',
    fade_in_speed: 200, // how fast notifications fade in
    fade_out_speed: 1000, // how fast the notices fade out
    time: 6000 // hang on the screen for...
  };
  
  /**
  * Show the notification on the screen
  */
  $.notification.display = function(params) {
    try {
      return Notification.display(params || {});
    } catch(e) {
      var err = 'Notification Error: ' + e;
      (typeof(console) != 'undefined' && console.error) ? 
        console.error(err, params) : 
        alert(err);
    }
  };

  var Notification = {
        
      // Public - options to over-ride with $.notification.options
      fade_in_speed: '',
      fade_out_speed: '',
      time: '',
      msg: '',
      title: '',
      
      // Private
      _custom_timer: 0,
      _item_count: 0,
      _is_setup: 0,
      _tpl_close: '<div class="notification-close"></div>',
      _tpl_item: '<div id="notification-item-[[number]]" class="notification-item-wrapper [[item_class]]" style="display:none; width:[[width]]"><div class="notification-item">[[image]]<div class="[[class_name]]"><span class="notification-title">[[title]]</span><p>[[msg]]</p></div><div style="clear:both"></div></div></div>',
      _tpl_wrap: '<div id="notification-container"></div>',
        
      /**
      * Add a gritter notification to the screen
      * @param {Object} params The object that contains all the options for drawing the notification
      * @return {Integer} The specific numeric id to that notification
      */
      display: function(params){			
        // Check the options and set them once
        if(!this._is_setup){
          this._runSetup();
        }    		        
        // Basics
        var title = params.title || '', 
          msg = params.msg || 'message',
          image = params.image || '',
          sticky = params.sticky || false,
          item_class = params.class_name || '',
          time_alive = params.time || '';

        this._verifyContainer();
        
        this._item_count++;
        var number = this._item_count, 
          tmp = this._tpl_item;
        
        // Assign callbacks
        $(['before_open', 'after_open', 'before_close', 'after_close']).each(function(i, val){
          Notification['_' + val + '_' + number] = ($.isFunction(params[val])) ? params[val] : function(){}
        });

        // Reset
        this._custom_timer = 0;
        
        // A custom fade time set
        if(time_alive){
          this._custom_timer = time_alive;
        }
        
        var image_str = (image != '') ? '<img src="' + image + '" class="notification-image" />' : '',
          class_name = (image != '') ? 'notification-with-image' : 'notification-without-image';

      //measure width that we should set for the notification
      $('body').append('<div class="temp" style="display:none; font-size:20px;">'+msg+'</div>');
      var width = $('.temp').width();
      console.log(width);
      if (width>515) {
        width = 515;
      }
      width = width + 'px';
      //could be problematic if two notifications displayed at the same time.. somehow..? or..
      $('.temp').remove();
        
        // String replacements on the template
        tmp = this._str_replace(
          ['[[title]]', '[[msg]]', '[[image]]', '[[number]]', '[[class_name]]', '[[item_class]]', '[[width]]'],
          [title, msg, image_str, this._item_count, class_name, item_class, width], tmp
        );
            
        this['_before_open_' + number]();
        $('#notification-container').prepend(tmp);
        
        var item = $('#notification-item-' + this._item_count);

        $('#notification-container').css('bottom', '100px');
        $('#notification-container').animate({bottom: '-=40px'}, 2*this.fade_in_speed, 'swing');
        item.fadeIn(this.fade_in_speed, function(){
          Notification['_after_open_' + number]($(this));
        });
            
        if(!sticky){
          this._setFadeTimer(item, number);
        }
        
        // Bind the hover/unhover states
        $(item).bind('mouseenter mouseleave', function(event){
          if(event.type == 'mouseenter'){
            if(!sticky){ 
              Notification._restoreItemIfFading($(this), number);
            }
          }
          else {
            if(!sticky){
              Notification._setFadeTimer($(this), number);
            }
          }
          Notification._hoverState($(this), event.type);
        });
        
        return number;
      },

      /**
      * Setup the global options - only once
      * @private
      */
      _runSetup: function(){
        for(opt in $.notification.options){
          this[opt] = $.notification.options[opt];
        }
        this._is_setup = 1;
      },

      _verifyContainer: function() {  
        if($('#notification-container').length == 0) {
          $('body').append(this._tpl_wrap);
        }
      },
      /**
      * An extremely handy PHP function ported to JS, works well for templating
      * @private
      * @param {String/Array} search A list of things to search for
      * @param {String/Array} replace A list of things to replace the searches with
      * @return {String} sa The output
      */  
      _str_replace: function(search, replace, subject, count){
      
        var i = 0, j = 0, temp = '', repl = '', sl = 0, fl = 0,
          f = [].concat(search),
          r = [].concat(replace),
          s = subject,
          ra = r instanceof Array, sa = s instanceof Array;
        s = [].concat(s);
        
        if(count){
          this.window[count] = 0;
        }
      
        for(i = 0, sl = s.length; i < sl; i++){
          
          if(s[i] === ''){
            continue;
          }
          
              for (j = 0, fl = f.length; j < fl; j++){
            
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            
            if(count && s[i] !== temp){
              this.window[count] += (temp.length-s[i].length) / f[j].length;
            }
            
          }
        }
        return sa ? s : s[0];
      },

    /* */
      _setFadeTimer: function(e, unique_id){	
        var timer_str = (this._custom_timer) ? this._custom_timer : this.time;
        this['_int_id_' + unique_id] = setTimeout(function(){ 
          Notification._fade(e, unique_id); 
        }, timer_str);
      
      },

      _fade: function(e, unique_id, params, unbind_events){
        
        var params = params || {},
          fade = (typeof(params.fade) != 'undefined') ? params.fade : true;
          fade_out_speed = params.speed || this.fade_out_speed;
        
        this['_before_close_' + unique_id](e);
        
        // If this is true, then we are coming from clicking the (X)
        if(unbind_events){
          e.unbind('mouseenter mouseleave');
        }
        
        // Fade it out or remove it
        if(fade){
          e.animate({
            opacity: 0
          }, fade_out_speed, function(){
            e.animate({ height: 0 }, 300, function(){
              Notification._countRemoveWrapper(unique_id, e);
            })
          })
        }
        else {	
          this._countRemoveWrapper(unique_id, e);
        }		    
      },

      _hoverState: function(e, type){
        // Change the border styles and add the (X) close button when you hover
        if(type == 'mouseenter'){
          e.addClass('hover');
          var find_img = e.find('img');	
          // Insert the close button before what element
          (find_img.length) ? 
            find_img.before(this._tpl_close) : 
            e.find('span').before(this._tpl_close);
          // Clicking (X) makes the perdy thing close
          e.find('.notification-close').click(function(){
            var unique_id = e.attr('id').split('-')[2];
            Notification.removeSpecific(unique_id, {}, e, true);
          });
        }
        // Remove the border styles and (X) close button when you mouse out
        else {
          e.removeClass('hover');
          e.find('.notification-close').remove();
        }   
      },

    /*remove the container if there are no notifications*/
      _countRemoveWrapper: function(unique_id, e){
        // Remove it then run the callback function
        e.remove();
        this['_after_close_' + unique_id](e);
        
        // Check if the wrapper is empty, if it is.. remove the wrapper
        if($('.notification-item-wrapper').length == 0){
          $('#notification-container').remove();
        }
      },
      
      removeSpecific: function(unique_id, params, e, unbind_events){
        if(!e){
          var e = $('#gritter-item-' + unique_id);
        }
        // We set the fourth param to let the _fade function know to 
        // unbind the "mouseleave" event.  Once you click (X) there's no going back!
        this._fade(e, unique_id, params || {}, unbind_events);
      }
  };
})(jQuery);