<?php
/**
 * Created by PhpStorm.
 * User: victor.unda
 * Date: 9/26/18
 * Time: 9:19 AM
 */

namespace Drupal\mlfruitandnut\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\node\Plugin\EntityReferenceSelection;
use Drupal\node\Entity;
use Drupal\node\Entity\Node;
use Drupal\mlfruitandnut\Ajax\DataTablesCommand;
use Drupal\mlfruitandnut\Ajax\ResetButtonCommand;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class Mlfruitandnut_form
 *
 * @package Drupal\mlfruitandnut\Form
 */
class Mlfruitandnut_form extends FormBase {

  public function getFormId() {
    return 'mlfruitandnut_search'; // pbcc_search
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    /**
     * Running the library drupal core ajax
     */
    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $form['#attached']['library'][] = 'mlfruitandnut/datatables';

    /**
     * $selected from the mlfruitandnut_crop getValue from the $form mlfruitandnut_crop.
     */
    $options_first = $this->getCrop();
    $selected = ($form_state->getValue('mlfruitandnutcrop') != NULL) ? $form_state->getValue('mlfruitandnutcrop') : '';
    /**
     * $form select mlfruitandnut_crop
     * Also return ajax callback ::promptCallbackCrop
     */
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

    /**
     * action form and callback, wrapper
     */
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Search'),

      '#ajax' => [ // Ajax callback
        'callback' => '::promptCallbackSearch',
        // callback function promptCallback
        'wrapper' => 'search-result1',
        'effect' => 'fade',
        'progress' => [
          'type' => 'throbber',
          // Message to show along progress graphic. Default: 'Please wait...'.
          'message' => NULL,
        ],
      ],

      '#suffix' => '',

    ];

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

    /**
     * Displaying Record Not Found or Record Found
     */
    $form['#prefix'] = '<div id="search-result1"></div><p></p>';
    $form['#prefix'] = '<div id="search-result_title"></div>';

    return $form;
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {


  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $formState
   *
   * @return mixed
   */
  public function promptCallbackCrop(array &$form, FormStateInterface $formState) {

    return $form['mlfruitandnut_title'];
  }

  public function promptCallbackReset(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $response->addCommand(new ResetButtonCommand('test'));
    return $response;
  }

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


  public function promptCallbackSearch(array &$form, FormStateInterface $form_state) {
    /**
     * $form_state - errors, returns the form with errors and messages.
     */
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

      $query->condition('type', 'mlfruitandnut');
//      $query->pager(20);
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
        //  $content = "<div class='container'>";
        $content = "<h2></h2>";
        $now = new DrupalDateTime('now');
        $file_name = 'searchresult'.strtotime($now).'.csv';
        $file_path = 'public://csvtemp/';
        file_prepare_directory($file_path, FILE_CREATE_DIRECTORY);
        $fp = fopen('public://csvtemp/'.$file_name, 'w');
        $content .= "<div class='table-responsive'><a class='btn' style='float:right;' target='_blank' href='".'/sites/default/files/csvtemp/'.$file_name."'>CSV</a><table id='construction-table' data-page-length='10' class='display'><thead><tr><th>CULTIVAR NAME</th><th>DESCRIPTION</th></tr></thead><tbody>";
        $csv = array();
//        $csv[] = array('id','field_mlfruitandnut_crop','field_mlfruitandnut_cultivar','title','field_mlfruitandnut_origin','field_mlfruitandnut_fruit','field_mlfruitandnut_tree','body');
        $csv[] = array('id','field_mlfruitandnut_cultivar','body');
        $id = 1;
        foreach ($entity as $k) {
          $node = \Drupal\node\Entity\Node::load($k);
          $content .= '<tr><td style="width:15%">' . $node->getTitle() . '</td>';
          $content .= '<td class="dt-body-justify" style="width:40%">' . $node->body->value . '</td>';
       //   $content .= '<td class="dt-body-justify">' . $node->get('field_mlfruitandnut_origin')->value . '</td>';
        //  $content .= '<td class="dt-body-justify">' . $node->get('field_mlfruitandnut_fruit')->value . '</td>';
          //   $content .= '<td class="dt-body-justify">' . $node->get('field_mlfruitandnut_tree')->value . '</td></tr>';
        //  $csv[] = array($id,$node->get('field_mlfruitandnut_crop')->value,$node->get('field_mlfruitandnut_cultivar')->value,$node->get('title')->value,$node->get('field_mlfruitandnut_origin')->value,$node->get('field_mlfruitandnut_fruit')->value,$node->get('field_mlfruitandnut_tree')->value,strip_tags(trim($node->body->value)));
          $csv[] = array($id,$node->get('field_mlfruitandnut_cultivar')->value,strip_tags(trim($node->body->value)));
          $id++;
        }

        foreach ($csv as $fields) {
          fputcsv($fp, $fields);
        }
        fclose($fp);
        $content .= "</tbody></table></div>";
        //         $response->addCommand(new HtmlCommand('#response-result', $content, $entity));
        $response->addCommand(new DataTablesCommand($content));
      }
      return $response;
    }
  }

  /**
   * @return array
   * Need to changed, write a query to call all the values from the nodes. Drupal API.
   */
  protected function getCrop() {
    $connection = \Drupal::database();
    $query = $connection->select('node__field_mlfruitandnut_crop','n');
    $query->condition('n.bundle','mlfruitandnut');
    $query->fields('n');
    $nodes = $query->execute();
    $options = array();
    foreach ($nodes as $node) {
      $options[$node->field_mlfruitandnut_crop_value] = $node->field_mlfruitandnut_crop_value;
    }
    return $options;

  }

  protected function getTitle() {
    $query = \Drupal::entityQuery('node');
    $query->condition('status',1);
    $query->condition('type','mlfruitandnut');
    $entity = $query->execute();
    $options = array();
    foreach ($entity as $n) {
      $node = \Drupal\node\Entity\Node::load($n);
      $options[$node->id()] = $node->getTitle();
    }
    return $options;

  }
}