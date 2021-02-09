<?php
namespace Packaged\Map;

class ArrayDataMap extends DataMap
{
  public function set(string $key, $value)
  {
    $this->_data[$key] = is_array($value) ? $value : [$value];
    return $this;
  }

  public function append(string $key, string $value)
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

  public function get(string $key, $defaultValue = null, $first = true)
  {
    if(!isset($this->_data[$key]))
    {
      return $defaultValue;
    }
    return $first ? reset($this->_data[$key]) : $this->_data[$key];
  }
}
