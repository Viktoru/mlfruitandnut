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
 
 
 - Example script, resetButtonCommand
 
 ```bash
 Drupal.AjaxCommands.prototype.resetButtonCommand = function(ajax, response, status){
 	  console.log(response.content);
     jQuery('#mlfruitandnut-search').trigger("reset"); 
     jQuery("select[data-drupal-selector=edit-construction-title] option").prop("selected", function(){ return this.defaultSelected; }); 
     jQuery("#response-result").html("");
     $("select[data-drupal-selector=edit-mlfruitandnut-title]").html("");
     return false;
   };
 
 ```
  
 - Putting the script all together, construction.js file.
 
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
           ]
 	});
   };
   Drupal.AjaxCommands.prototype.resetButtonCommand = function(ajax, response, status){
 	  console.log(response.content);
     jQuery('#mlfruitandnut-search').trigger("reset"); 
     jQuery("select[data-drupal-selector=edit-construction-title] option").prop("selected", function(){ return this.defaultSelected; }); 
     jQuery("#response-result").html("");
     $("select[data-drupal-selector=edit-mlfruitandnut-title]").html("");
     return false;
   };
 })(jQuery, Drupal);
 ```
 
 
3.- How #form works?

- Create a pulldown menu to select a Crop. It is a Ajax callback named "::promptCallbackCrop".

```bash

    $form['mlfruitandnutcrop'] = [
      '#title' => $this->t('Select Crop Category'),
      '#type' => 'select',
      '#options' => $options_first,
      '#default_value' => $selected,
      '#empty_option' => $this->t('- Select a Crop -'),
      '#sort_order' => 'asc',
      '#required' => TRUE,

      '#ajax' => [ // Ajax callback
        'callback' => '::promptCallbackCrop',
        'wrapper' => 'activity-replace',
        'effect' => 'fade',
        'event' => 'change',
        'progress' => [
          'type' => 'throbber',
          // Message to show along progress graphic. Default: 'Please wait...'.
          'message' => NULL,
        ],
      ],
    ];

