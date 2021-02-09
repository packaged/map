<?php

namespace Packaged\Map\Tests;

use Packaged\Map\ArrayDataMap;
use Packaged\Map\DataMap;
use PHPUnit\Framework\TestCase;

class ArrayDataMapTest extends TestCase
{

  protected function _simpleMap(): DataMap
  {
    $data = new DataMap();
    $data->set('fruit', 'apple');
    $data->set('color', 'red');
    $data->set('dog', 'poodle');
    return $data;
  }

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
    $data = $this->_simpleMap();
    $array = new ArrayDataMap();

    $array->set('1', $data->all());
    $equals = [1 => $data->all()];
    self::assertEquals($equals, $array->all());

    $array->append('1', 'something');
    $equals['1'][] = 'something';
    self::assertEquals($equals, $array->all());

    $array->append('2', 'something');
    $equals['2'][] = 'something';
    self::assertEquals($equals, $array->all());
  }

  public function testSet(): void
  {
    $data = $this->_simpleMap();
    $array = new ArrayDataMap();

    $array->set('1', $data->all());
    $equals = [1 => $data->all()];
    self::assertEquals($equals, $array->all());

    $array->set('alt', $data->all());
    $equals['alt'] = $data->all();
    self::assertEquals($equals, $array->all());

    $array->set('new', [true, true, false]);
    $equals['new'] = [true, true, false];
    self::assertEquals($equals, $array->all());
  }
}
