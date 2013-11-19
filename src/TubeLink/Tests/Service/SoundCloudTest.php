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

use TubeLink\Service\SoundCloud;

class SoundCloudTest extends ServiceTestCase
{
    public function dataForTestParse()
    {
        return array(
            array('http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Fplaylists%2F1482008&show_artwork=true', 'playlists/1482008'),
            array('https://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F17373708', 'tracks/17373708'),
        );
    }

    public function dataForTestParseFalse()
    {
        return array(
            array('http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com'),
        );
    }

    public function dataForTestGenerateEmbedUrl()
    {
        return array(
            array('tracks/17373708', 'http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F17373708'),
        );
    }

    public function dataForTestThumbnailUrlFalse()
    {
        return array(
            array('tracks/17373708', ''),
        );
    }

    protected function getService()
    {
        return new SoundCloud();
    }
}
