
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
	var koos = {
		loadVals: function()
		{
			var shortcode = $('#_koo_shortcode').text(),
				uShortcode = shortcode;
			
			// fill in the gaps eg {{param}}
			$('.koo-input').each(function() {
				var input = $(this),
					id = input.attr('id'),
					id = id.replace('koo_', ''),		// gets rid of the koo_ prefix
					re = new RegExp("{{"+id+"}}","g");
					
				uShortcode = uShortcode.replace(re, input.val());
			});
			
			// adds the filled-in shortcode as hidden input
			$('#_koo_ushortcode').remove();
			$('#koo-sc-form-table').prepend('<div id="_koo_ushortcode" class="hidden">' + uShortcode + '</div>');
		},
		cLoadVals: function()
		{
			var shortcode = $('#_koo_cshortcode').text(),
				pShortcode = '';
				shortcodes = '';
			
			// fill in the gaps eg {{param}}
			$('.child-clone-row').each(function() {
				var row = $(this),
					rShortcode = shortcode;
				
				$('.koo-cinput', this).each(function() {
					var input = $(this),
						id = input.attr('id'),
						id = id.replace('koo_', '')		// gets rid of the koo_ prefix
						re = new RegExp("{{"+id+"}}","g");
						
					rShortcode = rShortcode.replace(re, input.val());
				});
		
				shortcodes = shortcodes + rShortcode + "\n";
			});
			
			// adds the filled-in shortcode as hidden input
			$('#_koo_cshortcodes').remove();
			$('.child-clone-rows').prepend('<div id="_koo_cshortcodes" class="hidden">' + shortcodes + '</div>');
			
			// add to parent shortcode
			this.loadVals();
			pShortcode = $('#_koo_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
			
			// add updated parent shortcode
			$('#_koo_ushortcode').remove();
			$('#koo-sc-form-table').prepend('<div id="_koo_ushortcode" class="hidden">' + pShortcode + '</div>');
		},
		children: function()
		{
			// assign the cloning plugin
			$('.child-clone-rows').appendo({
				subSelect: '> div.child-clone-row:last-child',
				allowDelete: false,
				focusFirst: false
			});
			
			// remove button
			$('.child-clone-row-remove').live('click', function() {
				var	btn = $(this),
					row = btn.parent();
				
				if( $('.child-clone-row').size() > 1 )
				{
					row.remove();
				}
				else
				{
					alert('You need a minimum of one row');
				}
				
				return false;
			});
			
			// assign jUI sortable
			$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
		},
		resizeTB: function()
		{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				kooPopup = $('#koo-popup');

			tbWindow.css({
				height: kooPopup.outerHeight() + 50,
				width: kooPopup.outerWidth(),
				marginLeft: -(kooPopup.outerWidth()/2)
			});

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: (tbWindow.outerHeight()-47),
				overflow: 'auto', // IMPORTANT
				width: kooPopup.outerWidth()
			});
			
			$('#koo-popup').addClass('no_preview');
		},
		load: function()
		{
			var	koos = this,
				popup = $('#koo-popup'),
				form = $('#koo-sc-form', popup),
				shortcode = $('#_koo_shortcode', form).text(),
				popupType = $('#_koo_popup', form).text(),
				uShortcode = '';
			
			// resize TB
			koos.resizeTB();
			$(window).resize(function() { koos.resizeTB() });
			
			// initialise
			koos.loadVals();
			koos.children();
			koos.cLoadVals();
			
			// update on children value change
			$('.koo-cinput', form).live('change', function() {
				koos.cLoadVals();
			});
			
			// update on value change
			$('.koo-input', form).change(function() {
				koos.loadVals();
			});
			
			// when insert is clicked
			$('.koo-insert', form).click(function() {    		 			
				if(parent.tinymce)
				{                
					parent.tinymce.activeEditor.execCommand('mceInsertContent',false,$('#_koo_ushortcode', form).html());
					tb_remove();
				}
			});
		}
	}
	
	// run
	$('#koo-popup').livequery( function() { koos.load(); } );
});