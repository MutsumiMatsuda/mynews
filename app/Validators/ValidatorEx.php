<?php

namespace App\Validators;

use Illuminate\Validation\Validator;
use Utl;

/**
* 追加バリデーションの実装クラス
*/
class ValidatorEx extends Validator
{
  // NGワードの配列をクラス変数として保持する
  static $ngwords = [
    'バカ', 'アホ', 'マヌケ', '馬鹿', '阿呆', '間抜け', '死ね'
  ];

  /**
   * validatengword NGワードのバリデーション
   *
   * @param string $value
   * @access public
   * @return bool
   */
  public static function validatengword($attribute, $value, $parameters)
  {
    $ng = '';
    $ret = true;
    foreach (self::$ngwords as $v) {
        $ng .= preg_quote($v, '/') . '|';
    }
    if (!Utl::isNullOrEmpty($ng) && preg_match_all('/' . substr($ng, 0, -1) . '/', $value)) {
        $ret = false;
    }
    return $ret;
  }
}
