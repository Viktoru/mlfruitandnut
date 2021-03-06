# The Fruit and Nut Cultivars Database (FNCD)

The custom module mlfruitandnut dynamically searches and displays crops and cultivars.

See a glimpse about the module. Open this [video](https://vimeo.com/325511947).

## Getting Started

A. Cloning an Existing Repository  
```bash

git clone https://github.com/Viktoru/mlfruitandnut.git

```
B. Drag and drop the Custom module mlfruitandnut files to your "Custom" folder or "modules" folder.


After you install the module you need to add a field and name it "link_the_site". This field allows you to connect to the module Overview. Go to your Drupal 8 site, and select Content Types named "Main Lab Fruit and Nut". Click on the Manage Fields option, and "Add" a field name "field_link_the_site". Make sure it is exactly the same name.
Otherwise, it will return an error after you install the module Overview.

Note: In the future you can create a Custom Content Type file by creating a YAML file that contains all the required configurations. For more details go to the mlfruitandnut->config->install folders. 
Also, visit [development docs](https://github.com/Viktoru/mlfruitandnut/blob/master/mlfruitandnut/docs/development.md). for more information about this module.


### Dependencies:

- node
- path
- text

### Creating the custom content type

- [View the site](https://github.com/Viktoru/mlfruitandnut/blob/master/mlfruitandnut/docs/development_two.md)


### Prerequisites

- Drupal 8.6.x
- PHP 7.1.x
- MySQL or  PostgreSQL
- CSV Import Module [CSV Import](https://www.drupal.org/project/csv_importer) - Downloads 8.x.1.4

### Installing

To install the mlfruitandnut module you just need to copy the module into your Drupal 8 Module folder or custom folder. After that go to my Drupal 8 Extend Menu to install the module.
After you install this module, it will create a Content Types called Main Lab Fruit and Nut. Also, it will create a page called "mainlab_list:” If your domain is domainName.com/mainlab_list, add /mainlab_list after the domain name of your hosting. If there is no data, it will not show any listing for Crop and Cultivar. You need to upload the data to be able to see it.

### How to upload the data using cvs import module.

* Here is the format of the table for how it should look before uploading the data into the Content Types Main Lab Fruit and Nut.

Id | title | body | field_mlfruitandnut_crop | field_mlfruitandnut_cultivar | field_mlfruitandnut_fruit | field_mlfruitandnut_origin | field_mlfruitandnut_tree | field_link_the_site

* Use the [following Python script](https://github.com/Viktoru/python2.7.10/blob/master/script2.py) to convert a doc document to a csv file. After you convert that file, open it with Excel Application. First, open the Excel Application and select Data from the top Menu. Next, select From Text, and search for your converting file. Follow the instructions and make sure to select “UTF-8” and Delimited. Next, check the box for “Comma”. Finally, leave the columns named as they currently are. Click finished.

* After that add all the fields with the correct names: Id, title, body, and so on. Make sure the data is in the right fields. Please see the image below for more information. 

### How to add Crops to the field_mlfruitandnut_crop field

* Once you are ready to upload the data for a specific Crop and Cultivars, add your Crop name to the field field_mlfruitandnut_crop. Go to your Content Type and click on the List(text). Some examples include:

1. Apple|Apple
2. Abiu|Abiu
3. Acerola/Barbados Cherry|Acerola/Barbados Cherry
4. Almond Rootstock|Almond Rootstock
5. Atemoya|Atemoya
6. Banana/Plantain|Banana/Plantain
7. Beach Plum|Beach Plum
8. Butternut|Butternut
9. Cacao|Cacao
10. Canistel|Canistel
11. Carambola|Carambola

### Developers

For information on the development of mlfruitandnut custom-module, please take a look at [doc/development.md](https://github.com/Viktoru/mlfruitandnut/blob/master/mlfruitandnut/docs/development.md)

## Running the tests

To run a test you need to install the mlfruitandnut module. Next, add your data into your content type named "Main Lab Fruit and Nut". Finally, add the path "/mainlab_list" after your domain-name to see your Overview in action.

## Built With

* [DataTable](https://datatables.net/) - Add advanced interaction controls to your HTML Tables.
* [CodyHouse](https://codyhouse.co/) - The web framework used.
* [Collapsible](https://github.com/Viktoru/Overview/tree/master/mainlab_list/assets/css) - Local by Victor U.
* [Bootstrap](https://getbootstrap.com/docs/3.4/) - Used to generate theme.
* [PHP 7.1.x](http://php.net/) - PHP version.
* [Drupal 8.x](http://www.drupal.org) - Drupal 8.x

## Contributing

Please read [CONTRIBUTING.md](https://github.com/Viktoru/) for details.

## Authors

* **Victor P Unda** - [Victor](https://github.com/Viktoru/)

## License

This project is licensed under the WSU Main Lab - see the [Main Website](http://www.bioinfo.wsu.edu) for details.
