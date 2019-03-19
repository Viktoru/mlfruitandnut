# FRUIT AND NUT PROJECT

The custom module mlfruitandnut search and display dynamically crops and cultivars.

Please find the images to have a view about the module.
Examples: [image one](/ScreenShot1.png), [image two](/ScreenShot2.png) and [image three](/ScreenShot3.png)

## Getting Started

After you install this custom module you need to add the field "link_the_site". This field allows to connect the module
Overview. Go to your Content Types, select "Main Lab Fruit and Nut". Click on Manage Fields and Add field called "field_link_the_site".
Make sure is exactly the same name. Otherwise, it will return an error after you install the module Overview.

Note: In the future you can create a Custom Content Type by creating a YAML file that contain all the required configuration.
For more details go to the mlfruitandnut>config>install folders for examples.

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

To install mlfruitandnut module you just need to copy the module into your Drupal 8 Module folder or custom folder. 
After that go to my Drupal 8 Extend Menu to install the module.

After you install this module, it will create a Content Types called Main Lab Fruit and Nut.
Also, it will create a page called "mainlab_list:. If you domain is domainName.com/mainlab_list. Add /mainlab_list after your domainname of your hosting.

### Developers

For information on the installation and development of mlfruitandnut module, please take a look at [doc/development.md](https://github.com/Viktoru/mlfruitandnut/blob/master/mlfruitandnut/docs/development.md)

## Running the tests

To run a test you need to install the mlfruitandnut module. Next, add data into your content type form. Then you can search on your domainname.com/mainlab_list to see your Overview data.

## Built With

* [DataTable](https://datatables.net/) - Add advanced interaction controls to your HTML Tables.
* [CodyHouse](https://codyhouse.co/) - The web framework used.
* [Collapsible](https://github.com/Viktoru/Overview/tree/master/mainlab_list/assets/css) - Local by Victor.
* [Bootstrap](https://getbootstrap.com/docs/3.4/) - Used to generate theme.
* [PHP 7.1.x](http://php.net/) - PHP version.

## Contributing

Please read [CONTRIBUTING.md](https://github.com/Viktoru/) for details.

## Authors

* **Victor P Unda** - [Victor](https://github.com/Viktoru/)

## License

This project is licensed under the WSU Main Lab - see the [Main Website](http://www.bioinfo.wsu.edu) for details.
