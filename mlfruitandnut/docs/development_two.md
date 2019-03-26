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
 
 This file "field.field.node.mlfruitandnut.body.yml" - adds the field to our content type.
 
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
  
   This file "core.entity_view_display.node.mlfruitandnut.teaser.yml" - adds the teaser field to our content type & display.
   
```batch
    
    langcode: en
    status: true
    dependencies:
      config:
          - core.entity_view_mode.node.teaser
          - field.field.node.mlfruitandnut.body
          - field.field.node.mlfruitandnut.field_mlfruitandnut_fruit
          - field.field.node.mlfruitandnut.field_mlfruitandnut_cultivar
          - field.field.node.mlfruitandnut.field_mlfruitandnut_origin
          - field.field.node.mlfruitandnut.field_mlfruitandnut_crop
          - field.field.node.mlfruitandnut.field_mlfruitandnut_tree
          - node.type.mlfruitandnut
      module:
          - text
          - user
    id: node.mlfruitandnut.teaser
    targetEntityType: node
    bundle: mlfruitandnut
    mode: teaser
    content:
      body:
        label: hidden
        type: text_summary_or_trimmed
        weight: 1
        settings: {  }
        third_party_settings: {  }
      field_mlfruitandnut_fruit:
        weight: 2
        label: above
        settings:
            trim_length: 1000
        third_party_settings: {  }
        type: string
      field_mlfruitandnut_cultivar:
        weight: 3
        label: above
        settings:
            trim_length: 1000
        third_party_settings: {  }
        type: string
      field_mlfruitandnut_origin:
        weight: 4
        label: above
        settings:
            trim_length: 1000
        third_party_settings: {  }
        type: string
      field_mlfruitandnut_crop:
        type: list_default
        weight: 5
        region: content
        label: above
        settings: {}
        third_party_settings: {  }
      field_mlfruitandnut_tree:
        weight: 6
        label: above
        settings:
            trim_length: 1000
        third_party_settings: {  }
        type: string
      links:
        weight: 100
    hidden: { }
    
```

This file "core.entity_view_display.node.mlfruitandnut.default.yml" - adds the field to our content type & affects how the content type should display in default.

```batch

langcode: en
status: true
dependencies:
  config:
      - field.field.node.mlfruitandnut.body
      - field.field.node.mlfruitandnut.field_mlfruitandnut_fruit
      - field.field.node.mlfruitandnut.field_mlfruitandnut_cultivar
      - field.field.node.mlfruitandnut.field_mlfruitandnut_origin
      - field.field.node.mlfruitandnut.field_mlfruitandnut_crop
      - field.field.node.mlfruitandnut.field_mlfruitandnut_tree
      - node.type.mlfruitandnut
  module:
      - text
      - user
id: node.mlfruitandnut.default
targetEntityType: node
bundle: mlfruitandnut
mode: default
content:
  body:
    label: hidden
    type: text_default
    weight: 1
    settings: {  }
    third_party_settings: {  }
  field_mlfruitandnut_fruit:
    weight: 2
    label: above
    settings:
        trim_length: 1000
    third_party_settings: {  }
    type: string
  field_mlfruitandnut_cultivar:
    weight: 3
    label: above
    settings:
        trim_length: 1000
    third_party_settings: {  }
    type: string
  field_mlfruitandnut_origin:
    weight: 4
    label: above
    settings:
        trim_length: 1000
    third_party_settings: {  }
    type: string
  field_mlfruitandnut_crop:
    type: list_default
    weight: 5
    region: content
    label: above
    settings: {}
    third_party_settings: {  }
  field_mlfruitandnut_tree:
    weight: 6
    label: above
    settings:
        trim_length: 1000
    third_party_settings: {  }
    type: string
  links:
    weight: 100
hidden: { }

```

This file "core.entity_form_display.node.mlfruitandnut.default.yml" – adds the field to our content type & affects how the form should display when creating a new node.

