# Omnipay: Any.Money

[Any.Money](https://any.money) payment processing driver for the Omnipay PHP payment processing library.

## Installation

The preferred way to install this library is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require phuong17889/omnipay-anymoney "*"
```

or add

```
"phuong17889/omnipay-anymoney": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

The following gateways are provided by this package:

#### Init Any.Money

```php
    $gateway = \Omnipay\Omnipay::create(\Omnipay\AnyMoney\Gateway::NAME);
    $gateway->initialize([
        'api_key'  => $API_KEY,
        'merchant' => $MERCHANT,
    ]);
```

### Authentication
Detail: https://docs.any.money/en/auth/
#### Get Balance

```php
    $balance = $gateway->balance(['curr'=>'USD'])->send();
    if($balance->isSuccessful()){
        var_dump($balance->getResult());
    } else {
        var_dump($balance->getError());
        var_dump($balance->getMessage());
    }
```

### Invoice
Detail: https://docs.any.money/en/invoice/
#### Create invoice

```php
    $invoice = $gateway->invoice([
        'amount'     => 10,
        'externalid' => '1001',//must be unique each call
        'in_curr'    => 'USD',
    ])->create();
    if($invoice->isSuccessful()){
        var_dump($balance->getRedirectUrl());
        var_dump($balance->getData());
    } else {
        var_dump($balance->getError());
        var_dump($balance->getMessage());
    }
```

#### Calc invoice

```php
    $invoice = $gateway->invoice([
        'amount'     => 10,
        'in_curr'    => 'USD',
    ])->calc();
    if($invoice->isSuccessful()){
        var_dump($balance->getResult());
    } else {
        var_dump($balance->getError());
        var_dump($balance->getMessage());
    }
```

#### Get invoice

```php
    $invoice = $gateway->invoice([
        'externalid' => '1001',
    ])->get();
    if($invoice->isSuccessful()){
        var_dump($balance->getResult());
    } else {
        var_dump($balance->getError());
        var_dump($balance->getMessage());
    }
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project, or ask more detailed questions,
there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which you can subscribe to.

If you believe you have found a bug, please report it using
the [GitHub issue tracker](https://github.com/phuong17889/omnipay-anymoney/issues).
