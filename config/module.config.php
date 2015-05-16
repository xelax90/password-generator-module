<?php
namespace XelaxPasswordGeneratorModule;

return array(
    'service_manager' => array(
		'factories' => array(
			'XelaxPasswordGeneratorModule\PluginManager' => 'XelaxPasswordGeneratorModule\Service\PluginManagerFactory',
			'XelaxPasswordGeneratorModule\Options\Generator' => function ($sm) {
                $config = $sm->get('Config');
                return new Options\GeneratorOptions(isset($config['xelax_pw_gen']) ? $config['xelax_pw_gen'] : array());
            },
			'XelaxPasswordGenerator\Default' => function($sm){
				/* @var $pm XelaxPasswordGeneratorModule\PluginManager\PluginManager */
				$pm = $sm->get('XelaxPasswordGeneratorModule\PluginManager');
				/* @var $config XelaxPasswordGeneratorModule\Options\GeneratorOptions */
				$config = $sm->get('XelaxPasswordGeneratorModule\Options\Generator');
				if($pm->has($config->getDefaultGenerator())){
					return $pm->get($config->getDefaultGenerator());
				}
				return null;
			}
		),
    ),
);