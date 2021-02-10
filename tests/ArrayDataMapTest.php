<?php

namespace Packaged\Map\Tests;

use Packaged\Map\ArrayDataMap;
use Packaged\Map\DataMap;
use PHPUnit\Framework\TestCase;

class ArrayDataMapTest extends TestCase
{

//  public function testGet(): void
//  {
//    $data = $this->_simpleMap();
//    $array = new ArrayDataMap();
//
//    $array->set('1', $data->all());
//    $array->set('something', $data->all());
//    self::assertEquals($data->all(), $array->get('1'));
//    //TODO IS THIS IS BROKE? GET RETUNS THE FIRST KEY IN THE ARRAY[ARRAY[v]]
//  }

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
