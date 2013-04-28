/* Reactor 1.0.0 - Anthony Wilhelm - http://awtheme.com/reactor/ */
( function($) {

  $(document).ready( function() {
	
    /* adds .button class to submit button on comment form */
    $('#commentform input#submit').addClass('button').addClass('small');
  
    /* adjust site for fixed top-bar with wp admin bar */
    if($('body').hasClass('admin-bar')) {
		if($('body').hasClass('has-top-bar')) {
	    	$('.top-bar').parent().css('top', "+=28");
		}
		if($('.top-bar').parent().hasClass('fixed')) {
			$('body').css('padding-top', "+=28");
		}
    }

	/* prevent default if menu links are # */
	$('nav a').each(function() {
		var nav = $(this); 
		if(nav.attr('href') == '#') {
			$(this).on('click', function(e){ 
				e.preventDefault();
			});
		}
	});

	/* Portfolio Sorting using QuickSand - http://razorjack.net/quicksand/ */
	if (jQuery().quicksand) {
		(function($) {
			$.fn.sorted = function(customOptions) {
				var options = {
					reversed: false,
					by: function(a) {
						return a.text();
					}
				};
				
				$.extend(options, customOptions);

				$data = $(this);
				arr = $data.get();
				arr.sort(function(a, b) {
		
					var valA = options.by($(a));
					var valB = options.by($(b));
			
					if (options.reversed) {
						return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
					} else {		
						return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
					}
				});
				return $(arr);
			};
		})(jQuery);
		
		$(function() {
			var read_button = function(class_names) {
				
				var r = {
					selected: false,
					type: 0
				};
				
				for (var i=0; i < class_names.length; i++) {
					if (class_names[i].indexOf('selected-') == 0) {
						r.selected = true;
					}
					if (class_names[i].indexOf('segment-') == 0) {
						r.segment = class_names[i].split('-')[1];
					}
				};
				return r;
			};
		
			var determine_sort = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
		
			var determine_kind = function($buttons) {
				var $selected = $buttons.parent().filter('[class*="selected-"]');
				return $selected.find('a').attr('data-value');
			};
			
			/* QuickSand Settings */
			var $preferences = {

			}
		
			var $list = $('.filterable-grid');
			var $data = $list.clone();
		
			var $controls = $('.filter');
		
			$controls.each(function(i) {
		
				var $control = $(this);
				var $buttons = $control.find('a');
		
				$buttons.on('click', function(e) {
				
					e.preventDefault();
				
					var $button = $(this);
					var $button_container = $button.parent();
					
					var button_properties = read_button($button_container.attr('class').split(' '));      
					var selected = button_properties.selected;
					var button_segment = button_properties.segment;
		
					if (!selected) {
		
						$buttons.parent().removeClass('active').removeClass(function (index, css) {
							return (css.match (/\bselected-\S+/g) || []).join(' ');
						});
						$button_container.addClass('selected-' + button_segment).addClass('active');
		
						var sorting_type = determine_sort($controls.eq(1).find('a'));
						var sorting_kind = determine_kind($controls.eq(0).find('a'));

						if (sorting_kind == 'all') {
							var $filtered_data = $data.find('li');
						} else {
							var $filtered_data = $data.find('li.' + sorting_kind);
						}
		
						var $sorted_data = $filtered_data.sorted({
							reversed: true,
							by: function(v) {
								return parseInt($(v).attr('data-id'));
							}
						});
						
						$list.quicksand($sorted_data, $preferences);
						console.log($sorted_data);
					}

				});
			}); 
		});
	}
	
  }); /* end $(document).ready */

	/* Off Canvas - http://www.zurb.com/playground/off-canvas-layouts */
	events = 'click.fndtn';
	var $selector = $('#mobileMenuButton');
	if ($selector.length > 0) {
		$('#mobileMenuButton').on(events, function(e) {
			e.preventDefault();
			$('body').toggleClass('active');
		});
	}
	
	/* Initialize Foundation Scripts */
	$(document)
		.foundation()
		.foundation('topbar', 'off')
		.foundation('topbar', {stickyClass: 'sticky-top-bar'});
	

})( jQuery );	