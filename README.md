# FRUIT AND NUT PROJECT

The custom module called mlfruitandnut search and display dynamically crops and cultivars.

Please find the images to have a view about the module.
Examples: [image one](/ScreenShot1.png), [image two](/ScreenShot2.png) and [image three](/ScreenShot3.png)

## Getting Started

Before you install this custom module you need to install another module called [CSV Import](https://www.drupal.org/project/csv_importer). 

### Dependencies:

- node
- path
- text

### Prerequisites

- Drupal 8.6.x
- PHP 7.1.x
- MySQL or  PostgreSQL
- CSV Import Module [CSV Import](https://www.drupal.org/project/csv_importer) - Downloads 8.x.1.4

### Installing

To install this custom module you just need to copy the module into your Drupal 8 Module folder or custom folder. 
After that go to my Drupal 8 Extend Menu to install the module.

This custom module works with a content type form already created.
After you install this module, it will create a Content Types called Main Lab Fruit and Nut.

### Developers

1.- The module mlfruitandnut has three folders if a developer want to contribute to this project.
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




## Running the tests

To run a test you need to install the mlfruitandnut module. Next, add data into your content type form. Then you can search on your domainname.com/mainlab_list to see your Overview data.

## Built With

* [DataTable](https://datatables.net/) - Add advanced interaction controls to your HTL tables.
* [CodyHouse](https://codyhouse.co/) - The web framework used
* [Collapsible](https://github.com/Viktoru/Overview/tree/master/mainlab_list/assets/css) - Local by Victor
* [Bootstrap](https://getbootstrap.com/docs/3.4/) - Used to generate theme
* [PHP 7.1.x](http://php.net/) - PHP version

## Contributing

Please read [CONTRIBUTING.md](https://github.com/Viktoru/) for details.

## Authors

* **Victor P Unda** - [Victor](https://github.com/Viktoru/)

## License

This project is licensed under the WSU Main Lab - see the [Main Website](http://www.bioinfo.wsu.edu) for details.
