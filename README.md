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

#### `encode`
Encode a hexadecimal (Base16) string to Base58

    @param    string  $hex  A hexadecimal (Base16) string to convert to Base58
    @return   string

#### `decode`
Decode a Base58 string to hexadecimal (Base16)

    @param    string  $hex  A Base58 string to convert to hexadecimal (Base16)
    @return   string
