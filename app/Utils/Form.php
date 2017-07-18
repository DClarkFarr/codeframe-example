<?php

namespace Utils;

class Form {
  static $group_type = "";
  static $radio_type = "";
  static $checkbox_type = "";
  static function checkboxes($name, $values, $attrs = array()){
    $source = isset($attrs['source']) ? $attrs['source'] : array();
    $using = isset($attrs['using']) ? $attrs['using'] : array();
    $label = isset($attrs['label']) ? $attrs['label'] : $name;
    $group_type = isset($attrs['group_type']) ? $attrs['group_type'] : Form::$group_type;
    $checkbox_type = isset($attrs['checkbox_type']) ? $attrs['checkbox_type'] : Form::$checkbox_type;

    unset($attrs['value'], $attrs['source'], $attrs['using'], $attrs['label'], $attrs['group_type'], $attrs['checkbox_type']);

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

    $checkboxes = "<div class='checkboxes'>";
    if(is_array($source)){
      foreach($source as $key => $val){
        if(in_array($key, (array) $values)){
          $attrs['checked'] = 'checked';
        }else{
          unset($attrs['checked']);
        }
        if(strpos($name, '[') === false){
          $name .= '[]';
        }
        $checkboxes .= Form::_checkbox($checkbox_type, $val, Input::checkbox($name, $key, $attrs));
      }
    }
    $checkboxes .= "</div>";

    return Form::_group($group_type, $label, $checkboxes, $attrs);
  }
  static function radios($name, $value, $attrs = array()){
    $source = isset($attrs['source']) ? $attrs['source'] : array();
    $using = isset($attrs['using']) ? $attrs['using'] : array();
    $label = isset($attrs['label']) ? $attrs['label'] : $name;
    $group_type = isset($attrs['group_type']) ? $attrs['group_type'] : Form::$group_type;
    $radio_type = isset($attrs['radio_type']) ? $attrs['radio_type'] : Form::$radio_type;

    unset($attrs['value'], $attrs['source'], $attrs['using'], $attrs['label'], $attrs['group_type'], $attrs['radio_type']);

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

    $radios = "<div class='radios'>";
    if(is_array($source)){
      foreach($source as $key => $val){
        if($value == $key){
          $attrs['checked'] = 'checked';
        }else{
          unset($attrs['checked']);
        }
        $radios .= Form::_radio($radio_type, $val, Input::radio($name, $key, $attrs));
      }
    }
    $radios .= "</div>";

    return Form::_group($group_type, $label, $radios, $attrs);
  }
  static function input($name, $value, $attrs = array()){
    $type = isset($attrs['type']) && $attrs['type'] ? $attrs['type'] : Input::$default_type;
    return Form::$type($name, $value, $attrs);
  }

  static function image($name, $value, $attrs = array()){
      $html = "<div class='form-group group-image'>";

      $html .= "<label>". $attrs['label'] ."</label>";


      $html .= "
        <div class='row'>
            <div class='col-sm-4'>
                <div class='preview'>";
                    
                    if($value){
                        $html .= "<img class='img-responsive' src='". $value ."' alt='Post Title'>";
                    }else{
                        $html .= "<p class='text-center'>No Image Selected</p>";
                    }
                $html .= "    
                </div>
            </div>
            <div class='col-sm-8'>
                <button type='button' class='btn btn-default btn-upload ". ($value ? 'hidden' : '' ) ."'>Add Image</button>
                <button type='button' class='btn btn-danger btn-delete ". ($value ? '' : 'hidden') ."'>Remove Image</button>
                <input type='hidden' class='image' name='". $name ."' value='". $value ."'>
                <input type='hidden' name='type' class='type' value='site'>
            </div>
        </div>";
      $html .= "</div>"; 
      return $html;
  }
  static function color($name, $value, $attrs = array()){
      $html = "<div class='form-group group-color'>";
          $html .= "<label>". $attrs['label'] ."</label>";
          $html .= "<div class='input-group'>";
              $html .= "<span class='input-group-btn'>";
                  $html .= "<input type='color' class='js-color' value='". $value ."'>";
              $html .= "</span>";
              $html .= "<input class='form-control' name='". $name ."' placeholder='#hexval, RGA(0, 0, 0), etc' value='". $value ."'>";
          $html .= "</div>";
      $html .= "</div>";
      return $html;
  }

