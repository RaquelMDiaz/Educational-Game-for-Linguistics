// plug-in for displaying a pop-up window
/*taken from the VLC - Class "Web Development" Summer Term 2014*/

/* This plug-in is based on the following sources:
http://swip.codylindley.com/popupWindowDemo.html
http://learn.jquery.com/plugins/basic-plugin-creation/ */
/* $() is a common alias for the jQuery() function, but it
may have been re-defined outside the plug-in. For the
plug-in to work, the $ alias has to be protected. This is
done by putting the anonymous function below as a wrapper
around the entire plug-in code. Its only argument is '$',
the alias to be protected. At the end of the plug-in code,
the function jQuery() is passed as an argument to the wrapper
function (i.e. the wrapper function is declared and invoked in
one statement), so $() remains an alias of jQuery() inside the plug-in. */
(function ($) {
	/* To define a new method for jQuery, it has to be added to
	$.fn (or jQuery.fn), the prototype for all jQuery objects.
	Here, the method '.my_popup()' is added that opens a new
	pop-up window when the user clicks on one of the elements
	in the jQuery selection on which .my_popup() is called. Its
	argument 'my_settings' is an object whose properties specify
	the settings for the pop-up window. That object typically will
	be defined as an "object literal" in the argument slot of
	.my_popup() when the method is called. The object literal is
	enclosed between { and } and consists of a comma-separated
	list of "attribute_name: value" pairs. */
	$.fn.my_popup = function(my_settings) {
	/* .my_popup() will be called on a jQuery object that represents a
	whole collection of selected DOM elements. Since the event handler
	.click() below will have to be defined for each of those elements,
	.my_popup() has to loop through all elements in the jQuery object.
	To this end, the .each() method is called on the current object
	(represented by the keyword 'this'). After the loop is complete,
	the 'this' object is returned by .my_popup(). This is necessary,
	because .my_popup() has to return a jQuery object if it is to
	be used in a chain of method calls. */
		return this.each(function() {
		/* The code inside function() below is executed when the user clicks
		on one of the elements in the selection on which .my_popup()
		is called. */
			$(this).click(function() {
			/* 'popup_settings' is an object representing the settings for the
			pop-up window. It is created by merging the set of default values
			(given as an object literal) with the argument object 'my_settings',
			using the .extend() method. */
				var popup_settings = $.extend({
					// Default values:
					height: 200, // Window height in pixels
					width: 400, // Window width in pixels
					left: 50, // Initial horizontal distance from the top left corner of the screen
					top: 50, // Initial vertical distance from the top left corner of the screen
					location: 0, // Address bar (0 = no, 1 = yes)
					menubar: 0, // Menu bar (0 = no, 1 = yes)
					resizable: 0, // Is it possible to resize the window (0 = no, 1 = yes)?
					scrollbars: 0, // Does the window have scroll bars (0 = no, 1 = yes)?
					status: 0, // Display a status bar a the bottom (0 = no, 1 = yes)?
					toolbar: 0, // Display the tool bar (0 = no, 1 = yes)?
					name: null, // The name of the window
					url: '' // The web address of the page to be displayed in the new window
				}, my_settings);
				/* This statement builds a string from the properties of 'popup_settings' that
				describes the features of the pop-up window. */
				var popup_features = 'height=' + popup_settings.height
				+ ',width=' + popup_settings.width
				+ ',left=' + popup_settings.left
				+ ',top=' + popup_settings.top
				+ ',location=' + popup_settings.location
				+ ',menuBar=' + popup_settings.menubar
				+ ',resizable=' + popup_settings.resizable
				+ ',scrollbars=' + popup_settings.scrollbars
				+ ',status=' + popup_settings.status
				+ ',toolbar=' + popup_settings.toolbar;
				// This code opens the pop-up window, using a native JavaScript method of the window object:
				window.open(popup_settings.url, popup_settings.name, popup_features);
			});
		});
	};
}(jQuery));