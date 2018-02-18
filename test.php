<?php

include('base58.php');

$base58 = new Base58;

$input = (isset($_REQUEST['input']) ? $_REQUEST['input'] : '0123456789ABCDEF');

$encoded = $base58->encode($input);
$decoded = $base58->decode($encoded);

if ($input == '0123456789ABCDEF') { // Should encode to 'C3CPq7c8PY'
  $encoded .= ($encoded == 'C3CPq7c8PY' ? ' (pass)' : ' (fail)');
  $decoded .= ($decoded == $input ? ' (pass)' : ' (fail)');
}

echo "<body style='font-family: monospace;'><table>
  <tr>
    <td style='text-align: right;'>Input string:</td>
    <td>{$input}</td>
  </tr>
  <tr style='text-align: right;'>
    <td>Encoded:</td>
    <td>{$encoded}</td>
  </tr>
  <tr style='text-align: right;'>
    <td>Decoded:</td>
    <td>{$decoded}</td>
  </tr>
</table><br>";

$hex_to_bin = ($base58->hex_to_bin('E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262') === [233, 135, 61, 121, 198, 216, 125, 192, 251, 106, 87, 120, 99, 51, 137, 244, 69, 50, 19, 48, 61, 166, 31, 32, 189, 103, 252, 35, 58, 163, 50, 98] ? 'pass' : 'fail');
echo "hex_to_bin(): {$hex_to_bin}<br>";

$bin_to_hex = (strtolower($base58->bin_to_hex([233, 135, 61, 121, 198, 216, 125, 192, 251, 106, 87, 120, 99, 51, 137, 244, 69, 50, 19, 48, 61, 166, 31, 32, 189, 103, 252, 35, 58, 163, 50, 98])) === strtolower('E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262') ? 'pass' : 'fail');
echo "bin_to_hex(): {$bin_to_hex}<br>";

$str_to_bin = ($base58->str_to_bin('E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262') === [69, 57, 56, 55, 51, 68, 55, 57, 67, 54, 68, 56, 55, 68, 67, 48, 70, 66, 54, 65, 53, 55, 55, 56, 54, 51, 51, 51, 56, 57, 70, 52, 52, 53, 51, 50, 49, 51, 51, 48, 51, 68, 65, 54, 49, 70, 50, 48, 66, 68, 54, 55, 70, 67, 50, 51, 51, 65, 65, 51, 51, 50, 54, 50] ? 'pass' : 'fail');
echo "str_to_bin(): {$str_to_bin}<br>";

?>