```batch

langcode: en
status: true
dependencies:
  config:
      - field.field.node.mlfruitandnut.body
      - field.field.node.mlfruitandnut.field_mlfruitandnut_fruit
      - field.field.node.mlfruitandnut.field_mlfruitandnut_cultivar
      - field.field.node.mlfruitandnut.field_mlfruitandnut_origin
      - field.field.node.mlfruitandnut.field_mlfruitandnut_crop
      - field.field.node.mlfruitandnut.field_mlfruitandnut_tree
      - node.type.mlfruitandnut
  module:
      - text
      - user
id: node.mlfruitandnut.default
targetEntityType: node
bundle: mlfruitandnut
mode: default
content:
  body:
    label: hidden
    type: text_textarea_with_summary
    weight: 1
    settings: {  }
    third_party_settings: {  }
  field_mlfruitandnut_fruit:
    weight: 2
    settings:
      size: 70
      trim_length: 1000
      placeholder: ''
    third_party_settings: {  }
    type: string_textfield
  field_mlfruitandnut_cultivar:
    weight: 3
    settings:
      size: 70
      trim_length: 1000
      placeholder: ''
    third_party_settings: {  }
    type: string_textfield
  field_mlfruitandnut_origin:
    weight: 4
    settings:
      size: 70
      trim_length: 1000
      placeholder: ''
    third_party_settings: {  }
    type: string_textfield
  field_mlfruitandnut_crop:
    type: options_select
    weight: 5
    region: content
    settings: {  }
    third_party_settings: {  }
  field_mlfruitandnut_tree:
    weight: 6
    settings:
      size: 70
      trim_length: 1000
      placeholder: ''
    third_party_settings: {  }
    type: string_textfield
  links:
    weight: 100
hidden: { }

```

For the rest of the fields, you can visit the folders config->install to find more information on how to build them.

```batch
field.field.node.mlfruitandnut.field_mlfruitandnut_crop.yml
field.field.node.mlfruitandnut.field_mlfruitandnut_cultivar.yml
field.field.node.mlfruitandnut.field_mlfruitandnut_fruit.yml
field.field.node.mlfruitandnut.field_mlfruitandnut_origin.yml
field.field.node.mlfruitandnut.field_mlfruitandnut_tree.yml
```

The field "field.storage.node.field_mlfruitandnut_crop.yml" will inform Drupal to create the corresponding field.


```batch
langcode: en
status: true
dependencies:
  module:
    - node
    - options
id: node.field_mlfruitandnut_crop
field_name: field_mlfruitandnut_crop
entity_type: node
type: list_string
settings:
  allowed_values:
    -
      value: Apple
      label: Apple
    -
      value: Acerola/Barbados Cherry
      label: Acerola/Barbados Cherry
  allowed_values_function: ''
module: options
locked: false
cardinality: 1
translatable: true
indexes: {  }
persist_with_no_fields: false
custom_storage: false

```
The field "field.storage.node.field_mlfruitandnut_cultivar.yml" will inform Drupal to create the corresponding field.

```batch

langcode: en
status: true
dependencies:
  module:
    - node
    - text
id: node.field_mlfruitandnut_cultivar
field_name: field_mlfruitandnut_cultivar
entity_type: node
type: text
settings:
    trim_length: 1000
module: text
locked: false
cardinality: 1
translatable: true
indexes: {  }
persist_with_no_fields: false
custom_storage: false

```

The rest of the fields that start with "field.storage.node..." will tell Drupal to create additional fields.

```batch
field.storage.node.field_mlfruitandnut_fruit.yml
field.storage.node.field_mlfruitandnut_origin.yml
field.storage.node.field_mlfruitandnut_tree.yml
```

## Using the UI to export the code for your custom fields

You can also use the UI to export the code: [Visit this site](https://www.drupal.org/docs/8/api/entity-api/using-the-ui-to-export-the-code-for-your-custom-fields).
This project has been created without UI.