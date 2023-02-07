<?php

namespace Drupal\project_update_fields_maestro\Plugin\MaestroEngine;

use Drupal\Core\Form\FormStateInterface;
use Drupal\maestro\Engine\MaestroEngineTaskPluginBase;

/**
 * ProjectUpdateFieldsMaestro is a task plugin for Maestro Engine that updates the project node's fields after creating the required nodes.
 *
 * @MaestroEngineTaskPlugin(
 *   id = "ProjectUpdateFieldsMaestro",
 *   task_description = @Translation("Update Project Fields Task"),
 * )
 */
class ProjectUpdateFieldsMaestro extends MaestroEngineTaskPluginBase {

  /**
   * {@inheritdoc}
   */
  public function execute() {
    $this->updateProjectFields();
  }

  /**
   * Updates the project node's fields with the node IDs of the created nodes.
   */
  protected function updateProjectFields() {
    // Get the node IDs of the step_one, step_two, step_three, and step_four nodes.
    $step_one_node_id = $this->processVariables->getTaskResult('step_one');
    $step_two_node_id = $this->processVariables->getTaskResult('step_two');
    $step_three_node_id = $this->processVariables->getTaskResult('step_three');
    $step_four_node_id = $this->processVariables->getTaskResult('step_four');

    // Get the project node ID.
    $project_node_id = $this->processVariables->getValue("project");

    \Drupal::logger('project_update_fields_maestro')->error('Project: '.$project_node_id);

    // Load the project node.
    $project_node = \Drupal\node\Entity\Node::load($project_node_id);

    // Get the value of the field_type field on the project node.
    $field_type = $project_node->get('field_project_type')->value;

    // Update the field_module_one field with the step_one node ID.
    $project_node->set('field_module_one', $step_one_node_id);

    // Update the field_module_two field with the step_two node ID.
    $project_node->set('field_module_two', $step_two_node_id);

    // Update the field_module_three field with the step_three or step_four node ID depending on the value of the field_type field.
    if ($field_type == 'triennial') {
      $project_node->set('field_module_three', $step_three_node_id);
    }
    else {
      $project_node->set('field_module_three', $step_four_node_id);
    }

    // Save the project node.
    $project_node->save();
  }

}
