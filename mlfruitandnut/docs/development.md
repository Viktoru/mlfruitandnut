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
 - The Construction.js file allows to sort columns. [Image one](https://github.com/Viktoru/mlfruitandnut/blob/master/ScreenShot5.png) and [Image two](https://github.com/Viktoru/mlfruitandnut/blob/master/ScreenShot6.png).
 
 - In the src folder, under the folder Ajax the DataTablesCommand.php Class file allows to pass AjaxResponse objects "#content".
   In this case, the Crops, Cultivars and Descriptions. There is not need to modify this file. For more information visit [Drupal API](https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Ajax%21RestripeCommand.php/class/RestripeCommand/8.0.x).
 
 - Also, I have a Class ResetButtonCommand.php file. It is the same concept from the DataTablesCommand.php file. However, pass AjaxResponse object to render "resetButtonCommand".
 
 
 
  
 
 called Mlfruitandnut_form. It is building a #form by using a ajax return to display the Crops and Cultivars.
   Also, includes several function to return key, crop, cultivar and description for each cultivar. 
   Finally, it return a CSV file to download based on the search by crop and cultivar.

2.- If the developer want to update the config file you need to visit this [Creating a custom content type in D8](https://www.drupal.org/docs/8/api/entity-api/creating-a-custom-content-type-in-drupal-8) for more information. The install file 
    allow to create a Content Types form. 

3.- After the form was created in the Content Types section, you need to consider to upload the data through csv_import module.

4.- You need a format to do that, please visit this link []() for more information.