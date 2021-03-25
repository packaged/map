<?php

namespace Packaged\Map\Tests;

use Packaged\Map\ArrayDataMap;
use PHPUnit\Framework\TestCase;

class ArrayDataMapTest extends TestCase
{

  public function testGet(): void
  {
    $array = new ArrayDataMap();

    $array->set('a', '1');
    $array->set('b', '2');
    $array->set('c', 3);

    self::assertEquals('1', $array->get('a'));
    self::assertEquals('2', $array->get('b'));
    self::assertEquals(3, $array->get('c'));

    $array->set('d', ['x' => 'y', 'z']);
    self::assertEquals(['x' => 'y', 'z'], $array->get('d', null, false));
    self::assertEquals('failed', $array->get('ff', 'failed', true));
    self::assertEquals('failed2', $array->get('ff', 'failed2', false));
  }

  public function testConstruct()
  {
    $array = new ArrayDataMap(['a' => 'b', 'c' => ['d', 'e']]);

    self::assertEquals('b', $array->get('a'));
    self::assertEquals(['d', 'e'], $array->get('c', null, false));
  }

  public function testAppend(): void
  {
    $data = ['a' => '1', 'b' => '2', 'c' => 3];
    $arrayDataMap = new ArrayDataMap();

    $arrayDataMap->set('1', $data);
    $equals = [1 => $data];
    self::assertEquals($equals, $arrayDataMap->all());

    $arrayDataMap->append('1', 'something');
    $equals['1'][] = 'something';
    self::assertEquals($equals, $arrayDataMap->all());

    $arrayDataMap->append('2', 'something');
    $equals['2'][] = 'something';
    self::assertEquals($equals, $arrayDataMap->all());
  }

  public function testSet(): void
  {
    $data = ['a' => '1', 'b' => '2', 'c' => 3];
    $array = new ArrayDataMap();

    $array->set('1', $data);
    $equals = [1 => $data];
    self::assertEquals($equals, $array->all());

    $array->set('alt', $data);
    $equals['alt'] = $data;
    self::assertEquals($equals, $array->all());

    $array->set('new', [true, true, false]);
    $equals['new'] = [true, true, false];
    self::assertEquals($equals, $array->all());
  }
}
