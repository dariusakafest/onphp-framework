<?php
/***************************************************************************
 *   Copyright (C) 2007 by Anton E. Lebedevich                             *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

namespace OnPHP\Main\Criteria\Projection;

use OnPHP\Main\Criteria\Criteria;
use OnPHP\Core\OSQL\JoinCapableQuery;
use OnPHP\Core\OSQL\SQLFunction;

/**
 * @ingroup Projection
**/
final class DistinctCountProjection extends CountProjection
{
	/**
	 * @return SQLFunction
	**/
	protected function getFunction(
		Criteria $criteria,
		JoinCapableQuery $query
	)
	{
		return
			parent::getFunction($criteria, $query)->
			setAggregateDistinct();
	}
}
?>