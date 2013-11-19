<?php
/*
 * This file is part of the TubeLink package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @licence MIT
 */

namespace TubeLink\Tests\Service;

use TubeLink\Service\Spotify;

class SpotifyTest extends ServiceTestCase
{
    public function dataForTestParse()
    {
        return array(
            array('https://embed.spotify.com/?uri=spotify:album:7EgUEPvAqbLAHH3T60QLnW', 'album:7EgUEPvAqbLAHH3T60QLnW'),
            array('https://embed.spotify.com/?uri=spotify:track:4bz7uB4edifWKJXSDxwHcs', 'track:4bz7uB4edifWKJXSDxwHcs'),
            array('http://open.spotify.com/album/4pT0rlFvHYc46KyEhmCy88', 'album:4pT0rlFvHYc46KyEhmCy88'),
        );
    }

    public function dataForTestParseFalse()
    {
        return array(
            array('http://open.spotify.com/album/-'),
        );
    }

    public function dataForTestGenerateEmbedUrl()
    {
        return array(
            array('track:4bz7uB4edifWKJXSDxwHcs', 'https://embed.spotify.com/?uri=spotify:track:4bz7uB4edifWKJXSDxwHcs'),
        );
    }

    public function dataForTestThumbnailUrlFalse()
    {
        return array(
            array('track:4bz7uB4edifWKJXSDxwHcs', ''),
        );
    }

    protected function getService()
    {
        return new Spotify();
    }
}
