<script type="text/javascript">
	// tinymce.init({
	// 	selector: ".tinyMce", 
	// 	theme: "modern",
	//     plugins: [
	//         "autolink lists link image hr pagebreak",
	//         "wordcount visualblocks",
	//         "insertdatetime save table contextmenu directionality",
	//         "paste textcolor colorpicker textpattern",
	//         "code", 
	//         "textcolor"
	//     ],
	//     toolbar1: "insertfile undo redo | styleselect | bold italic | link image | numlist | bullist | table | code | forecolor | backcolor",
	//     image_advtab: true, 
	//     extended_valid_elements : "iframe[src|width|height|name|align]", 
	//     relative_urls : 0, 
	// 	remove_script_host : 0
	// });
</script>
<script type="text/javascript" src="<?=PLUGINS?>tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
    selector: ".tinyMce",
	plugins: [
		"autolink lists link image hr pagebreak",
		"wordcount visualblocks",
		"insertdatetime save table contextmenu directionality",
		"paste textcolor colorpicker textpattern",
		"code responsivefilemanager media"
	],
	toolbar1: "responsivefilemanager | media | insertfile undo redo | styleselect | bold italic | link image | numlist | bullist | table | code | forecolor | backcolor",
	external_filemanager_path:"<?=PLUGINS?>tinymce/js/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "<?=PLUGINS?>tinymce/js/filemanager/plugin.min.js"},
	image_advtab: true, 
	extended_valid_elements : "iframe[src|width|height|name|align]", 
	relative_urls : 0, 
	remove_script_host : 0
});
</script>