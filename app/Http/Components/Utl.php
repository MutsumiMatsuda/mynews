<?php
namespace App\Http\Components;
/**
* Utlファサードの処理実装クラス
* 松田追加
*/
class Utl
{
  /**
  * null か 空文字であるかの真偽値を返す
  *
  * @param  オブジェクト
  * @return null か 空文字である場合はtrue、それ以外の場合はfalse
  */
  public function isNullOrEmpty($object) {
    return is_null($object) || ('' == $object);
  }

  /**
  * 文字列が等価であるかの真偽値を返す
  *
  * @param  比較対象String１
  * @param  比較対象String２
  * @return 文字列が等価ならtrue、それ以外の場合はfalse
  */
  public function isSameStr($str1, $str2) {
    return !is_null($str1) && !is_null($str2) && (0 == strcmp($str1, $str2));
  }

  /**
  * 画像無しの場合のファイル名を取得
  *
  * @param  void
  * @return 画像無しの場合のファイル名
  */
  public function getNoImageFilename() {
    return env('NO_IMAGE_FILENAME');
  }

  /**
  * 画像無しの場合のファイル名かの真偽値を返す
  *
  * @param  画像ファイル名
  * @return AWS S3 の画像ファイルへのパス
  *         画像ファイル名が空の場合は、画像無しのファイルパスを返す
  */
  public function isNoImage($filename) {
    return self::isSameStr(self::getNoImageFilename(), $filename);
  }

  /**
  * StorageTypeがs3であるかの真偽値を返す
  *
  * @param  void
  * @return 文字列が等価ならtrue、それ以外の場合はfalse
  */
  public function isS3() {
    return self::isSameStr(env('FILESYSTEM_DRIVER'), env('FILESYSTEM_DRIVER_TYPE_S3'));
  }

  /**
  * 画像へのフルパス取得
  *
  * @param  画像ファイル名
  * @return 画像ファイルへのフルパス
  *         画像ファイル名が空の場合は、画像無しのファイルパスを返す
  */
  public function getImagePath($filename) {

    if (self::isS3()) {
      $ret = env('AWS_S3_URL') . '/' . env('IMAGE_URL_PREFIX') . '/' . ('' == $filename ? self::getNoImageFilename() : $filename);
    } else {
      $ret = asset('storage/image/' . $filename);
    }
    return $ret;
  }
}