```

 - ::promptCallbackCrop Script function: Returning Crops.
 
 ```bash
 /**
    * @param array $form
    * @param \Drupal\Core\Form\FormStateInterface $formState
    *
    * @return mixed
    */
   public function promptCallbackCrop(array &$form, FormStateInterface $formState) {
 
     return $form['mlfruitandnut_title'];
   }
 
 ```
 
 - After a user select a Crop. Next, it will display two options from the function __get_activity_options, "All Cultivars" title option and
 a Cultivar list based what Crop was selected. 
 
 ```bash
  
     $form['mlfruitandnut_title'] = [
        '#type' => 'select',
        '#title' => $this->t('Select Cultivar'),
        '#options' => $this->__get_activity_options($selected),
        '#default_value' => array(),
        '#multiple' => true,
        '#description' => t('First, select a CROP.'),
        '#prefix' => '<div id="activity-replace">',
        '#suffix' => '</div><p></p>',
      ];
      
  ```

 - The $selected variable is getting the value from:  
 
 ```bash
 $selected = ($form_state->getValue('mlfruitandnutcrop') != NULL) ? $form_state->getValue('mlfruitandnutcrop') : ''; 
 ```
 
 - The function __get_activity_options looks like: At here the function is executing $selected to $key.
 
 
 ```bash
 
 /**
    * @param string $key
    *
    * @return array
    */
   public function __get_activity_options($key = '') {
     $options = array();
     if($key) {
       $query = \Drupal::entityQuery('node');
       $query->condition('status', 1);
       $query->sort('title', 'ASC');
       $query->condition('field_mlfruitandnut_crop', $key);
       $query->condition('type', 'mlfruitandnut');
       $entitystate = $query->execute();
       
       if(!empty($entitystate)){
         $options['all'] = $this->t('- All Cultivar -');
         foreach ($entitystate as $k) {
           $node = \Drupal\node\Entity\Node::load($k);
           $options[$node->id()] =  $node->getTitle();
         }
       }
     }
     return $options;
   }
    
  ```
 
 - This action, it is a reset button. It has a callback function "::promptCallbackReset".
 
 ```bash
 
 $form['actions']['reset'] = array(
       '#type' => 'submit',
       '#value' => $this->t('Reset'),
       '#ajax' => [ // Ajax callback
         'callback' => '::promptCallbackReset',
         // callback function promptCallback
         'wrapper' => 'activity-replace',
         'effect' => 'fade',
         'progress' => [
           'type' => 'throbber',
           // Message to show along progress graphic. Default: 'Please wait...'.
           'message' => NULL,
         ],
       ],
       '#suffix' => '<div id="response-result"></div><p></p>',
     );
 
 ```
 
 - Callback function promptCallbackReset.
 
 ```bash
 
   public function promptCallbackReset(array &$form, FormStateInterface $form_state) {
     $response = new AjaxResponse();
     $response->addCommand(new ResetButtonCommand('test'));
     return $response;
   }
 
 ```
 
 - The next function called promptCallbackSearch. This function retrieve and display Crops, Cultivars & Description.
 
 + It is getting two values mlfruitandnutcrop & mlfruitandnut_title.
 
  ```bash
  
 if ($form_state->hasAnyErrors()) {
      return $form;
    }
    else {
      /**
       * Search for node_title \Drupal::entityQuery('node');
       */
      $construction_time = $form_state->getValue('mlfruitandnutcrop');
      $construction_title = $form_state->getValue('mlfruitandnut_title');

      $query = \Drupal::entityQuery('node');
      $query->condition('status', 1);
      if($construction_time){
        if($construction_title){
          foreach($construction_title as $k => $i) {
            if($i != 'all') {
              $query->condition('nid', $construction_title,'IN');

            }else {
              $query->condition('field_mlfruitandnut_crop', $construction_time);
            }
          }
        }else{
          $query->condition('field_mlfruitandnut_crop', $construction_time);
        }
      }else{
        if($construction_title) {
          foreach($construction_title as $k => $i) {
            if($i != 'all')
              $query->condition('nid', $construction_title,'IN');
          }
        }
      }
  
  ```
 
 - In this section is displaying a table, Crops, Cultivar & Description. It is creating a CSV file to donwload the record(s).
 
 ```bash
 
       $query->condition('type', 'mlfruitandnut');
       $entity = $query->execute();
 
       $response = new AjaxResponse();
       if (empty($entity)) {
         $content = '<p></p>';
         foreach($form_state->getValue('mlfruitandnut_title') as $k=>$i){
           $content .= $i;
         }
         $content .= '<div class="alert alert-info" role="alert">' . $category_title . ' Record Not Found </div>';
         $response->addCommand(new HtmlCommand('#response-result', $content, $entity));
       }
       else {
         $content = "<h2></h2>";
         $now = new DrupalDateTime('now');
         $file_name = 'searchresult'.strtotime($now).'.csv';
         $file_path = 'public://csvtemp/';
         file_prepare_directory($file_path, FILE_CREATE_DIRECTORY);
         $fp = fopen('public://csvtemp/'.$file_name, 'w');
         $content .= "<div class='table-responsive'><a class='btn' style='float:right;' target='_blank' href='".'/sites/default/files/csvtemp/'.$file_name."'>CSV</a><table id='construction-table' data-page-length='10' class='display'><thead><tr><th>CULTIVAR NAME</th><th>DESCRIPTION</th></tr></thead><tbody>";
         $csv = array();
         $csv[] = array('id','field_mlfruitandnut_cultivar','body');
         $id = 1;
         foreach ($entity as $k) {
           $node = \Drupal\node\Entity\Node::load($k);
           $content .= '<tr><td style="width:15%">' . $node->getTitle() . '</td>';
           $content .= '<td class="dt-body-justify" style="width:40%">' . $node->body->value . '</td>';
           $csv[] = array($id,$node->get('field_mlfruitandnut_cultivar')->value,strip_tags(trim($node->body->value)));
           $id++;
         }
 
         foreach ($csv as $fields) {
           fputcsv($fp, $fields);
         }
         fclose($fp);
         $content .= "</tbody></table></div>";
         $response->addCommand(new DataTablesCommand($content));
       }
       return $response;
     }
 
 ```
 
 
 ## Linking the records
 
 You will see this message [Image 1](https://github.com/Viktoru/mlfruitandnut/blob/master/images/ScreenShot2.png)  to link a cultivar. In this case "Summerdel". 
 
 Message: "Your field is empty. Please, add the correct name to link a Cultivar/s. See Summerdel".
 It means that you need to link with a right cultivar.
 
 ### The next images will shows how to link a cultivar.
 
 A. The [Image 2](https://github.com/Viktoru/mlfruitandnut/blob/master/images/ScreenShot2.png) shows what cultivar to link. 
 
 B. The [Image 3](https://github.com/Viktoru/mlfruitandnut/blob/master/images/ScreenShot3.png) how to link a cultivar, adding the cultivar into a imput form. 
 
 C. The [Image 4](https://github.com/Viktoru/mlfruitandnut/blob/master/images/ScreenShot1.png) shows linked a cultivar.

 