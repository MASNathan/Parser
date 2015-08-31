# Parser

[![Latest Version on Packagist](https://img.shields.io/packagist/v/masnathan/parser.svg?style=flat-square)](https://packagist.org/packages/masnathan/parser)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/MASNathan/Parser/master.svg?style=flat-square)](https://travis-ci.org/MASNathan/Parser)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/masnathan/parser.svg?style=flat-square)](https://scrutinizer-ci.com/g/masnathan/parser/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/masnathan/parser.svg?style=flat-square)](https://scrutinizer-ci.com/g/masnathan/parser)
[![Total Downloads](https://img.shields.io/packagist/dt/masnathan/parser.svg?style=flat-square)](https://packagist.org/packages/masnathan/parser)
[![Support via Gittip](https://img.shields.io/gittip/ReiDuKuduro.svg?style=flat-square)](https://gratipay.com/~ReiDuKuduro/)

Global data type parser

## Install

Via Composer

``` bash
$ composer require masnathan/parser
```

## Usage

``` php
use MASNathan\Parser\Parser;

$data = array(
    'foo' => 'bar',
    'sup' => 'World'
);

$content = Parser::data($data);
$content->setPrettyOutput(true);

echo $content->to('json'); // outputs in json format
echo $content->to('xml'); // outputs in xml format
```

And also...

```php
$content = Parser::file('path/to/my/file.json')->from('json');

echo $content->to('xml'); // outputs in xml format

// or
echo Parser::file('path/to/my/file.xml')
		->from('xml')
		->setPrettyOutput(true)
		->to('yaml');

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email andre.r.flip@gmail.com instead of using the issue tracker.

## Credits

- [André Filipe](https://github.com/masnathan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
