<?php
namespace Packaged\Map;

/**
 * Class ArrayDataMap
 * @package Packaged\Map
 */
class ArrayDataMap extends DataMap
{
  public function __construct(array $data = [])
  {
    //Ensure each value is an array
    foreach($data as $k => $v)
    {
      if(!is_array($v))
      {
        $data[$k] = [$v];
      }
    }
    parent::__construct($data);
  }

  /**
   * @param string $key
   * @param        $value
   *
   * @return $this
   */
  public function set(string $key, $value)
  {
    $this->_data[$key] = is_array($value) ? $value : [$value];
    return $this;
  }

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
