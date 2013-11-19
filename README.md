TubeLink - Parse any video URL
===============================

**TubeLink** is a PHP library to extract identifier from any URL of video / music / ...

Supported Services
------------------

For each video-sharing website of the following list, a _Service_ class can identify
a supported URL and extract the video ID.

* [Youtube](http://www.youtube.com/)
* [Dailymotion](http://www.dailymotion.com/)
* [Vimeo](http://www.vimeo.com/)
* [Spotify](http://www.spotify.com/)
* [SoundCloud](http://soundcloud.com/)
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
$parser->registerService(new \TubeLink\Service\Youtube());

$tube = $parser->parse($url);

// Shows the embedded video HTML
echo $tube->render();

// Return the thumbnail
echo $tube->thumbnail();
```

Image Preview
=============

This feature is only available for these services:

* Youtube
* Dailymotion
* Vimeo
