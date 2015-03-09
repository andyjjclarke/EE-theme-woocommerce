$(document).ready(function(){
	
	$('#order_comments_field label').html('Account Number');
	$('#order_comments').attr('placeholder', 'If you know your Early Excellence Account Number, please input it here');
	
	
	$('#woo-breadcrumbs span span:first a').html('Go Shopping');
	$('#woo-breadcrumbs span span:first a').attr('href', 'http://development.earlyexcellence.com/go-shopping');
	
	
	$('.go-shopping.menu-item').mouseenter(function(){
		
		$('.mega-menu').slideDown('fast');
		
	});
	
	$('.mega-menu').mouseleave(function(){
		
		$(this).hide();
		
	});
	
	$('.menu-item').mouseenter(function(){
		
		if(!$(this).hasClass('go-shopping')){
			$('.mega-menu').hide();	
		}
	});
});

;(function($){

    // Find a PNG fallback if we can't use SVGs
    if (!Modernizr.svg) {
        $('img[src*="svg"]').attr('src', function() {
            return $(this).attr('src').replace('.svg', '.png');
        });
    }

    // Off canvas navigation events
    $('.menu-activator').click(function() {
        $(this).toggleClass('active');
        var navWrapper = $('.nav-wrapper');
        navWrapper.toggleClass('show-nav').toggleClass('header--large');
    });

    // Equal heights & Magic equal heights - match content height to largest/largest in row 

    $.fn.equalHeights = function(useDefinedHeight) {
        var currentTallest = 0;
        if (useDefinedHeight !== true) {
            $(this).height("auto");
        }
        $(this).each(function(i){
            var thisHeight = parseFloat($(this).css('height'));
            if (thisHeight > currentTallest) { currentTallest = thisHeight;}
        });
        $(this).css({'height': currentTallest}); 
        return this;
    };

    $.fn.magicEqualHeights = function(useDefinedHeight) {
        var group = [];
        var _this = this;
        _this.each(function(index) {
            group.push(this);
            var nextTop = _this.get(index + 1) ? $(_this.get(index + 1)).offset().top : false;
            var thisTop = $(this).offset().top;
            if (nextTop != thisTop) {
                $(group).equalHeights(useDefinedHeight);
                group = [];
            }
        });
        $(group).equalHeights(useDefinedHeight);
        return this;
    };

    // Ensure the load event fires, even if attached after load
    $.fn.ensureLoad = function(handler) {
        return this.each(function() {
            if(this.complete) {
                handler.call(this);
            } else {
                $(this).load(handler);
            }
        });
    };

    // Replace overlays with multiply canvas
    $.fn.multiplyReplace = function() {
        $(this).each(function() {
            var $this = $(this);
            $this.removeClass('replaced');
            $('img', this)
            .unbind('load')
            .ensureLoad(function() {
                $('canvas', $this).remove();
                var $img     = $('img', $this);
                var $heading = $('h1', $this);

                var canvas = document.createElement('canvas');
                canvas.width = $img.width();
                canvas.height = $img.height();
                var ctx = canvas.getContext('2d');

                ctx.drawImage($img.get(0), 0, 0, $img.width(), $img.height());

                ctx.globalCompositeOperation = 'multiply';
                ctx.fillStyle = $heading.css('backgroundColor');
                ctx.fillRect(0, 0, $heading.outerWidth(), $heading.outerHeight());

                $this.addClass('replaced');
                $img.after(canvas);
            });
        });
    };

    /**
     * Align items vertically to a 62px grid.
     * 
     * Items in itemsToLineUp may not cross any of the items in guideItems.
     * 
     * @param object guideItems The items that you want the passed items to line up with, if any.
     * @param guideItemPadding Any internal padding around the guide items that should be ignored.
     * @param mainItemSpacing Any external spacing around the passed items that should be considered part of the item itself.
     */
     $.fn.lineUpWith = function(guideItems, guideItemPadding, mainItemSpacing) {

        var gridHeight = 62;
        var itemsToLineUp = $(this);
        if (!guideItems) {
            guideItems = [];
        }

        if (!guideItemPadding) {
            guideItemPadding = 0;
        }

        if (!mainItemSpacing) {
            mainItemSpacing = 0;
        }

        // Reset existing height and set to a grid
        itemsToLineUp.css('height', 'auto').css('height', function() {
            var currentHeight = $(this).outerHeight();
            var newHeight = currentHeight % gridHeight === 0 ? 'auto' : (Math.ceil(currentHeight / gridHeight)) * gridHeight;
            return newHeight - mainItemSpacing;
        });

        var allowedOffsets = [];
        if (guideItems.length > 0) {

            guideItems.each(function() {
                var $this = $(this);
                var offset = $this.offset();
                var height = $this.outerHeight();
                allowedOffsets.push({ top: offset.top + guideItemPadding, bottom: offset.top + height - guideItemPadding });
            });

            itemsToLineUp.css('margin-top', 0).each(function() {
                var $this = $(this);
                var offset = $this.offset();
                var height = $this.outerHeight();
                $(allowedOffsets).each(function() {
                    if (offset.top < this.bottom && offset.top + height > this.bottom) {
                        var prev = $this.prev();
                        if (prev.length > 0) {
                            var newHeight = this.bottom - prev.offset().top;

                            if ($this.css('border-top-width')) {
                                newHeight -= parseInt($this.css('border-top-width'));
                            }
                            $([prev.get(0), prev.children().get(0)]).css('height', newHeight);

                        }
                    }
                });
            });
        }

        return this;
    };

    $.fn.bookingPopup = function() {
        $(this).click(function() {
            window.open(this.href, null, 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=800,width=800');
            return false;
        });
    };

    $.fn.socialPopup = function() {
        $(this).click(function() {
            window.open(this.href, null, 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
            return false;
        });
    };

    $(function() {
        $('.popup').bookingPopup();
    });

    $(function() {
        $('.share-links a').socialPopup();
    });

    /**
     * Load shopify item count for the basket
     */
     $(function() {
        $('[data-shopify-item-count]').each(function() {
            var $this = $(this);
            $.ajax({
                url: $this.attr('data-shopify-item-count'),
                dataType: "jsonp",
                success: function(data) {
                    $this.html(
                        ' (' + data.item_count + ')'
                        );
                }
            });
        });
    });

    /**
     * Load Twitter feed(s)
     */
     $(function() {

        function nth(d) {
            if(d>3 && d<21) return 'th';
            switch (d % 10) {
                case 1:  return "st";
                case 2:  return "nd";
                case 3:  return "rd";
                default: return "th";
            }
        }

        $('[data-twitter-feed]').each(function() {
            var $this = $(this);
            $.ajax({
                url: '/wp-content/themes/ex/twitter/',
                data: {
                    screen_name: $this.attr('data-twitter-feed')
                },
                dataType: 'json',
                success: function(data) {
                    var tweets = '<ul>';
                    for (var i = 0, m = data.length; i < m; i++) {
                        var tweetDate = new Date(data[i].created_at);
                        tweets += '<li class="twitter-feed">';
                        tweets += '<span class="twitter-handle">' + data[i].user.screen_name + '</span>' + ' ';
                        tweets += tweetDate.getDate() + nth(tweetDate.getDate()) + ' ';
                        tweets += "January,February,March,April,May,June,July,August,September,October,November,December".split(",")[tweetDate.getMonth()] + ' ';
                        tweets += data[i].text;
                        tweets += '</li>';
                    }
                    tweets += '</ul>';
                    $this.html(tweets);
                    $(window).resize();
                }
            });
        });

    });

})(jQuery); 

/**
* Home page slideshow
*/
;(function($) {
    var currentSlide = 0,
    totalSlides = $('.page-slide').length;

    // Slideshow animation
    var slideShow = function(clickedCircle) {
        var activeSlide = $('.is-active');
        var nextSlide = "#slide-" + currentSlide;

        $(".circleActive").removeClass('circleActive');
        $(clickedCircle).addClass('circleActive');
        
        // Swapping classes and using CSS animations
        $(nextSlide).addClass('is-active');
        activeSlide.removeClass('is-active');
    };

    // Set-up circular slider navigation
    var slideNavigation = function(){
        var navigationContainer = $(".slide-navigation");

        for (var i = 0; i < totalSlides; i++) {
            var classes = i === 0 ? "circle circleActive" : "circle";
            var $circle = $("<a href='#'></a>");
            $circle
            .attr('data-slide', i)
            .addClass(classes)
            .click(function() {
                clearInterval(slideShowInterval);

                proposedSlide = $(this).data("slide");
                presentSlideID = $('.is-active').attr('id');

                if(presentSlideID!== "slide-" + proposedSlide){
                    currentSlide = proposedSlide;
                    slideShow(this);
                }
                return false;
            });
            navigationContainer.append($circle);
        }
    };

    var timedShow = function(){
        currentSlide++;
        if (currentSlide >= totalSlides) { // loop around at the end
            currentSlide = 0;
        }
        slideShow($("[data-slide='" + currentSlide + "']"));
    };

    // Only initialise if there are 2 or more items to make a slideshow
    if (totalSlides >= 2) {
        slideNavigation();
        var slideShowInterval;
        slideShowInterval = setInterval(timedShow, 6000);
    }

})(jQuery);

/*
 * jQuery throttle / debounce - v1.1 - 3/7/2010
 * http://benalman.com/projects/jquery-throttle-debounce-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
 (function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);