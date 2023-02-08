<?php

namespace Drupal\project_update_fields_maestro\Engine;

use Drupal\maestro\Engine\MaestroEngineTaskPluginBase;
use Drupal\maestro\Engine\MaestroEngineTaskAccessControlHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeInterface;
use Drupal\node\Entity\Node;

/**
 * Project update fields Maestro Engine Task Plugin.
 *
 * @MaestroEngineTask(
 *   id = "project_update_fields_maestro",
 *   label = @Translation("Project update fields"),
 *   module = "project_update_fields_maestro"
 * )
 */
class ProjectUpdateFieldsMaestroTask extends MaestroEngineTaskPluginBase implements MaestroEngineTaskAccessControlHandlerInterface {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $taskID = NULL, $templateMachineName = NULL) {
    // Add your form elements here.

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate your form elements here.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Submit your form elements here.
  }

  /**
   * {@inheritdoc}
   */
  public function execute($queueData) {

    // Load the project node.
    $project_node = Node::load($queueData['project']);

    // Load the related nodes.
    $node_id_1 = $queueData['step_one'];
    $node_id_2 = $queueData['step_two'];
    $node_id_3 = $queueData['step_three'];
    $node_id_4 = $queueData['step_four'];
    $node_1 = Node::load($node_id_1);
    $node_2 = Node::load($node_id_2);
    $node_3 = Node::load($node_id_3);
    $node_4 = Node::load($node_id_4);

    // Add the reference fields to the project node.
    $project_node->field_node_1->target_id = $node_id_1;
    $project_node->field_node_2->target_id = $node_id_2;
    $project_node->field_node_3->target_id = $node_id_3;
    $project_node->field_node_4->target_id = $node_id_4;

    // Save the project node.
    $project_node->save();

    // Return the result.
    return [
      'result' => 'success',
      'message' => t('The project node has been updated with reference fields to the 4 other nodes.'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function access($task, $queueData) {
    return TRUE;
  }

}
