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

use TubeLink\Service\Vimeo;
use TubeLink\Tube;

class VimeoTest extends ServiceTestCase
{
    public function dataForTestParse()
    {
        return array(
            array('http://vimeo.com/15247292', '15247292'),
            array('http://player.vimeo.com/video/15247292?title=0&amp;byline=0&amp;portrait=0&amp;color=bababa', '15247292'),
        );
    }

    public function dataForTestParseFalse()
    {
        return array(
            array('http://vimeo.com/explore'),
        );
    }

    public function dataForTestGenerateEmbedUrl()
    {
        return array(
            array('15247292', 'http://player.vimeo.com/video/15247292'),
        );
    }

    public function dataForTestThumbnailUrl()
    {
        return array(
            array('15247292', 'http://b.vimeocdn.com/ts/915/096/91509642_640.jpg', 'thumbnail_large'),
            array('15247292', 'http://b.vimeocdn.com/ts/915/096/91509642_100.jpg', 'thumbnail_small'),
        );
    }

    public function dataForTestThumbnailUrlFalse()
    {
        return array(
            array('15247292', ''),
            array('99999999', 'thumbnail_large'),
        );
    }

    protected function getService($options = array())
    {
        return new Vimeo($options);
    }

    /**
     * @dataProvider dataForTestThumbnailUrl
     */
    public function testGetThumbnailUrl($id, $thumbnailUrl, $thumbnailSize = 'thumbnail_large')
    {
        $service = $this->getService(array('thumbnail' => $thumbnailSize));
        $video = new Tube($service);
        $video->id = $id;

        $this->assertEquals($thumbnailUrl, $video->thumbnail());
    }
}
