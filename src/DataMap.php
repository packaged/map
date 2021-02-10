<?php
namespace Packaged\Map;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use function count;

/**
 * Class DataMap
 * @package Packaged\Map
 */
class DataMap implements IteratorAggregate, Countable
{
  /** @var array */
  protected $_data;

  /**
   * DataMap constructor.
   *
   * @param array $data
   */
  public function __construct(array $data = [])
  {
    $this->_data = $data;
  }

  /**
   * @return $this
   */
  public function clear(): DataMap
  {
    $this->_data = [];
    return $this;
  }

  /**
   * @return array
   */
  public function all(): array
  {
    return $this->_data;
  }

  /**
   * @return array
   */
  public function keys(): array
  {
    return array_keys($this->_data);
  }

  /**
   * @param $filter
   *
   * @return array
   */
  public function filterKeys($filter): array
  {
    return array_keys($this->_data, $filter);
  }

  /**
   * @return array
   */
  public function values(): array
  {
    return array_values($this->_data);
  }

  /**
   * @param string $key
   *
   * @return bool
   */
  public function has(string $key): bool
  {
    return array_key_exists($key, $this->_data);
  }

  /**
   * @param string $key
   *
   * @return $this
   */
  public function remove(string $key): DataMap
  {
    unset($this->_data[$key]);
    return $this;
  }

  /**
   * @param string $key
   * @param        $value
   *
   * @return $this
   */
  public function set(string $key, $value): DataMap
  {
    $this->_data[$key] = $value;
    return $this;
  }

  /**
   * @param string $key
   * @param null   $defaultValue
   *
   * @return mixed|null
   */
  public function get(string $key, $defaultValue = null)
  {
    return $this->_data[$key] ?? $defaultValue;
  }

  /**
   * @param string $key
   * @param int    $defaultValue
   *
   * @return int
   */
  public function getInt(string $key, int $defaultValue = 0): int
  {
    return (int)($this->_data[$key] ?? $defaultValue);
  }

  /**
   * @return ArrayIterator
   */
  public function getIterator(): ArrayIterator
  {
    return new ArrayIterator($this->_data);
  }

  /**
   * @return int
   */
  public function count(): int
  {
    return count($this->_data);
  }
}
