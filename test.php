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

?>
