<?php

namespace Drupal\site_info_extras\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller class for providing page nodes as JSON response.
 */		
class PageJsonController extends ControllerBase {

	/**
	 * Route callback for providing page nodes as JSON  response.
	 */
	public function response($api_key, $node) {
		$data = \Drupal::service('serializer')->serialize($node, 'json', ['plugin_id' => 'entity']);
    	return new JsonResponse($data);
	}
}