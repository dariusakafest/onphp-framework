<?php
/***************************************************************************
 *   Copyright (C) 2010 by Alexander V. Solomatin                          *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

namespace OnPHP\Main\OpenId;

use OnPHP\Main\Flow\Model;
use OnPHP\Main\Flow\HttpRequest;

/**
 * @ingroup OpenId
**/
interface OpenIdExtension
{
	public function addParamsToModel(Model $model);
	public function parseResponce(HttpRequest $request, array $params);
}
?>