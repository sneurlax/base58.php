<?php

include('base58.php');

$base58 = new Base58;

$input = (isset($_REQUEST['input']) ? $_REQUEST['input'] : '129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80');

$encoded = $base58->encode($input);
$decoded = $base58->decode($encoded);

if ($input == '129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80') {
  $encoded .= ($encoded == '47fMeiDeVkd5yDDiDZY4RU2W2Dh8GyAuyTA81xDwAnyUCoZZex6SEWgQXsgVrYvFk7TkrQSFcqBBKXWBMwi3sDzCQGciKFM' ? ' (pass)' : ' (fail)');
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

$hex_to_bin = ($base58->hex_to_bin('129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80') === [18, 159, 90, 92, 21, 69, 220, 58, 29, 181, 103, 21, 65, 33, 135, 143, 8, 248, 87, 44, 223, 69, 229, 84, 156, 98, 79, 179, 240, 31, 189, 39, 70, 144, 113, 110, 9, 237, 245, 101, 140, 176, 194, 190, 135, 224, 103, 20, 159, 246, 204, 219, 230, 169, 9, 238, 182, 93, 178, 42, 142, 109, 46, 181, 206, 63, 140, 61, 128] ? 'pass' : 'fail');
echo "hex_to_bin(): {$hex_to_bin}<br>";

$bin_to_hex = (strtolower($base58->bin_to_hex([18, 159, 90, 92, 21, 69, 220, 58, 29, 181, 103, 21, 65, 33, 135, 143, 8, 248, 87, 44, 223, 69, 229, 84, 156, 98, 79, 179, 240, 31, 189, 39, 70, 144, 113, 110, 9, 237, 245, 101, 140, 176, 194, 190, 135, 224, 103, 20, 159, 246, 204, 219, 230, 169, 9, 238, 182, 93, 178, 42, 142, 109, 46, 181, 206, 63, 140, 61, 128])) === strtolower('129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80') ? 'pass' : 'fail');
echo "bin_to_hex(): {$bin_to_hex}<br>";

$str_to_bin = ($base58->str_to_bin('129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80') === [49, 50, 57, 102, 53, 97, 53, 99, 49, 53, 52, 53, 100, 99, 51, 97, 49, 100, 98, 53, 54, 55, 49, 53, 52, 49, 50, 49, 56, 55, 56, 102, 48, 56, 102, 56, 53, 55, 50, 99, 100, 102, 52, 53, 101, 53, 53, 52, 57, 99, 54, 50, 52, 102, 98, 51, 102, 48, 49, 102, 98, 100, 50, 55, 52, 54, 57, 48, 55, 49, 54, 101, 48, 57, 101, 100, 102, 53, 54, 53, 56, 99, 98, 48, 99, 50, 98, 101, 56, 55, 101, 48, 54, 55, 49, 52, 57, 102, 102, 54, 99, 99, 100, 98, 101, 54, 97, 57, 48, 57, 101, 101, 98, 54, 53, 100, 98, 50, 50, 97, 56, 101, 54, 100, 50, 101, 98, 53, 99, 101, 51, 102, 56, 99, 51, 100, 56, 48] ? 'pass' : 'fail');
echo "str_to_bin(): {$str_to_bin}<br>";

$bin_to_str = ($base58->bin_to_str([49, 50, 57, 102, 53, 97, 53, 99, 49, 53, 52, 53, 100, 99, 51, 97, 49, 100, 98, 53, 54, 55, 49, 53, 52, 49, 50, 49, 56, 55, 56, 102, 48, 56, 102, 56, 53, 55, 50, 99, 100, 102, 52, 53, 101, 53, 53, 52, 57, 99, 54, 50, 52, 102, 98, 51, 102, 48, 49, 102, 98, 100, 50, 55, 52, 54, 57, 48, 55, 49, 54, 101, 48, 57, 101, 100, 102, 53, 54, 53, 56, 99, 98, 48, 99, 50, 98, 101, 56, 55, 101, 48, 54, 55, 49, 52, 57, 102, 102, 54, 99, 99, 100, 98, 101, 54, 97, 57, 48, 57, 101, 101, 98, 54, 53, 100, 98, 50, 50, 97, 56, 101, 54, 100, 50, 101, 98, 53, 99, 101, 51, 102, 56, 99, 51, 100, 56, 48]) === '129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80' ? 'pass' : 'fail');
echo "bin_to_str(): {$bin_to_str}<br>";

$uint8_be_to_64 = ($base58->uint8_be_to_64([251, 106, 87, 120, 99, 51, 137, 244]) === '18116388625623255540' ? 'pass' : 'fail');
echo "uint8_be_to_64(): {$uint8_be_to_64}<br>";

$uint64_to_8_be = ($base58->uint64_to_8_be('18116388625623255540', 8) == [251, 106, 87, 120, 99, 51, 137, 244] ? 'pass' : 'fail');
echo "uint64_to_8_be(): {$uint64_to_8_be}<br>";

$encode_block = ($base58->encode_block([251, 106, 87, 120, 99, 51, 137, 244], [49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49], 11) == [49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 106, 52, 51, 90, 122, 68, 71, 121, 70, 82, 86, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49, 49] ? 'pass' : 'fail');
echo "encode_block(): {$encode_block}<br>";

$encode = ($base58->encode('129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80') === '47fMeiDeVkd5yDDiDZY4RU2W2Dh8GyAuyTA81xDwAnyUCoZZex6SEWgQXsgVrYvFk7TkrQSFcqBBKXWBMwi3sDzCQGciKFM' ? 'pass' : 'fail');
echo "encode(): {$encode}<br>";

$decode_block = ($base58->decode_block([106, 52, 51, 90, 122, 68, 71, 121, 70, 82, 86], [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0], 8) == [0, 0, 0, 0, 0, 0, 0, 0, 251, 106, 87, 120, 99, 51, 137, 244, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] ? 'pass' : 'fail');
echo "decode_block(): {$decode_block}<br>";

$decode = (strtolower($base58->decode('47fMeiDeVkd5yDDiDZY4RU2W2Dh8GyAuyTA81xDwAnyUCoZZex6SEWgQXsgVrYvFk7TkrQSFcqBBKXWBMwi3sDzCQGciKFM')) === strtolower('129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80') ? 'pass' : 'fail');
echo "decode(): {$decode}<br>";

?>