  static function text($name, $value, $attrs = array()){
    return Form::group('text', $name, $value, $attrs);
  }
  static function hidden($name, $value, $attrs = array()){
    return Input::hidden($name, $value, $attrs);
  }
  static function url($name, $value, $attrs = array()){
    return Form::group('url', $name, $value, $attrs);
  }
  static function button($name, $value, $attrs = array()){
    return "<div class='form-group'>". Input::button($name, $value, $attrs) ."</div>";
  }
  static function checkbox($name, $value, $attrs = array()){
    return Form::group('checkbox', $name, $value, $attrs);
  }
  static function radio($name, $value, $attrs = array()){
    return Form::group('radio', $name, $value, $attrs);
  }
  static function select($name, $value, $attrs = array()){
    return Form::group('select', $name, $value, $attrs);
  }
  static function textarea($name, $value, $attrs = array()){
    return Form::group('textarea', $name, $value, $attrs);
  }
  static function password($name, $value, $attrs = array()){
    return Form::group('password', $name, $value, $attrs);
  }
  static function file($name, $value, $attrs = array()){
    return Form::group('file', $name, $value, $attrs);
  }
  static function email($name, $value, $attrs = array()){
    return Form::group('email', $name, $value, $attrs);
  }
  static function number($name, $value, $attrs = array()){
    return Form::group('number', $name, $value, $attrs);
  }
  static function _radio($radio_type, $label, $input_str){
    if($radio_type == 'inline'){
      $input_str = "<label class='radio-inline'>" . $input_str . " " . $label . "</label>";
    }else{
      $input_str = "<div class='radio'><label>" . $input_str . " " . $label . "</label></div>";
    }
    return $input_str;
  }
  static function _checkbox($checkbox_type, $label, $input_str){
    if($checkbox_type == 'inline'){
      $input_str = "<label class='checkbox-inline'>" . $input_str . " " . $label . "</label>";
    }else{
      $input_str = "<div class='checkbox'><label>" . $input_str . " " . $label . "</label></div>";
    }
    return $input_str;
  }
  static function group($class, $name, $value, $attrs){
    $label = isset($attrs['label']) ? $attrs['label'] : $name;
    $group_type = isset($attrs['group_type']) ? $attrs['group_type'] : Form::$group_type;
    $checkbox_type = isset($attrs['checkbox_type']) ? $attrs['checkbox_type'] : Form::$checkbox_type;
    $radio_type = isset($attrs['radio_type']) ? $attrs['radio_type'] : Form::$radio_type;
    unset($attrs['label'], $attrs['group_type']);

    $input_str = Input::$class($name, $value, $attrs);
    if($class == 'radio'){
      $input_str = Form::_radio($radio_type, $label, $input_str);
    }else if($class == 'checkbox'){
      $input_str = Form::_checkbox($checkbox_type, $label, $input_str);
    }

    return Form::_group($group_type, $label, $input_str, $attrs);
  }
  static function _group($group_type, $label, $input, $attrs = array()){
    $str = "<div class='form-group'>";
      if($group_type == 'horizontal'){
        $str .= "<div class='row'>";
      }
      $str .= "<label class='". ($group_type == 'horizontal' ? 'col-sm-3 control-label' : '') ."'>". $label ."</label>";

      $str .= $group_type == 'horizontal' ? "<div class='col-sm-9'>" . $input . "</div>" : $input;

      if($group_type == 'horizontal'){
        $str .= "</div>";
      }
      if(isset($attrs['help'])){
        $str .= "<p class='help-block'>". $attrs['help'] ."</p>";
      }
    $str .= "</div>";
    return $str;
  }
}


/*
//echo Form::select('test1', 'world', array('source' => array('hi' => 'hellow', 'world' => 'World')));
echo Form::checkboxes('education', array(1, 3), array(
  'source' => array(
    '1' => 'Kindergarten',
    '2' => 'Middle Schoole',
    '3' => 'High School',
    '4' => 'College',
  ),
  'label' => 'Education Completed',
));

echo Form::radios('gender', 'M', array(
  'source' => array(
    '' => 'Other',
    'M' => 'Male',
    'F' => 'Female',
  ),
  'radio_type' => 'inline',
  'label' => 'Gender',
));

*/
