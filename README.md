TubeLink - Parse any video URL
===============================

**TubeLink** is a PHP library to extract video information from any URL.

Supported Services
------------------

For each video-sharing website of the following list, a _Service_ class can identify
a supported URL and extract the video ID.

* [Youtube](http://www.youtube.com/)
* ... more to come


Installation
============

The recommended way to install TubeLink is through composer.

Just create a `composer.json` file for your project:

``` json
{
    "require": {
        "grom/tube-link": "dev-master"
    }
}
```

And run these two commands to install it:

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```


Now you can add the autoloader, and you will have access to the library:

``` php
require 'vendor/autoload.php';
```

If you don't use neither **Composer** nor a _ClassLoader_ in your application, just require the provided autoloader:

``` php
require_once 'src/autoload.php';
```

You're done.

Usage
=====



``` php
use TubeLink\TubeLink;

$url = 'http://youtu.be/kffacxfA7G4';

$parser = new TubeLink();
$parser->registerService(new TubeLink\Service\Youtube());

$video = $parser->parse($url);

// Shows the embedded video HTML
echo $video->render();
```
