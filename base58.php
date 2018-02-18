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
  private $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';

  /**
   *
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
