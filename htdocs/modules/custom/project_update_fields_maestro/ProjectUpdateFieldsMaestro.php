<?php

namespace Drupal\project_update_fields_maestro;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Project Update Fields Maestro plugin manager.
 */
class ProjectUpdateFieldsMaestroManager extends DefaultPluginManager {

  /**
   * Constructs a new ProjectUpdateFieldsMaestroManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/ProjectUpdateFieldsMaestro', $namespaces, $module_handler, 'Drupal\project_update_fields_maestro\ProjectUpdateFieldsMaestroInterface', 'Drupal\project_update_fields_maestro\Annotation\ProjectUpdateFieldsMaestro');

    $this->alterInfo('project_update_fields_maestro_info');
    $this->setCacheBackend($cache_backend, 'project_update_fields_maestro_plugins');
  }

}
