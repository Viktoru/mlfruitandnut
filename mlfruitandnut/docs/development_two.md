# Creating a custom content type in Drupal 8

 ## Creating the custom content type
 
 This "node.type.mlfruitandnut.yml" YAML file will tell Drupal to create a new content type.
 
 ```batch
 
 langcode: en
 status: true
 dependencies:
   enforced:
     module:
       - mlfruitandnut
 name: 'Main Lab Fruit and Nut'
 type: mlfruitandnut
 description: 'Content type that can be used to provide additional information on <em>mlfruitandnut</em>'
 help: ''
 new_revision: false
 preview_mode: 1
 display_submitted: true
 
 ```