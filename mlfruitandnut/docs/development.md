# Development

## Steps

1.- The module mlfruitandnut has four folders.

-Please, find more details at [see image](https://github.com/Viktoru/mlfruitandnut/blob/master/ScreenShot4.png)

2.- On the folder "assets", I have subfolders, DataTables libraries and construction.js file.

### Step 1

-The construction.js file.

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
        




 * On the folder assets, I have a JavaScript Library called DataTables, for more information see Built With section.
You can modify this file as you witch. 
 * The Construction js file connected to the datatable. It retrieves the body and title based on the Crop and Cultivar.
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