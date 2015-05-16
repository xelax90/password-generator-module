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

use XelaxPasswordGeneratorModule\PluginManager\PluginManager;
use Hackzilla\PasswordGenerator\Generator;

$generatorOptions = array(
	'default_generator' => PluginManager::GENERATOR_HUMAN,
	'generator_options' => array(
		PluginManager::GENERATOR_HUMAN => array(
			'options' => array(),
			'parameters' => array(
				Generator\HumanPasswordGenerator::PARAMETER_DICTIONARY_FILE => '/usr/share/dict/words',
			)
		)
	),
);

// Do not edit below this line
//-----------------------------------------

return array(
	'xelax_pw_gen' => $generatorOptions
);