<?php
namespace XelaxPasswordGeneratorModule;

return array(
    'service_manager' => array(
		'factories' => array(
			PluginManager\PluginManager::class => Service\PluginManagerFactory::class,
			Options\GeneratorOptions::class => function ($sm) {
                $config = $sm->get('Config');
                return new Options\GeneratorOptions(isset($config['xelax_pw_gen']) ? $config['xelax_pw_gen'] : array());
            },
			'XelaxPasswordGenerator\Default' => function($sm){
				/* @var $pm PluginManager\PluginManager */
				$pm = $sm->get(PluginManager\PluginManager::class);
				/* @var $config Options\GeneratorOptions */
				$config = $sm->get(Options\GeneratorOptions::class);
				if($pm->has($config->getDefaultGenerator())){
					return $pm->get($config->getDefaultGenerator());
				}
				return null;
			}
		),
		'aliases' => array(
			'XelaxPasswordGeneratorModule\PluginManager' => PluginManager\PluginManager::class,
			'XelaxPasswordGeneratorModule\Options\Generator' => Options\GeneratorOptions::class,
		)
    ),
);