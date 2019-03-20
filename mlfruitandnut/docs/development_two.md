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
 
 This file "field.field.node.mlfruitandnut.body.yml" - adding the field to our content type.
 
  ```batch
  
  langcode: en
  status: true
  dependencies:
      config:
          - field.storage.node.body
          - node.type.mlfruitandnut
      module:
          - text
  id: node.mlfruitandnut.body
  field_name: body
  entity_type: node
  bundle: mlfruitandnut
  label: Body
  description: 'More specific information about the mlfruitandnut.'
  required: false
  translatable: true
  default_value: {  }
  default_value_callback: ''
  settings:
      display_summary: true
  field_type: text_with_summary
  
  ```