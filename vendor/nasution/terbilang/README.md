# Terbilang

[![Build Status](https://travis-ci.org/mul14/terbilang-php.svg?branch=master)](https://travis-ci.org/mul14/terbilang-php)
[![Latest Stable Version](https://poser.pugx.org/nasution/terbilang/v/stable.svg)](https://packagist.org/packages/nasution/terbilang)
[![Total Downloads](https://poser.pugx.org/nasution/terbilang/downloads.svg)](https://packagist.org/packages/nasution/terbilang)
[![Latest Unstable Version](https://poser.pugx.org/nasution/terbilang/v/unstable.svg)](https://packagist.org/packages/nasution/terbilang)
[![License](https://poser.pugx.org/nasution/terbilang/license.svg)](https://github.com/mul14/terbilang-php/blob/master/LICENSE)

Convert numbers into words in Indonesian language.

## Installation

Run [composer](http://getcomposer.org) command

```bash
composer require nasution/terbilang
```

## Usage

Use `terbilang()` helper

```php
<?php

require 'vendor/autoload.php';

echo terbilang(421);                  // empat ratus dua puluh satu
```

Old examples

```php
<?php

require 'vendor/autoload.php';

$terbilang = new Nasution\Terbilang();
echo $terbilang->convert(234);        // dua ratus tiga puluh empat

// OR with static method

echo Nasution\Terbilang::convert(42); // empat puluh dua
```

You can import that class to make it more simple to called
```php
<?php

require 'vendor/autoload.php';

use Nasution\Terbilang;

$terbilang = new Terbilang();
echo $terbilang->convert(2014);    // dua ribu empat belas

// OR with static method

echo Terbilang::convert('123304'); // seratus dua puluh tiga ribu tiga ratus empat
```

Another examples

```php
echo Terbilang::convert('1000000');          // satu juta
echo Terbilang::convert('1000000000');       // satu milyar
echo Terbilang::convert('1000000000000');    // satu triliun
echo Terbilang::convert('1000000000000000'); // satu kuadriliun
```

You can also use dot notation to separate the numbers

```php
echo Terbilang::convert('1.300.000');       // satu juta tiga ratus ribu
echo Terbilang::convert('100.030.020.010'); // seratus milyar tiga puluh juta dua puluh ribu sepuluh
```
