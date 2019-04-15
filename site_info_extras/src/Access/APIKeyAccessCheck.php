<?php

namespace Drupal\site_info_extras\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Session\AccountInterface;

/**
 * Checks if API key is valid.
 */
class APIKeyAccessCheck implements AccessInterface {

  /**
   * Current Route.
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  private $currentRoute;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  private $configFactory;

  /**
   * APIKeyAccessCheck constructor.
   */
  public function __construct(CurrentRouteMatch $current_route, ConfigFactory $config_factory) {
    $this->currentRoute = $current_route;
    $this->configFactory = $config_factory;
  }

  /**
   * A custom access check.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Run access checks for this account.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(AccountInterface $account) {
    $saved_api_key = $this->configFactory->get('site_info.extras')->get('site_api_key');
    $route_api_key = $this->currentRoute->getParameter('api_key');
    $node  = $this->currentRoute->getParameter('node');
    return ($route_api_key === $saved_api_key && ($node->getType() == 'page')) 
      ? AccessResult::allowed() : AccessResult::forbidden();
  }

}
