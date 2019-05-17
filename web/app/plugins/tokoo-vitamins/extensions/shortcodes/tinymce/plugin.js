// https://github.com/webbudesign/ZillaShortcodeWP3.9/blob/master/plugin.js
(function($) {
	"use strict";
	
	//Shortcodes
	tinymce.PluginManager.add( 'kooShortcodes', function( editor, url ) {

		editor.addCommand("kooPopup", function ( a, params )
		{
			var popup = params.identifier;
			tb_show("Insert Koo Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
		});
		
		editor.addButton( 'koo_button', {
			type: 'splitbutton',
			icon: false,
			title:  'Insert Koo Shortcodes',
			onclick : function(e) {},
			menu: [
				{text: 'Accordions',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Accordions',identifier: 'accordions'})
				}},
				{text: 'Alerts',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Alerts',identifier: 'alert'})
				}},
				{text: 'Buttons',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Buttons',identifier: 'buttons'})
				}},
				{text: 'Box',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Box',identifier: 'box'})
				}},
				{text: 'Columns',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Columns',identifier: 'columns'})
				}},
				{text: 'Highlight',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Highlight',identifier: 'highlight'})
				}},
				{text: 'Tabs',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Tabs',identifier: 'tabs'})
				}},
				// {text: 'Toggle',onclick:function(){
				// 	editor.execCommand("kooPopup", false, {title: 'Toggle',identifier: 'toggle'})
				// }},	
				{text: 'Leading',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Leading',identifier: 'leading'})
				}},	
				{text: 'Dropcap',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Dropcap',identifier: 'dropcap'})
				}},	
				{text: 'Pullquote',onclick:function(){
					editor.execCommand("kooPopup", false, {title: 'Pullquote',identifier: 'pullquote'})
				}},				
				//List your shortcodes like this
			]
			
		});
		
	});
	
	
})(jQuery);