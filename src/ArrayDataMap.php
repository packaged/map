<?php
namespace Packaged\Map;

/**
 * Class ArrayDataMap
 *
 * @package Packaged\Map
 */
class ArrayDataMap extends TypedDataMap
{
  public function __construct(array $data = []) { parent::__construct($data, [ArrayDataMap::class, 'toArray']); }

  public static function toArray($value) { return is_array($value) ? $value : [$value]; }

  /**
   * @param string $key
   * @param string $value
   *
   * @return $this
   */
  public function append(string $key, string $value): ArrayDataMap
  {
    if(!isset($this->_data[$key]))
    {
      $this->_data[$key] = [$value];
    }
    else
    {
      $this->_data[$key][] = $value;
    }
    return $this;
  }

  /**
   * @param string $key
   * @param null   $defaultValue
   * @param bool   $first
   *
   * @return mixed|null
   */
  public function get(string $key, $defaultValue = null, $first = true)
  {
    if(!isset($this->_data[$key]))
    {
      return $defaultValue;
    }
    return $first ? reset($this->_data[$key]) : $this->_data[$key];
  }
}
