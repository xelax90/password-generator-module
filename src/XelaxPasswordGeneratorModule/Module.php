<?php
namespace XelaxPasswordGeneratorModule;

use Zend\Loader\StandardAutoloader;

class Module {
	public function getConfig() {
		return include __DIR__ . '/../../config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			StandardAutoloader::class => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}
}
