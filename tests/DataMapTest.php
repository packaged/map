<?php

namespace Packaged\Map\Tests;

use Iterator;
use Packaged\Map\DataMap;
use PHPUnit\Framework\TestCase;

class DataMapTest extends TestCase
{

  protected function _simpleMap(): DataMap
  {
    $data = new DataMap();
    $data->set('fruit', 'apple');
    $data->set('color', 'red');
    $data->set('dog', 'poodle');
    return $data;
  }

  public function testSet(): void
  {
    $data = new DataMap();
    $data->set('fruit', 'apple');
    self::assertEquals(['fruit' => 'apple'], $data->all());
    $data->set('color', 'orange');
    self::assertEquals(['fruit' => 'apple', 'color' => 'orange'], $data->all());
    $data->set('color', 'red');
    self::assertEquals(['fruit' => 'apple', 'color' => 'red'], $data->all());
    $data->set('color', 'blue');
    self::assertNotContainsEquals(['fruit' => 'apple', 'color' => 'red'], $data->all());

    $data = new DataMap();
    $data->set(1, 'apple');
    self::assertEquals([1 => 'apple'], $data->all());

    $data->set(false, 'orange');
    self::assertEquals(['1' => 'apple', '' => 'orange'], $data->all());

    $data = new DataMap();
    $data->set('1', 'apple');
    $data->set(1, 'orange');
    self::assertEquals(['1' => 'orange'], $data->all());
  }

  public function testRemove(): void
  {
    $data = $this->_simpleMap();
    $data->remove('1');
    self::assertEquals(['fruit' => 'apple', 'color' => 'red', 'dog' => 'poodle'], $data->all());
    $data->remove('fruit');
    self::assertEquals(['color' => 'red', 'dog' => 'poodle'], $data->all());
    $data->remove(1);
    self::assertEquals(['color' => 'red', 'dog' => 'poodle'], $data->all());
  }

  public function testValues(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals(['apple', 'red', 'poodle'], $data->values());
    self::assertNotContains('color', $data->values());
  }

  public function testKeys(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals(['fruit', 'color', 'dog'], $data->keys());
    self::assertNotContains('red', $data->keys());
  }

  public function testFilterKeys(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals(['fruit'], $data->filterKeys('apple'));
    self::assertNotContains('dog', $data->filterKeys('apple'));
  }

  public function testGet(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals('apple', $data->get('fruit'));
    self::assertNotEquals('apple', $data->get('pen'));
    self::assertEquals('red', $data->get('color'));
    self::assertEquals('day', $data->get('time', 'day'));
    self::assertEquals(1, $data->get('time', true));
  }

  public function testGetIterator(): void
  {
    $data = $this->_simpleMap();
    $iterator = $data->getIterator();
    self::assertInstanceOf(Iterator::class, $data->getIterator());
    self::assertEquals(3, $iterator->count());

    $data = new DataMap();
    $iterator = $data->getIterator();
    self::assertInstanceOf(Iterator::class, $data->getIterator());
    self::assertEquals(0, $iterator->count());

    $data = new DataMap();
    $data->set('fruit', 'apple')->set('color', 'red')->set('dog', 'poodle');
    $comparison = ['fruit' => 'apple', 'color' => 'red', 'dog' => 'poodle'];
    $arrayValues = $data->getIterator();

    $count = 0;
    foreach($arrayValues as $key => $arrayValue)
    {
      $count++;
      if($comparison[$key] === $arrayValue)
      {
        unset($comparison[$key]);
      }
    }

    self::assertEquals(3, $count);
    self::assertEmpty($comparison);
  }

  public function testCount(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals(3, $data->count());
    self::assertNotEquals(4, $data->count());
    $data->set('orange', 'pears');
    self::assertEquals(4, $data->count());
    self::assertNotEquals(3, $data->count());
  }

  public function testAll(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals(['fruit' => 'apple', 'color' => 'red', 'dog' => 'poodle'], $data->all());
    self::assertNotContains(['color' => 'red', 'fruit' => 'apple', 'dog' => 'poodle'], $data->all());
  }

  public function testClear(): void
  {
    $data = $this->_simpleMap();
    self::assertEquals(['fruit' => 'apple', 'color' => 'red', 'dog' => 'poodle'], $data->all());
    self::assertEquals([], $data->clear()->all());
  }

  public function testHas(): void
  {
    $data = $this->_simpleMap();
    self::assertTrue($data->has('fruit'));
    self::assertTrue($data->has('color'));
    self::assertTrue($data->has('dog'));
    $data->remove('dog');
    self::assertFalse($data->has('dog'));
  }

  public function testGetInt(): void
  {
    $data = $this->_simpleMap();
    $data->set(1, 2);
    self::assertEquals(1, $data->getInt('time', 1));
    self::assertEquals(2, $data->getInt(1, 1));
    self::assertEquals(2, $data->getInt(1));
    self::assertEquals(1, $data->getInt('time', 1));
  }
}
