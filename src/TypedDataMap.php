<?php
namespace Packaged\Map;

class TypedDataMap extends DataMap
{
  protected $_formatter;

  public function __construct(array $data = [], callable $formatter = null)
  {
    if($formatter)
    {
      $this->_formatter = $formatter;
      //Ensure each value is an array
      foreach($data as $k => $v)
      {
        $data[$k] = $formatter($v);
      }
    }
    parent::__construct($data);
  }

  public function set(string $key, $value)
  {
    $formatter = $this->_formatter;
    return parent::set($key, $formatter ? $formatter($value) : $value);
  }
}
