<?php
namespace Packaged\Map;

class TypedDataMap extends DataMap
{
  protected $_formatter;

  public function __construct(array $data = [], callable $formatter = null)
  {
    if($formatter === null)
    {
      throw new \RuntimeException("A formatter is required when constructing a " . static::class);
    }
    $this->_formatter = $formatter;
    //Ensure each value is an array
    foreach($data as $k => $v)
    {
      $data[$k] = $formatter($v);
    }

    parent::__construct($data);
  }

  public function set(string $key, $value)
  {
    return parent::set($key, ($this->_formatter)($value));
  }
}
