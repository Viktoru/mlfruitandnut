# Development

## Introduction

1.- The module mlfruitandnut has four folders. You can change this by going to DataTables.js website and download the [latest library version](https://datatables.net/download/).

- Please, find more details here: [see image](https://github.com/Viktoru/mlfruitandnut/blob/master/ScreenShot4.png)

2.- In the folder "assets", I have the subfolders, DataTables and construction.js file.

#### Editing Construction.js file - Disable bPaginate and bLength

- The construction.js file, it is a custom function built for the custom module mlfruitandnut.
You can visit [this website](https://datatables.net/examples/index) for more information. 


```bash
(function($, Drupal) {
  Drupal.AjaxCommands.prototype.customDataTables = function(ajax, response, status){
    // Place content in current-msg div.
    $('#response-result').html(response.content);
    $('#construction-table').DataTable({
	    "searching": false,
		  "bFilter" : false,
		  "bLengthChange": false,
      "ordering": true,
      "columns": [
        null,
        null
        	});
          };
``` 

- You can create your own examples:

```bash
$('#example').dataTable( {
  "lengthChange": false
} );

```

- Disable filtering on the first column:

```bash
$('#example').dataTable( {
  "columns": [
    { "searchable": false },
    null,
    null,
    null,
    null
  ]
} );
```
 - The Construction.js file allows to sort columns. [Image one](ScreenShot5.png) and [Image two](ScreenShot6.png).
 
 
 
 It retrieves the body and title based on the Crop and Cultivar.
 * The src folder, it has a Form and Ajax folder. The Ajax folder has two classes. The DataTablesCommand.php file will return 
or retrieve the #content of the data. In this case the Crop, Cultivar and Description. There is not need to modify this file.
 * The ResetButtonCommand.php file, it will reset the search.
 * The Form folder, I have a Class called Mlfruitandnut_form. It is building a #form by using a ajax return to display the Crops and Cultivars.
   Also, includes several function to return key, crop, cultivar and description for each cultivar. 
   Finally, it return a CSV file to download based on the search by crop and cultivar.

2.- If the developer want to update the config file you need to visit this [Creating a custom content type in D8](https://www.drupal.org/docs/8/api/entity-api/creating-a-custom-content-type-in-drupal-8) for more information. The install file 
    allow to create a Content Types form. 

3.- After the form was created in the Content Types section, you need to consider to upload the data through csv_import module.

4.- You need a format to do that, please visit this link []() for more information.