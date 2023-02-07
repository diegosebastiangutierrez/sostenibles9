<?php

namespace Drupal\project_update_fields_maestro;

/**
 * Defines the interface for the Project Update Fields Maestro plugin.
 */
interface ProjectUpdateFieldsMaestroInterface {

  /**
   * Updates the fields of the project node.
   *
   * @param int $project_nid
   *   The node ID of the project node.
   * @param int $step_one_nid
   *   The node ID of the step one node.
   * @param int $step_two_nid
   *   The node ID of the step two node.
   * @param int $step_three_or_four_nid
   *   The node ID of the step three or step four node.
   */
  public function updateFields($project_nid, $step_one_nid, $step_two_nid, $step_three_or_four_nid);

}
