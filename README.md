## Gdpro Monolog

### Introduction

The repository adds support for logging to Monolog to the Zend Framework 2.


### Changelog

[doc/CHANGELOG.md](doc/CHANGELOG.md)


### Requirements

Please see the [composer.json](composer.json) file.


### Installation

Run the following `composer` command:

```console
$ composer require "gdpro/gdpro-monolog:~1.0"
```

Alternately, manually add the following to your `composer.json`, in
the `require` section:

```javascript
"require": {
    "gdpro/gdpro-monolog": "~1.0"
}
```

And then run `composer update` to ensure the module is installed.

Finally, add the module name to your project's `config/application.config.php`
under the `modules` key:

```php
return array(
    /* ... */
    'modules' => array(
        /* ... */
        'GdproMonolog',
    ),
    /* ... */
);
```


### Documentation

By Default the monolog logging will log your error event and add them to the log files
  - data/log/route.error.log
  - data/log/dispatch.error.log
  - data/log/


### Utilisation

#### Default Logger
<code php>
    $this->getServiceLocator()->get('gdpro-monolog_default')->addDebug('hello world');
</code>


#### Exception Logger
<code php>
    $this->getServiceLocator()->get('my_awesome_customized_logger')->addDebug('hello world');
</code>

