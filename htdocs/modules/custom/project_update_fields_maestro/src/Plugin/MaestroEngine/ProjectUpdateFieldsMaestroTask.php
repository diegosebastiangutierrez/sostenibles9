<?php

namespace Drupal\project_update_fields_maestro\Plugin\MaestroEngine;

use Drupal\maestro\Engine\MaestroEngineTaskPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * ProjectUpdateFieldsMaestro task.
 *
 * @MaestroTask(
 *   id = "project_update_fields_maestro",
 *   label = @Translation("Project Update Fields Maestro Task"),
 *   category = @Translation("Custom"),
 * )
 */
class ProjectUpdateFieldsMaestroTask extends MaestroEngineTaskPluginBase {

  /**
   * {@inheritdoc}
   */
  public function execute() {
    // Get the current process task.
    $queue = $this->getQueue();

    // Load the project node.
    $project = Node::load($queue->entity_id);

    // Load step_one node.
    $step_one = Node::load($queue->variables['step_one_content']);

    // Load step_two node.
    $step_two = Node::load($queue->variables['step_two_content']);

    // Get the selected value from project field_type.
    $selected_type = $project->field_project_type->value;

    // Check the selected value from project field_type.
    if ($selected_type == 'triennial') {
      $step_three = Node::load($queue->variables['step_three_content']);
      $step_four = NULL;
    }
    else {
      $step_four = Node::load($queue->variables['step_four_content']);
      $step_three = NULL;
    }

    // Update the project node fields.
    $project->field_module_one = $step_one->id();
    $project->field_module_two = $step_two->id();
    if ($step_three) {
      $project->field_module_three = $step_three->id();
    }
    else {
      $project->field_module_three = $step_four->id();
    }

    // Save the project node.
    $project->save();

    return TRUE;
  }

}
