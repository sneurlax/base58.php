<?php

include('base58.php');

$base58 = new Base58;

$input = (isset($_REQUEST['input']) ? $_REQUEST['input'] : 'E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262');

$encoded = $base58->encode($input);
$decoded = $base58->decode($encoded);

if ($input == 'E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262') { // Should encode to 'g4Wyj92J6uDj43ZzDGyFRVCaHUYRTj1WXYgUggXVNR5K'
  $encoded .= ($encoded == 'g4Wyj92J6uDj43ZzDGyFRVCaHUYRTj1WXYgUggXVNR5K' ? ' (pass)' : ' (fail)');
  $decoded .= ($decoded == strtolower($input) ? ' (pass)' : ' (fail)');
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

$bin_to_str = ($base58->bin_to_str([69, 57, 56, 55, 51, 68, 55, 57, 67, 54, 68, 56, 55, 68, 67, 48, 70, 66, 54, 65, 53, 55, 55, 56, 54, 51, 51, 51, 56, 57, 70, 52, 52, 53, 51, 50, 49, 51, 51, 48, 51, 68, 65, 54, 49, 70, 50, 48, 66, 68, 54, 55, 70, 67, 50, 51, 51, 65, 65, 51, 51, 50, 54, 50]) === 'E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262' ? 'pass' : 'fail');
echo "bin_to_str(): {$bin_to_str}<br>";

$uint8_be_to_64 = ($base58->uint8_be_to_64([251, 106, 87, 120, 99, 51, 137, 244]) === '18116388625623255540' ? 'pass' : 'fail');
echo "uint8_be_to_64(): {$uint8_be_to_64}<br>";

$uint64_to_8_be = ($base58->uint64_to_8_be('18116388625623255540', 8) == [251, 106, 87, 120, 99, 51, 137, 244] ? 'pass' : 'fail');
echo "uint64_to_8_be(): {$uint64_to_8_be}<br>";

$encode_block = ($base58->encode_block([251, 106, 87, 120, 99, 51, 137, 244], [49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49], 11) == [49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 106, 52, 51, 90, 122, 68, 71, 121, 70, 82, 86, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49] ? 'pass' : 'fail');
echo "encode_block(): {$encode_block}<br>";

$encode = ($base58->encode('E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262') === 'g4Wyj92J6uDj43ZzDGyFRVCaHUYRTj1WXYgUggXVNR5K' ? 'pass' : 'fail');
echo "encode(): {$encode}<br>";

$decode_block = ($base58->decode_block([106, 52, 51, 90, 122, 68, 71, 121, 70, 82, 86], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 8) == [0, 0, 0, 0, 0, 0, 0, 0, 251, 106, 87, 120, 99, 51, 137, 244, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] ? 'pass' : 'fail');
echo "decode_block(): {$decode_block}<br>";

$decode = (strtolower($base58->decode('g4Wyj92J6uDj43ZzDGyFRVCaHUYRTj1WXYgUggXVNR5K')) === strtolower('E9873D79C6D87DC0FB6A5778633389F4453213303DA61F20BD67FC233AA33262') ? 'pass' : 'fail');
echo "decode(): {$decode}<br>";

?>
