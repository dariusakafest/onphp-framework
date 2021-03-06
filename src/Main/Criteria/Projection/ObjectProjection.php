<?php
/***************************************************************************
 *   Copyright (C) 2006-2007 by Konstantin V. Arkhipov                     *
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

/**
 * @ingroup Projection
**/
interface ObjectProjection
{
	/**
	 * @return JoinCapableQuery
	**/
	public function process(Criteria $criteria, JoinCapableQuery $query);
}
?>