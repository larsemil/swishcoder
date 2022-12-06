# Swishcoder
### Small library to generate qr codes

## Installation

Install the package using composer.

```composer require larsemil/swishcoder```

## Using it

```
use larsemil\SwishCoder\SwishCoder;

$q = new SwishCoder();
        $q->payee('+46762216234')
        ->message([
            'value' => 'Order 3'
        ]) //message is optional
        ->amount(['value'=> 100]); //amount is optional

        $data = $q->get(); //gets the qrcode as image/png

```

## API

| Method | Parameter              | Description                 |
|--------|------------------------|-----------------------------|
| payee() | string with phonenumber| The number to send money to |
| amount()| array with parameters  | See [Api reference](https://developer.swish.nu/api/qr-codes/v2) |
| message() | array with parameters | See [Api reference](https://developer.swish.nu/api/qr-codes/v2) |
| size() | integer | The height and width of the returned image, measured in pixels. Must be between 1 and 2000. Defaults to 1000.|
| border() | integer | A number representing the size of the white border around the QR code. Measured approximately in the width of a single module (dot). Must be between 0 and 10. Defaults to 4. |
| get() | null | Get the actual data from swish |