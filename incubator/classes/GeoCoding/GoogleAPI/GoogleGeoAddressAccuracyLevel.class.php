<?php
/***************************************************************************
 *   Copyright (C) 2008 by Shimizu                                    *
 *   neemah86@gmail.com                                                    *
 ***************************************************************************/
/* $Id$ */

	class GoogleGeoAddressAccuracyLevel extends Enumeration
	{
		const LEVEL_0 = 0;
		const LEVEL_1 = 1;
		const LEVEL_2 = 2;
		const LEVEL_3 = 3;
		const LEVEL_4 = 4;
		const LEVEL_5 = 5;
		const LEVEL_6 = 6;
		const LEVEL_7 = 7;
		const LEVEL_8 = 8;
		const LEVEL_9 = 9;
		
		protected $names = array(
			self::LEVEL_0 => "Unknown location.",
			self::LEVEL_1 => "Country level.",
			self::LEVEL_2 => "Region (state, province, prefecture, etc.) level.",
			self::LEVEL_3 => "Sub-region (county, municipality, etc.) level",
			self::LEVEL_4 => "Town (city, village) level",
			self::LEVEL_5 => "Post code (zip code) level",
			self::LEVEL_6 => "Street level",
			self::LEVEL_7 => "Intersection level",
			self::LEVEL_8 => "Address level",
			self::LEVEL_9 => "Premise (building name, property name, shopping center, etc.) level"
		);
		
	}
?>