<?php

namespace Drupal\mymodule;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider;

/**
 * Provides HTML routes for the message entity type.
 */
class MessageHtmlRouteProvider extends DefaultHtmlRouteProvider {

  /**
   * {@inheritdoc}
   */
  protected function getCanonicalRoute(EntityTypeInterface $entity_type) {
    // Messages use the edit-form route as the canonical route.
    // @todo Remove this when #2479377 gets fixed.
    return $this->getEditFormRoute($entity_type);
  }

}
