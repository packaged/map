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

    self::assertEquals($array->get('a'), '1');
    self::assertEquals($array->get('b'), '2');
    self::assertEquals($array->get('c'), 3);

    $array->set('d', ['x' => 'y', 'z']);
    self::assertEquals($array->get('d'), ['a' => 'y', 'z']);
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
