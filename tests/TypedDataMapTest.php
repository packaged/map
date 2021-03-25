<?php

namespace Packaged\Map\Tests;

use Packaged\Map\TypedDataMap;
use PHPUnit\Framework\TestCase;

class TypedDataMapTest extends TestCase
{
  public function testFormatter()
  {
    $map = new TypedDataMap(['a' => 1, 'b' => 2], $this->timesFive());
    foreach($map->all() as $k => $v)
    {
      self::assertTrue($v % 5 === 0);
    }
    $map->set('c', 10);
    self::assertEquals(5, $map->get('a'));
    self::assertEquals(10, $map->get('b'));
    self::assertEquals(50, $map->get('c'));
  }

  public function timesFive()
  {
    return function ($value) { return $value * 5; };
  }
}
