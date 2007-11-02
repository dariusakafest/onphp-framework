<?php
/***************************************************************************
 *   Copyright (C) 2007 by Ivan Y. Khvostishkov                            *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/
/* $Id$ */

	/**
	 * @ingroup Primitives
	**/
	class PrimitiveForm extends BasePrimitive
	{
		protected $className = null;
		protected $proto = null;
		
		/**
		 * @throws WrongArgumentException
		 * @return PrimitiveForm
		**/
		public function of($className)
		{
			Assert::isTrue(
				class_exists($className, true),
				"knows nothing about '{$className}' class"
			);
			
			$protoClass = 'Proto'.$className;
			
			Assert::isTrue(
				class_exists($protoClass, true),
				"knows nothing about '{$protoClass}' class"
			);
			
			$this->proto = Singleton::getInstance($protoClass);
			
			Assert::isInstance($this->proto, 'DTOProto');
			
			$this->className = $className;
			
			return $this;
		}
		
		public function getClassName()
		{
			return $this->className;
		}
		
		public function getReflection()
		{
			return $this->info;
		}
		
		/**
		 * @throws WrongArgumentException
		 * @return PrimitiveForm
		**/
		public function setValue($value)
		{
			Assert::isTrue($value instanceof Form);
			
			return parent::setValue($value);
		}
		
		public function import($scope)
		{
			if (!$this->className)
				throw new WrongStateException(
					"no class defined for PrimitiveForm '{$this->name}'"
				);
			
			if (!isset($scope[$this->name]))
				return null;
			
			$this->rawValue = $scope[$this->name];
			
			$this->value =
				$this->proto->makeForm()->
				import($this->rawValue);
			
			$this->imported = true;
				
			if ($this->value->getErrors())
				return false;
			
			return true;
		}
		
		public function exportValue()
		{
			if (!$this->value)
				return null;
			
			return $this->value->export();
		}
	}
?>