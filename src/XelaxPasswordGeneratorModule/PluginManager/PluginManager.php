<?php

/*
 * Copyright (C) 2015 schurix
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace XelaxPasswordGeneratorModule\PluginManager;

use Zend\ServiceManager\AbstractPluginManager;
use Hackzilla\PasswordGenerator\Generator\PasswordGeneratorInterface;

use Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;
use XelaxPasswordGeneratorModule\Options\GeneratorOptions;
/**
 * Plugin manager for different password generators
 */
class PluginManager extends AbstractPluginManager{
	const GENERATOR_HUMAN    = HumanPasswordGenerator::class;
	const GENERATOR_COMPUTER = ComputerPasswordGenerator::class;
	const GENERATOR_HYBRID   = HybridPasswordGenerator::class;
	
	public function __construct($configOrContainerInstance = null, array $v3config = array()) {
		parent::__construct($configOrContainerInstance, $v3config);
		$this->initServices();
	}
	
	protected function initServices() {
		$this->setInvokableClass(self::GENERATOR_HUMAN, self::GENERATOR_HUMAN);
		$this->setInvokableClass(self::GENERATOR_HYBRID, self::GENERATOR_HYBRID);
		$this->setInvokableClass(self::GENERATOR_COMPUTER , self::GENERATOR_COMPUTER);
		
		$this->addInitializer(function(PasswordGeneratorInterface $instance, PluginManager $pm){
			/* @var $options GeneratorOptions */
			$generatorOptions = $pm->getServiceLocator()->get(GeneratorOptions::class);

			$options = array();
			if(isset($generatorOptions->getGeneratorOptions()[get_class($instance)])) {
				$options = $generatorOptions->getGeneratorOptions()[get_class($instance)];
			}
			
			if(!empty($options['options'])){
				foreach($options['options'] as $key => $value){
					$instance->setOptionValue($key, $value);
				}
			}
			
			if(!empty($options['parameters'])){
				foreach($options['parameters'] as $key => $value){
					$instance->setParameter($key, $value);
				}
			}
		});
	}
	
	public function validatePlugin($plugin)
	{
		if ($plugin instanceof PasswordGeneratorInterface) {
			return;
		}

		throw new \InvalidArgumentException(sprintf(
			'Plugin of type %s is invalid; must implement %s',
			(is_object($plugin) ? get_class($plugin) : gettype($plugin)),
			PasswordGeneratorInterface::class
		));
	}
}
