<?php
/*
 * base58.php
 *
 * PHP Base58 codec
 *
 * Based on https://github.com/MoneroPy/moneropy/base58.py and https://github.com/mymonero/mymonero-core-js/cryptonote_utils/cryptonote_base58.js
 *
 */

class base58 {
  /**
   * @var string
   */
  static $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';

  /**
   *
   * Convert a hexadecimal string to a binary array
   *
   * @param    string  $hex  A hexadecimal string to convert to a binary array
   * @return   array
   *
   */
  public function hex_to_bin($hex) {
    // TODO input validation

    $res = array_fill(0, strlen($hex) / 2, 0);
    for ($i = 0; $i < strlen($hex) / 2; $i++) {
      $res[$i] = intval(substr($hex, $i * 2, $i * 2 + 2 - $i * 2), 16);
    }
    return $res;
  }

  /**
   *
   * Convert a binary array to a hexadecimal string
   *
   * @param    array   $bin  A binary array to convert to a hexadecimal string
   * @return   string
   *
   */
  public function bin_to_hex($bin) {
    // TODO input validation

    $res = [];
    for ($i = 0; $i < count($bin); $i++) {
      array_push($res, base_convert($bin[$i], 10, 16));
    }
    return join($res);
  }

  /**
   *
   * Convert a string to a binary array
   *
   * @param    string   $str  A string to convert to a binary array
   * @return   array
   *
   */
  function str_to_bin($str) {
    // TODO input validation

    $res = array_fill(0, strlen($str), 0);
    for ($i = 0; $i < strlen($str); $i++) {
      $res[$i] = ord($str[$i]);
    }
    return $res;
  }

  /**
   *
   * Convert a binary array to a string
   *
   * @param    array   $bin  A binary array to convert to a string
   * @return   string
   *
   */
  function bin_to_str($bin) {
    // TODO input validation

    $res = array_fill(0, count($bin), 0);
    for ($i = 0; $i < count($bin); $i++) {
      $res[$i] = chr($bin[$i]);
    }
    return join($res);
  }

  /**
   *
   * Convert a UInt8BE (one unsigned big endian byte) array to UInt64
   *
   * @param    array   $data  A UInt8BE array to convert to UInt64
   * @return   number
   *
   */
  public function uint8_be_to_64($data) {
    // TODO input validation

    $res = 0;
    $switch = 9 - count($data);
    for ($i = 0; $i < count($data); $i++) {
      switch ($switch) {
        case 1: 
          $res = $res << 8 | $data[$i];
        case 2:
          $res = $res << 8 | $data[$i];
        case 3:
          $res = $res << 8 | $data[$i];
        case 4:
          $res = $res << 8 | $data[$i];
        case 5:
          $res = $res << 8 | $data[$i];
        case 6:
          $res = $res << 8 | $data[$i];
        case 7:
          $res = $res << 8 | $data[$i];
        case 8:
          $res = $res << 8 | $data[$i];
        default:
          throw new Exception('Impossible condition');
      }
    }
    return $res;
  }

  /**
   *
   * Convert a UInt64 (unsigned 64 bit integer) to a UInt8BE array
   *
   * @param    number   $num   A UInt64 number to convert to a UInt8BE array
   * @param    integer  $size  Size of array to return
   * @return   array
   *
   */
  public function uint64_to_8_be($num, $size) {
    // TODO input validation
    //      throw exception if size < 1 or size > 8

    $res = array_fill(0, $size, 0);
    for ($i = $size - 1; $i >= 0; $i--) {
      $res[$i] = $num % pow(2, 8);
      $num = floor($num / pow(2, 8));
    }
    return $res;
  }
  
  /*
   * Encode a hexadecimal (Base16) input to Base58
   *
   * @param    string  $input  A hexadecimal (Base16) input to convert to Base58
   * @return   string
   *
   */
  public function encode($input) {
    // stub
  }

  /**
   *
   * Decode a Base58 input to hexadecimal (Base16)
   *
   * @param    string  $input  A Base58 input to convert to hexadecimal (Base16)
   * @return   string
   *
   */
  public function decode($input) {
    // stub
  }
}

?>
