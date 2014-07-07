  <!--[if IE 8]>
  <script type="text/javascript">
  jQuery(document).ready(function() {
  var imgs, i, w;
  var imgs = document.getElementsByTagName( 'img' );
  for( i = 0; i < imgs.length; i++ ) {
      w = imgs[i].getAttribute( 'width' );
      if ( 615 < w ) {
          imgs[i].removeAttribute( 'width' );
          imgs[i].removeAttribute( 'height' );
      }
  }
  });
  </script>
  <![endif]-->
<script type="text/javascript">
  // Set constants as variables for js
  var templateDir = '<?php bloginfo('template_directory') ?>';
  var frameworkDir = '<?php print FRAMEWORK_DIR; ?>';
  var viewsDir = '<?php print VIEWS_DIR; ?>';
  var assetsDir = '<?php print ASSETS_DIR; ?>';
  var libsDir = '<?php print LIBS_DIR; ?>';
  /*@cc_on
    @if (@_jscript_version == 10)
      document.write(' <link type= "text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie10.css" />');
    @end
  @*/
  function insertParam(url, parameterName, parameterValue, atStart){
      replaceDuplicates = true;
      if(url.indexOf('#') > 0){
          var cl = url.indexOf('#');
          urlhash = url.substring(url.indexOf('#'),url.length);
      } else {
          urlhash = '';
          cl = url.length;
      }
      sourceUrl = url.substring(0,cl);

      var urlParts = sourceUrl.split("?");
      var newQueryString = "";

      if (urlParts.length > 1)
      {
          var parameters = urlParts[1].split("&");
          for (var i=0; (i < parameters.length); i++)
          {
              var parameterParts = parameters[i].split("=");
              if (!(replaceDuplicates && parameterParts[0] == parameterName))
              {
                  if (newQueryString == "")
                      newQueryString = "?";
                  else
                      newQueryString += "&";
                  newQueryString += parameterParts[0] + "=" + (parameterParts[1]?parameterParts[1]:'');
              }
          }
      }
      if (newQueryString == "")
          newQueryString = "?";

      if(atStart){
          newQueryString = '?'+ parameterName + "=" + parameterValue + (newQueryString.length>1?'&'+newQueryString.substring(1):'');
      } else {
          if (newQueryString !== "" && newQueryString != '?')
              newQueryString += "&";
          newQueryString += parameterName + "=" + (parameterValue?parameterValue:'');
      }
      return urlParts[0] + newQueryString + urlhash;
  };

  function ytVidId(url) {
    var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    return (url.match(p)) ? RegExp.$1 : false;
    //return (url.match(p)) ? true : false;
  }

  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  function getFrameID(id){
      var elem = document.getElementById(id);
      if (elem) {
          if(/^iframe$/i.test(elem.tagName)) return id; //Frame, OK
          // else: Look for frame
          var elems = elem.getElementsByTagName("iframe");
          if (!elems.length) return null; //No iframe found, FAILURE
          for (var i=0; i<elems.length; i++) {
             if (/^https?:\/\/(?:www\.)?youtube(?:-nocookie)?\.com(\/|$)/i.test(elems[i].src)) break;
          }
          elem = elems[i]; //The only, or the best iFrame
          if (elem.id) return elem.id; //Existing ID, return it
          // else: Create a new ID
          do { //Keep postfixing `-frame` until the ID is unique
              id += "-frame";
          } while (document.getElementById(id));
          elem.id = id;
          return id;
      }
      // If no element, return null.
      return null;
  }

  // Define YT_ready function.
  var YT_ready = (function() {
      var onReady_funcs = [], api_isReady = false;
      /* @param func function     Function to execute on ready
       * @param func Boolean      If true, all qeued functions are executed
       * @param b_before Boolean  If true, the func will added to the first
                                   position in the queue*/
      return function(func, b_before) {
          if (func === true) {
              api_isReady = true;
              while (onReady_funcs.length) {
                  // Removes the first func from the array, and execute func
                  onReady_funcs.shift()();
              }
          } else if (typeof func == "function") {
              if (api_isReady) func();
              else onReady_funcs[b_before?"unshift":"push"](func);
          }
      }
  })();
  // This function will be called when the API is fully loaded
  function onYouTubePlayerAPIReady() {YT_ready(true)}

  jQuery(window).load(function() {
    if(jQuery('#sidebar').is(':visible')) {
      jQuery('.post-content div.portfolio').each(function() {
        var columns = jQuery(this).data('columns');
        jQuery(this).addClass('portfolio-'+columns+'-sidebar');
      });
    }
    jQuery('.full-video, .video-shortcode, .wooslider .slide-content').fitVids();

    if(jQuery().isotope) {
        // modified Isotope methods for gutters in masonry
        jQuery.Isotope.prototype._getMasonryGutterColumns = function() {
          var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
              containerWidth = this.element.width();

          this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth ||
                        // or use the size of the first item
                        this.$filteredAtoms.outerWidth(true) ||
                        // if there's no items, use size of container
                        containerWidth;

          this.masonry.columnWidth += gutter;

          this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
          this.masonry.cols = Math.max( this.masonry.cols, 1 );
        };

        jQuery.Isotope.prototype._masonryReset = function() {
          // layout-specific props
          this.masonry = {};
          // FIXME shouldn't have to call this again
          this._getMasonryGutterColumns();
          var i = this.masonry.cols;
          this.masonry.colYs = [];
          while (i--) {
            this.masonry.colYs.push( 0 );
          }
        };

        jQuery.Isotope.prototype._masonryResizeChanged = function() {
          var prevSegments = this.masonry.cols;
          // update cols/rows
          this._getMasonryGutterColumns();
          // return if updated cols/rows is not equal to previous
          return ( this.masonry.cols !== prevSegments );
        };

      jQuery('.portfolio-one .portfolio-wrapper').isotope({
        // options
        itemSelector: '.portfolio-item',
        layoutMode: 'straightDown',
        transformsEnabled: false
      });

      jQuery('.portfolio-two .portfolio-wrapper, .portfolio-three .portfolio-wrapper, .portfolio-four .portfolio-wrapper').isotope({
        // options
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows',
        transformsEnabled: false
      });
    }

    if(jQuery().flexslider) {
      var iframes = jQuery('iframe');
      var avada_ytplayer;

      jQuery.each(iframes, function(i, v) {
        var src = jQuery(this).attr('src');
        if(src) {
          if(src.indexOf('vimeo') >= 1) {
            jQuery(this).attr('id', 'player_'+(i+1));
            var new_src = insertParam(src, 'api', '1', false);
            var new_src_2 = insertParam(new_src, 'player_id', 'player_'+(i+1), false);

            jQuery(this).attr('src', new_src_2);
          }
          if(ytVidId(src)) {
            jQuery(this).parent().wrap('<span class="play3" />');
          }
        }
      });

      function ready(player_id) {
          var froogaloop = $f(player_id);

          froogaloop.addEvent('play', function(data) {
            jQuery('#'+player_id).parents('li').parent().parent().flexslider("pause");
          });

          froogaloop.addEvent('pause', function(data) {
              jQuery('#'+player_id).parents('li').parent().parent().flexslider("play");
          });
      }

      var vimeoPlayers = jQuery('.flexslider').find('iframe'), player;

      for (var i = 0, length = vimeoPlayers.length; i < length; i++) {
            player = vimeoPlayers[i];
            $f(player).addEvent('ready', ready);
      }

      function addEvent(element, eventName, callback) {
          if (element.addEventListener) {
              element.addEventListener(eventName, callback, false)
          } else {
              element.attachEvent(eventName, callback, false);
          }
      }

      jQuery('.tfs-slider').flexslider({
        animation: "<?php if($data['tfs_animation']) { echo $data['tfs_animation']; } else { echo 'fade'; } ?>",
        slideshow: <?php if($data['tfs_autoplay']) { echo 'true'; } else { echo 'false'; } ?>,
        slideshowSpeed: <?php if($data['tfs_slideshow_speed']) { echo $data['tfs_slideshow_speed']; } else { echo '7000'; } ?>,
        animationSpeed: <?php if($data['tfs_animation_speed']) { echo $data['tfs_animation_speed']; } else { echo '600'; } ?>,
        smoothHeight: true,
        pauseOnHover: false,
        useCSS: false,
        video: true,
        start: function(slider) {
              if(typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').hide();
                 <?php endif; ?>

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });
             } else {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').show();
                 <?php endif; ?>
             }
        },
          before: function(slider) {
              if(slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 $f( slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });

                 /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
                 playVideoAndPauseOthers(slider);
             }
          },
          after: function(slider) {
              if(slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').hide();
                 <?php endif; ?>

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });
             } else {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').show();
                 <?php endif; ?>
             }
          }
      });

      jQuery('.flexslider').flexslider({
        slideshow: <?php if($data["slideshow_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
        video: true,
        pauseOnHover: false,
        useCSS: false,
        <?php if(get_post_meta($c_pageID, 'pyre_fimg_width', true) == 'auto' && get_post_meta($c_pageID, 'pyre_width', true) == 'half'): ?>smoothHeight: true,<?php endif; ?>
        start: function(slider) {
              if (typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').hide();
                 <?php endif; ?>

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });
             } else {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '0');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').show();
                 <?php endif; ?>
             }
        },
          before: function(slider) {
              if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 $f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });

                 /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
                 playVideoAndPauseOthers(slider);
             }
          },
          after: function(slider) {
              if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').hide();
                 <?php endif; ?>

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });
             } else {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').show();
                 <?php endif; ?>
             }
          }
      });

      function playVideoAndPauseOthers(slider) {
        jQuery(slider).find('iframe').each(function(i) {
          var func = 'stopVideo';
          this.contentWindow.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
        });
      }

      /* ------------------ PREV & NEXT BUTTON FOR FLEXSLIDER (YOUTUBE) ------------------ */
      jQuery('.flex-next, .flex-prev').click(function() {
        playVideoAndPauseOthers(jQuery(this).parents('.flexslider, .tfs-slider'));
      });

      function onPlayerStateChange(frame, slider) {
        return function(event) {
              if(event.data == YT.PlayerState.PLAYING) {
                  jQuery(slider).flexslider("pause");
              }
              if(event.data == YT.PlayerState.PAUSED) {
                jQuery(slider).flexslider("play");
              }
          }
      }
    }

    if(jQuery().isotope) {
      var gridwidth = (jQuery('.grid-layout').width() / 2) - 22;
      jQuery('.grid-layout .post').css('width', gridwidth);
      jQuery('.grid-layout').isotope({
        layoutMode: 'masonry',
        itemSelector: '.post',
        masonry: {
          columnWidth: gridwidth,
          gutterWidth: 40
        },
      });

      var gridwidth = (jQuery('.grid-full-layout').width() / 3) - 30;
      jQuery('.grid-full-layout .post').css('width', gridwidth);
      jQuery('.grid-full-layout').isotope({
        layoutMode: 'masonry',
        itemSelector: '.post',
        masonry: {
          columnWidth: gridwidth,
          gutterWidth: 40
        },
      });
    }

    jQuery('.rev_slider_wrapper').each(function() {
      if(jQuery(this).length >=1 && jQuery(this).find('.tp-bannershadow').length == 0) {
        jQuery('<div class="shadow-left">').appendTo(this);
        jQuery('<div class="shadow-right">').appendTo(this);

        jQuery(this).addClass('avada-skin-rev');
      }
    });

    jQuery('.tparrows').each(function() {
      if(jQuery(this).css('visibility') == 'hidden') {
        jQuery(this).remove();
      }
    });
  });
  jQuery(document).ready(function($) {
    jQuery('.header-social .menu > li').height(jQuery('.header-social').height());
    jQuery('.header-social .menu > li').css('line-height', jQuery('.header-social').height()+'px');
    function onAfter(curr, next, opts, fwd) {
      var $ht = jQuery(this).height();

      //set the container's height to that of the current slide
      $(this).parent().css('height', $ht);
    }

    if(jQuery().cycle) {
        jQuery('.reviews').cycle({
        fx: 'fade',
        after: onAfter,
        <?php if($data['testimonials_speed']): ?>
        timeout: <?php echo $data['testimonials_speed']; ?>
        <?php endif; ?>
      });
    }

    <?php if($data['image_rollover']): ?>
    /*$('.image').live('mouseenter', function(e) {
      if(!$(this).hasClass('slided')) {
        $(this).find('.image-extras').show().stop(true, true).animate({opacity: '1', left: '0'}, 400);
        $(this).addClass('slided');
      } else {
        $(this).find('.image-extras').stop(true, true).fadeIn('normal');
      }
    });
    $('.image-extras').mouseleave(function(e) {
      $(this).fadeOut('normal');
    });*/
    <?php endif; ?>

    var ppArgs = {
      <?php if($data["lightbox_animation_speed"]): ?>
      animation_speed: '<?php echo strtolower($data["lightbox_animation_speed"]); ?>',
      <?php endif; ?>
      overlay_gallery: <?php if($data["lightbox_gallery"]) { echo 'true'; } else { echo 'false'; } ?>,
      autoplay_slideshow: <?php if($data["lightbox_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
      <?php if($data["lightbox_slideshow_speed"]): ?>
      slideshow: <?php echo $data['lightbox_slideshow_speed']; ?>,
      <?php endif; ?>
      <?php if($data["lightbox_opacity"]): ?>
      opacity: <?php echo $data['lightbox_opacity']; ?>,
      <?php endif; ?>
      show_title: <?php if($data["lightbox_title"]) { echo 'true'; } else { echo 'false'; } ?>,
      show_desc: <?php if($data["lightbox_desc"]) { echo 'true'; } else { echo 'false'; } ?>,
      <?php if(!$data["lightbox_social"]) { echo 'social_tools: "",'; } ?>
    };

    jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs);

    <?php if($data['lightbox_post_images']): ?>
    jQuery('.single-post .post-content a').has('img').prettyPhoto(ppArgs);
    <?php endif; ?>

    var mediaQuery = 'desk';

    if (Modernizr.mq('only screen and (max-width: 600px)') || Modernizr.mq('only screen and (max-height: 520px)')) {

      mediaQuery = 'mobile';
      jQuery("a[rel^='prettyPhoto']").unbind('click');
      <?php if($data['lightbox_post_images']): ?>
      jQuery('.single-post .post-content a').has('img').unbind('click');
      <?php endif; ?>
    }

    // Disables prettyPhoto if screen small
    jQuery(window).resize(function() {
      if ((Modernizr.mq('only screen and (max-width: 600px)') || Modernizr.mq('only screen and (max-height: 520px)')) && mediaQuery == 'desk') {
        jQuery("a[rel^='prettyPhoto']").unbind('click.prettyphoto');
        <?php if($data['lightbox_post_images']): ?>
        jQuery('.single-post .post-content a').has('img').unbind('click.prettyphoto');
        <?php endif; ?>
        mediaQuery = 'mobile';
      } else if (!Modernizr.mq('only screen and (max-width: 600px)') && !Modernizr.mq('only screen and (max-height: 520px)') && mediaQuery == 'mobile') {
        jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs);
        <?php if($data['lightbox_post_images']): ?>
        jQuery('.single-post .post-content a').has('img').prettyPhoto(ppArgs);
        <?php endif; ?>
        mediaQuery = 'desk';
      }
    });
    <?php if($data['sidenav_behavior'] == 'Click'): ?>
    jQuery('.side-nav li a').live('click', function(e) {
      if(jQuery(this).find('.arrow').length >= 1) {
        if(jQuery(this).parent().find('> .children').length >= 1 && !$(this).parent().find('> .children').is(':visible')) {
          jQuery(this).parent().find('> .children').stop(true, true).slideDown('slow');
        } else {
          jQuery(this).parent().find('> .children').stop(true, true).slideUp('slow');
        }
      }

      if(jQuery(this).find('.arrow').length >= 1) {
        return false;
      }
    });
    <?php else: ?>
    jQuery('.side-nav li').hoverIntent({
    over: function() {
      if(jQuery(this).find('> .children').length >= 1) {
        jQuery(this).find('> .children').stop(true, true).slideDown('slow');
      }
    },
    out: function() {
      if(jQuery(this).find('.current_page_item').length == 0 && jQuery(this).hasClass('current_page_item') == false) {
        jQuery(this).find('.children').stop(true, true).slideUp('slow');
      }
    },
    timeout: 500
    });
    <?php endif; ?>

    if(jQuery().eislideshow) {
          jQuery('#ei-slider').eislideshow({
            <?php if($data["tfes_animation"]): ?>
            animation: '<?php echo $data["tfes_animation"]; ?>',
            <?php endif; ?>
            autoplay: <?php if($data["tfes_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
            <?php if($data["tfes_interval"]): ?>
            slideshow_interval: <?php echo $data['tfes_interval']; ?>,
            <?php endif; ?>
            <?php if($data["tfes_speed"]): ?>
            speed: <?php echo $data['tfes_speed']; ?>,
            <?php endif; ?>
            <?php if($data["tfes_width"]): ?>
            thumbMaxWidth: <?php echo $data['tfes_width']; ?>
            <?php endif; ?>
          });
      }

        var retina = window.devicePixelRatio > 1 ? true : false;

        <?php if($data['logo_retina'] && $data['retina_logo_width'] && $data['retina_logo_height']): ?>
        if(retina) {
          jQuery('#header .logo img').attr('src', '<?php echo $data["logo_retina"]; ?>');
          jQuery('#header .logo img').attr('width', '<?php echo $data["retina_logo_width"]; ?>');
          jQuery('#header .logo img').attr('height', '<?php echo $data["retina_logo_height"]; ?>');
        }
        <?php endif; ?>

        <?php if($data['custom_icon_image_retina']): ?>
        if(retina) {
          jQuery('.social-networks li.custom').each(function() {
            jQuery(this).find('img').attr('src', '<?php echo $data["custom_icon_image_retina"]; ?>');
            jQuery(this).find('img').attr('width', '15px');
            jQuery(this).find('img').attr('height', '15px');
          })
        }
        <?php endif; ?>

        /* wpml flag in center */
    var wpml_flag = jQuery('ul#nav > li > a > .iclflag');
    var wpml_h = wpml_flag.height();
    wpml_flag.css('margin-top', +wpml_h / - 2 + "px");

    var wpml_flag = jQuery('.top-menu > ul > li > a > .iclflag');
    var wpml_h = wpml_flag.height();
    wpml_flag.css('margin-top', +wpml_h / - 2 + "px");

    <?php if($data['blog_pagination_type'] == 'Infinite Scroll' || is_page_template('demo-gridblog.php')  || is_page_template('demo-timelineblog.php')): ?>
    jQuery('#posts-container').infinitescroll({
        navSelector  : "div.pagination",
                       // selector for the paged navigation (it will be hidden)
        nextSelector : "a.pagination-next",
                       // selector for the NEXT link (to page 2)
        itemSelector : "div.post",
                       // selector for all items you'll retrieve
        errorCallback: function() {
          jQuery('#posts-container').isotope('reLayout');
        }
    }, function(posts) {
      if(jQuery().isotope) {
        jQuery(posts).css('position', 'relative').css('top', 'auto').css('left', 'auto');

        jQuery('#posts-container').isotope('appended', jQuery(posts));

        var gridwidth = (jQuery('.grid-layout').width() / 2) - 22;
        jQuery('.grid-layout .post').css('width', gridwidth);

        var gridwidth = (jQuery('.grid-full-layout').width() / 3) - 30;
        jQuery('.grid-full-layout .post').css('width', gridwidth);

        jQuery('#posts-container').isotope('reLayout');
      }

      jQuery('.flexslider').flexslider({
        slideshow: <?php if($data["slideshow_autoplay"]) { echo 'true'; } else { echo 'false'; } ?>,
        video: true,
        pauseOnHover: false,
        useCSS: false,
        start: function(slider) {
              if (typeof(slider.slides) !== 'undefined' && slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').hide();
                 <?php endif; ?>

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });
             } else {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '0');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').show();
                 <?php endif; ?>
             }
        },
          before: function(slider) {
              if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 $f(slider.slides.eq(slider.currentSlide).find('iframe').attr('id') ).api('pause');

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });

                 /* ------------------  YOUTUBE FOR AUTOSLIDER ------------------ */
                 playVideoAndPauseOthers(slider);
             }
          },
          after: function(slider) {
              if (slider.slides.eq(slider.currentSlide).find('iframe').length !== 0) {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '-30px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').hide();
                 <?php endif; ?>

            YT_ready(function() {
              new YT.Player(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), {
                events: {
                  'onStateChange': onPlayerStateChange(slider.slides.eq(slider.currentSlide).find('iframe').attr('id'), slider)
                }
              });
            });
             } else {
                 <?php if($data['pagination_video_slide']): ?>
                 jQuery(slider).find('.flex-control-nav').css('bottom', '0px');
                 <?php else: ?>
                 jQuery(slider).find('.flex-control-nav').show();
                 <?php endif; ?>
             }
          }
      });
      jQuery("a[rel^='prettyPhoto']").prettyPhoto(ppArgs);
      jQuery(posts).each(function() {
        jQuery(this).find('.full-video, .video-shortcode, .wooslider .slide-content').fitVids();
      });

      if(jQuery().isotope) {
        jQuery('#posts-container').isotope('reLayout');
      }
    });
    <?php endif; ?>
  });
  </script>
