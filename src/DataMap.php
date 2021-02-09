<?php
namespace Packaged\Map;

use function count;

class DataMap implements \IteratorAggregate, \Countable
{
  protected $_data;

  public function __construct(array $data = [])
  {
    $this->_data = $data;
  }

  public function all(): array
  {
    return $this->_data;
  }

  public function keys($filter = null, $strict = null): array
  {
    return array_keys($this->_data, $filter, $strict);
  }

  public function values(): array
  {
    return array_values($this->_data);
  }

  public function has(string $key): bool
  {
    return array_key_exists($key, $this->_data);
  }

  public function remove(string $key)
  {
    unset($this->_data[$key]);
    return $this;
  }

  public function set(string $key, $value)
  {
    $this->_data[$key] = $value;
    return $this;
  }

  public function get(string $key, $defaultValue = null)
  {
    return $this->_data[$key] ?? $defaultValue;
  }

  public function getInt(string $key, int $defaultValue = 0): int
  {
    return (int)$this->_data[$key] ?? $defaultValue;
  }

  public function getIterator()
  {
    return new \ArrayIterator($this->_data);
  }

  public function count()
  {
    return count($this->_data);
  }
}
