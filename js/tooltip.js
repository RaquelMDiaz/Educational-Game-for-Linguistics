// plug-in for displaying a tooltip
/*taken from the VLC - Class "Web Development" Summer Term 2014*/

// Adapted from code written by Kevin Liew
// Source: http://www.queness.com/post/92/create-a-simple-cssjavascript-tooltip-with-jquery


(function($) { // as $ is used often in js-plugins: have to make sure that it stands for jQuery function here -> immediately invoked function expression, also allows to have own private variables

	// function initializeTooltip: creates tooltip with settings that are passed as argument object
	$.fn.initializeTooltip = function(my_settings) { // $.fn object -> contains all jQuery object methods
		
		var tooltip_settings = $.extend({}, $.fn.initializeTooltip.defaults, my_settings); //extend default options with those provided
		
		/* The tooltip is the value of the title attribute
	    of the current <a>, tag with the class 'tooltip': */
		var my_tooltip = $(this).attr('title');
			
		// The user enters the tooltip -> create tooltip based on settings:
		$(this).mouseover(function(e) { 	
			
			/* Remove the title attribute to prevent it from
			being displayed in addition to the tooltip: */
			$(this).attr('title', '');
			
			/* Append a div with the class 'tooltip_box' that contains
			the tooltip to the current element: */
			$(this).append('<div class="tooltip_box" id="' + tooltip_settings.id + '">' + my_tooltip + '</div>');
			
			/* Set the initial position of the tooltip
			to ..px below and ..px to the right of the current mouse pointer position: */  
			$('#' + tooltip_settings.id).css('top', e.pageY + tooltip_settings.y);
			$('#' + tooltip_settings.id).css('left', e.pageX + tooltip_settings.x);
			
			/*set width, height, colours of the tooltip box*/
			$('#' + tooltip_settings.id).css('width', tooltip_settings.w + 'px');
			$('#' + tooltip_settings.id).css('min-height', tooltip_settings.h + 'px');
			$('#' + tooltip_settings.id).css('background-color', tooltip_settings.bgc);
			$('#' + tooltip_settings.id).css('color', tooltip_settings.fgc);
		
		});
		
		// The user moves the mouse while over the tooltip:
		$(this).mousemove(function(e) {
			
			/* Update the position of the tooltip to the new
			position of the mouse pointer: */
			$('#' + tooltip_settings.id).css('top', e.pageY + tooltip_settings.y);
			$('#' + tooltip_settings.id).css('left', e.pageX + tooltip_settings.x);
		
		});

		// The mouse pointer leaves the tooltip:
		$(this).mouseout(function() {
			
			/* Reset the title attribute to have it available
			 when the tooltip is needed again: */
			$(this).attr('title', my_tooltip);
			
			// Remove the div element with the tooltip:
			$(this).children('div#' + tooltip_settings.id).remove();
			
		});
	};
	
	//default settings: stored in object
	$.fn.initializeTooltip.defaults = { // to accept options: create object literal -> make defaults available for user to change
		id: 'default_tooltip',
		h: 20,
		w: 250,
		bgc: '#ffffcc',
		fgc: '#000',
		x: 20,
		y: 10,
	};

}(jQuery));