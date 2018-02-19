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
  static $encoded_block_sizes = [0, 2, 3, 5, 6, 7, 9, 10, 11];
  static $full_block_size = 8;
  static $full_encoded_block_size = 11;

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
  public function str_to_bin($str) {
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
  public function bin_to_str($bin) {
    // TODO input validation

    $res = array_fill(0, count($bin), 0);
    for ($i = 0; $i < count($bin); $i++) {
      $res[$i] = chr($bin[$i]);
    }
    return preg_replace('/[[:^print:]]/', '', join($res)); // preg_replace necessary to strip errant non-ASCII characters eg. ''
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
    $i = 0;
    switch (9 - count($data)) {
      case 1: 
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 2:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 3:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 4:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 5:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 6:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 7:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
      case 8:
        $res = bcadd(bcmul($res, bcpow(2, 8)), $data[$i++]);
        break;
      default:
        throw new Exception('Impossible condition');
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
      $res[$i] = bcmod($num, bcpow(2, 8));
      $num = bcdiv($num, bcpow(2, 8));
    }
    return $res;
  }
  
  /**
   *
   * Convert a hexadecimal (Base16) array to a Base58 string
   *
   * @param    array    $data
   * @param    array    $buf
   * @param    integer  $index 
   * @return   array
   *
   */
  public function encode_block($data, $buf, $index) {
    // TODO input validation

    $num = self::uint8_be_to_64($data);
    $i = self::$encoded_block_sizes[count($data)] - 1;
    while ($num > 0) {
      $remainder = bcmod($num, 58);
      $num = bcdiv($num, 58);
      $buf[$index + $i] = ord(self::$alphabet[$remainder]);
      $i--;
    }
    return $buf;
  }

  /**
   *
   * Encode a hexadecimal (Base16) string to Base58
   *
   * @param    string  $hex  A hexadecimal (Base16) string to convert to Base58
   * @return   string
   *
   */
  public function encode($hex) {
    // TODO input validation

    $data = self::hex_to_bin($hex);

    if (count($data) == 0) {
      return '';
    }

    $full_block_count = floor(count($data) / self::$full_block_size);
    $last_block_size = count($data) % self::$full_block_size;
    $res_size = $full_block_count * self::$full_encoded_block_size + self::$encoded_block_sizes[$last_block_size];

    $res = array_fill(0, $res_size, 0);
    for ($i = 0; $i < $res_size; $i++) {
      $res[$i] = self::$alphabet[0];
    }

    for ($i = 0; $i < $full_block_count; $i++) {
      $res = self::encode_block(array_slice($data, $i * self::$full_block_size, ($i * self::$full_block_size + self::$full_block_size) - ($i * self::$full_block_size)), $res, $i * self::$full_encoded_block_size);
    }

    if ($last_block_size > 0) {
      $res = self::encode_block(array_slice($data, $full_block_count * self::$full_block_size, $full_block_count * self::$full_block_size + $last_block_size), $res, $full_block_count * self::$full_encoded_block_size);
    }

    return self::bin_to_str($res);
  }
  
  /**
   *
   * Convert a Base58 input to hexadecimal (Base16)
   *
   * @param    array    $data
   * @param    array    $buf
   * @param    integer  $index
   * @return   array
   *
   */
  public function decode_block($data, $buf, $index) {
    // TODO input validation

    $res_size = self::index_of(self::$encoded_block_sizes, count($data));
    // TODO throw error is $res_size <= 0

    $res_num = 0;
    $order = 1;
    for ($i = count($data) - 1; $i >= 0; $i--) {
      $digit = strpos(self::$alphabet, chr($data[$i]));
      // TODO throw error if $digit < 0

      $product = bcadd(bcmul($order, $digit), $res_num);
      // TODO throw error if $product > bcpow(2, 64)

      $res_num = $product;
      $order = bcmul($order, 58);
    }
    // TODO throw error $res_size < self::$full_block_size && bcpow(2, 8 * $res_size) <= 0
    $tmp_buf = self::uint64_to_8_be($res_num, $res_size);
    for ($i = 0; $i < count($tmp_buf); $i++) {
      $buf[$i + $index] = $tmp_buf[$i];
    }
    return $buf;
  }

  /**
   *
   * Decode a Base58 string to hexadecimal (Base16)
   *
   * @param    string  $hex  A Base58 string to convert to hexadecimal (Base16)
   * @return   string
   *
   */
  public function decode($enc) {
    // TODO input validation

    $enc = self::str_to_bin($enc);
    if (count($enc) == 0) {
      return '';
    }
    $full_block_count = floor(bcdiv(count($enc), self::$full_encoded_block_size));
    $last_block_size = bcmod(count($enc), self::$full_encoded_block_size);
    $last_block_decoded_size = self::index_of(self::$encoded_block_sizes, $last_block_size);
    // TODO throw arrow if $last_block_decoded_size < 0

    $data_size = $full_block_count * self::$full_block_size + $last_block_decoded_size;

    $data = array_fill(0, $data_size, 0);
    for ($i = 0; $i <= $full_block_count; $i++) {
      $data = self::decode_block(array_slice($enc, $i * self::$full_encoded_block_size, ($i * self::$full_encoded_block_size + self::$full_encoded_block_size) - ($i * self::$full_encoded_block_size)), $data, $i * self::$full_block_size);
    }

    if ($last_block_size > 0) {
      $data = decode_block(array_slice($enc, $full_block_count * self::$full_encoded_block_size, $full_block_count * self::$full_encoded_block_size + $last_block_size), $data, $full_block_count * self::$full_block_size);
    }

    return self::bin_to_hex($data);
    // return $data;
  }

  /**
   *
   * Search an array for a value
   * Source: https://stackoverflow.com/a/30994678
   *
   * @param    array   $haystack  An array to search
   * @param    string  $needle    A string to search for
   * @return   number             The index of the element found (or -1 for no match)
   *
   */
  private function index_of($array, $needle) {
    foreach ($array as $key => $value) if ($value === $needle) return $key;
    return -1;
  }
}

?>
