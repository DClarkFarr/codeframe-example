<?php
namespace Utils;

class Input {
  static $default_type = 'text';
  static $default_tag = 'textarea';
  static $default_button_type = "button";
  static $default_button_text = "Save";
  static $default_attrs = array(
    'text' => array('class' => 'form-control'),
    'password' => array('class' => 'form-control'),
    'select' => array('class' => 'form-control'),
    'textarea' => array('class' => 'form-control', 'rows' => 8),
    'email' => array('class' => 'form-control'),
    'file' => array(),
    'number' => array('class' => 'form-control'),
    'radio' => array(),
    'checkbox' => array(),
    'hidden' => array(),
    'button' => array('class' => 'btn btn-default'),
    'url' => array('class' => 'form-control'),
  );

  static function input($name, $value, $attrs = array()){
    $type = isset($attrs['type']) ? $attrs['type'] : self::$default_type;
    unset($attrs['type']);
    return self::$type($name, $value, $attrs);
  }
  static function checkbox($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['checkbox'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'checkbox';

    return Input::_input($attrs);
  }
  static function radio($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['radio'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'radio';

    return Input::_input($attrs);
  }
  static function select($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['select'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    return Input::_select($attrs);
  }
  static function textarea($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['textarea'], $attrs);
    $attrs['name'] = $name;

    unset($attrs['value']);

    return Input::_tag('textarea', htmlspecialchars($value, ENT_QUOTES), $attrs);
  }
  static function button($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['button'], $attrs);
    if($name){
      $attrs['name'] = $name;
    }
    if($value){
      $attrs['value'] = $value;
    }

    $attrs['type'] = isset($attrs['type']) ? $attrs['type'] : Input::$default_button_type;

    $label = isset($attrs['label']) ? $attrs['label'] : Input::$default_button_text;
    unset($attrs['label']);

    return Input::_tag('button', $label, $attrs);
  }


  static function text($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['text'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;

    return Input::_input($attrs);
  }
  static function hidden($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['text'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'hidden';
    return Input::_input($attrs);
  }
  static function url($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['text'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'url';
    return Input::_input($attrs);
  }
  static function password($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['password'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'password';

    return Input::_input($attrs);
  }
  static function file($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['file'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'file';

    return Input::_input($attrs);
  }
  static function email($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['email'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'email';

    return Input::_input($attrs);
  }
  static function number($name, $value, $attrs = array()){
    $attrs = array_merge(Input::$default_attrs['number'], $attrs);
    $attrs['name'] = $name;
    $attrs['value'] = $value;
    $attrs['type'] = 'number';

    return Input::_input($attrs);
  }
  static function _tag($tag, $label, $params){
    if(!$tag){
      $tag = Input::$default_tag;
    }
    return "<". $tag . Input::attrs($params) .">". $label ."</". $tag .">";
  }
  static function _select($params){
    $current = isset($params['value']) ? $params['value'] : false;
    $source = isset($params['source']) ? $params['source'] : array();
    $using = isset($params['using']) ? $params['using'] : array();
    unset($params['value'], $params['source'], $params['using']);

    if(is_callable($source)){
      $source = $source();
    }
    if($using){
      $res = [];
      list($id, $name) = $using;
      foreach($source as $key => $arr){
        $res[$arr[$id]] = $arr[$name];
      }
      $source = $res;
      unset($res);
    }
    $str = "<select". Input::attrs($params) .">";
    if($source){
      foreach($source as $key => $value){
        $checked = $current == $key && $current !== false ? "selected='selected'" : '';
        $str .= "<option value=\"". $key ."\" $checked>". $value ."</option>";
      }
    }
    $str .= "</select>";
    return $str;
  }
  static function _input($params){
    if(!isset($params['type'])){
      $params['type'] = Input::$default_type;
    }
    return "<input". Input::attrs($params) .">";
  }
  static function attrs($params){
    $str = "";
    foreach($params as $key => $value){
      if(is_array($value)){
        continue;
      }
      $str .= ' ' . $key . '="'. htmlspecialchars($value, ENT_QUOTES) .'"';
    }
    return $str;
  }
}
