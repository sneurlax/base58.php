# base58.php
Base58 PHP codec for use with CryptoNote cryptocurrencies like Monero

## Usage

```php
include('base58.php');

$base58 = new Base58;

$base58->encode('129f5a5c1545dc3a1db567154121878f08f8572cdf45e5549c624fb3f01fbd274690716e09edf5658cb0c2be87e067149ff6ccdbe6a909eeb65db22a8e6d2eb5ce3f8c3d80');
// Should equal '47fMeiDeVkd5yDDiDZY4RU2W2Dh8GyAuyTA81xDwAnyUCoZZex6SEWgQXsgVrYvFk7TkrQSFcqBBKXWBMwi3sDzCQGciKFM'
```

### Methods

#### `hex_to_bin`
Convert a hexadecimal string to a binary array

    @param    string  $hex  A hexadecimal string to convert to a binary array
    @return   array

#### `bin_to_hex`
Convert a binary array to a hexadecimal string

    @param    array   $bin  A binary array to convert to a hexadecimal string
    @return   string

#### `str_to_bin`
Convert a string to a binary array

    @param    string   $str  A string to convert to a binary array
    @return   array

#### `bin_to_str`
Convert a binary array to a string

    @param    array   $bin  A binary array to convert to a string
    @return   string

#### `uint8_be_to_64`
Convert a UInt8BE (one unsigned big endian byte) array to UInt64

    @param    array   $data  A UInt8BE array to convert to UInt64
    @return   number

#### `uint64_to_8_be`
Convert a UInt64 (unsigned 64 bit integer) to a UInt8BE array

    @param    number   $num   A UInt64 number to convert to a UInt8BE array
    @param    integer  $size  Size of array to return
    @return   array

#### `encode_block`
Convert a hexadecimal (Base16) array to a Base58 string

    @param    array   $data
    @param    array   $buf
    @param    number  $index 
    @return   array

#### `encode`
Encode a hexadecimal (Base16) string to Base58

    @param    string  $hex  A hexadecimal (Base16) string to convert to Base58
    @return   string

#### `decode_block`
Convert a Base58 input to hexadecimal (Base16)

    @param    array    $data
    @param    array    $buf
    @param    integer  $index
    @return   array

#### `decode`
Decode a Base58 string to hexadecimal (Base16)

    @param    string  $hex  A Base58 string to convert to hexadecimal (Base16)
    @return   string
