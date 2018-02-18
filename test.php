<?php

include('base58.php');

$base58 = new Base58;

$input = (isset($_REQUEST['input']) ? $_REQUEST['input'] : '0123456789ABCDEF');

$encoded = $base58->encode($input);
$decoded = $base58->decode($encoded);

if ($input == '0123456789ABCDEF') { // Should encode to 'C3CPq7c8PY'
  $encoded .= ($encoded == 'C3CPq7c8PY' ? ' (success)' : ' (failure)');
  $decoded .= ($decoded == $input ? ' (success)' : ' (failure)');
}

echo "<table style='font-family: monospace;'>
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
</table>";

?>
