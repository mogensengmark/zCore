/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.defaultLanguage = 'da';
	config.language = 'da';
	config.uiColor = '#000000';
	config.resize_enabled = false;
	
	// Default toolbar
	config.toolbar = 'pageContent';
	
	//KCfinder integration
    config.filebrowserBrowseUrl = '/kcfinder/browse.php?type=files';
    config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?type=images';
    config.filebrowserFlashBrowseUrl = '/kcfinder/browse.php?type=flash';
    config.filebrowserUploadUrl = '/kcfinder/upload.php?type=files';
    config.filebrowserImageUploadUrl = '/kcfinder/upload.php?type=images';
    config.filebrowserFlashUploadUrl = '/kcfinder/upload.php?type=flash';
	
	
	//config.toolbar = 'Basic';
	/**/
//	config.toolbar = 'pageContent';
//	config.toolbar = 'Full';
/**	
	config.toolbar_pageContent = 
		[
	      ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'],
	      ['Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'],
	      ['NumberedList','BulletedList','Blockquote'],
	      ['Link','Unlink'],
	      ['Image','SpecialChar'],
	      ['Format']
	   ];
**/	
	config.toolbar_Full = 
		[
		    ['Source', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates'],
		   	['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker', 'Scayt'],
		   	['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
		   	['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
		   	'/',
		   	['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
		   	['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
		   	['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
		   	['Link', 'Unlink', 'Anchor'],
		   	['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'],
		   	'/',
		   	['Styles', 'Format', 'Font', 'FontSize'],
		   	['TextColor', 'BGColor'],
		   	['Maximize', 'ShowBlocks', '-', 'About']
    	];
	
	config.toolbar_Minimum = 
		[	
		 	{ name: 'page', items : [ 'Source', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates' ] },
	 		{ name: 'Link', items : [ 'Link', 'Unlink', 'Anchor' ] },
	 		{ name: 'Insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'] }
	 	];
	
	config.toolbar_Hest =
		[
			{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			{ name: 'tools', items : [ 'Maximize','-','About' ] }
		]; 
	

};


