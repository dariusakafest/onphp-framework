<?php

namespace OnPHP\Tests\Main;

use OnPHP\Core\DB\ImaginaryDialect;
use OnPHP\Core\DB\PgSQL;
use OnPHP\Core\Exception\UnimplementedFeatureException;
use OnPHP\Core\Exception\WrongArgumentException;
use OnPHP\Core\Logic\Expression;
use OnPHP\Core\OSQL\DBField;
use OnPHP\Core\OSQL\InsertOrUpdateQuery;
use OnPHP\Core\OSQL\OSQL;
use OnPHP\Core\OSQL\SQLFunction;
use OnPHP\Tests\TestEnvironment\TestCaseDB;

/**
 * @group core
 * @group db
 * @group osql
 * @group postgresql
 */
final class OsqlReturningTest extends TestCaseDB
{
	public function testUpdate()
	{
		$dialect = $this->getDbByType(PgSQL::class)->getDialect();

		$query = OSQL::update('test_table')->
			set('field1', 1)->
			where(Expression::eq('field1',2));

		$this->addReturning($query);

		$this->assertEquals(
			$query->toDialectString($dialect),
			'UPDATE "test_table" '
			.'SET "field1" = \'1\' '
			.'WHERE ("field1" = \'2\') '
			.'RETURNING '
				.'"test_table"."field1" AS "alias1", '
				.'"test_table"."field2", '
				.'count("test_table"."field5") AS "alias5", '
				.'(SELECT "test_table1"."id" FROM "test_table1") AS "foo1"'
		);
	}

	public function testInsert()
	{
		$dialect = $this->getDbByType(PgSQL::class)->getDialect();

		$query = OSQL::insert()->
			into('test_table')->
			set('field2', 2)->
			set('field16', 3);

		$this->addReturning($query);

		$this->assertEquals(
			$query->toDialectString($dialect),
			'INSERT INTO "test_table" ("field2", "field16") '
			.'VALUES (\'2\', \'3\') '
			.'RETURNING '
				.'"test_table"."field1" AS "alias1", '
				.'"test_table"."field2", '
				.'count("test_table"."field5") AS "alias5", '
				.'(SELECT "test_table1"."id" FROM "test_table1") AS "foo1"'
		);
	}

	public function testDelete()
	{
		$query = OSQL::delete()->from('pity_table');

		$dialect = $this->getDbByType(PgSQL::class)->getDialect();

		try {
			$query->toDialectString($dialect);
			$this->fail();
		} catch (WrongArgumentException $e) {
			//pass
		}

		$query->where(Expression::eq('count', 2))->returning('id');

		$this->assertEquals(
			$query->toDialectString($dialect),
			'DELETE FROM "pity_table" WHERE ("count" = \'2\') RETURNING "pity_table"."id"'
		);
	}

	public function testHasNoReturning()
	{
		$dialect = ImaginaryDialect::me();

		$query = OSQL::update('test_table')->
			set('field1', 1)->
			where(Expression::eq('field1',2))->
			returning('field1');

		$this->expectException(UnimplementedFeatureException::class);
		
		$query->toDialectString($dialect);
	}

	/**
	 * @return InsertOrUpdateQuery
	**/
	protected function addReturning(InsertOrUpdateQuery $query)
	{
		$query->
			returning(DBField::create('field1', 'test_table'), 'alias1')->
			returning('field2')->
			returning(
				SQLFunction::create(
					'count', DBField::create('field5', 'test_table')
				)->
				setAlias('alias5')
			)->
			returning(
				OSQL::select()->
					from('test_table1')->
					setName('foo1')->
					get('id')
			);

		return $query;
	}
}
?>