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

use TubeLink\Service\Dailymotion;
use TubeLink\Tube;

class DailymotionTest extends ServiceTestCase
{
    public function dataForTestParse()
    {
        return array(
            array('http://www.dailymotion.com/video/xrme0d_la-seance-du-mardi-ep22-un-bonheur-n-arrive-jamais-seul_shortfilms', 'xrme0d'),
            array('http://www.dailymotion.com/video/xr9av5', 'xr9av5'),
            array('http://www.dailymotion.com/embed/video/xrrwdr', 'xrrwdr'),
            array('http://www.dailymotion.com/swf/video/xg0vvh?width=500&theme=none&foreground=%23F7FFFD&highlight=%23FFC300&background=%23171D1B&start=&animatedTitle=&iframe=0&additionalInfos=0&autoPlay=0&hideInfos=0', 'xg0vvh'),
        );
    }

    public function dataForTestParseFalse()
    {
        return array(
            array('http://www.dailymotion.com/video/_'),
        );
    }

    public function dataForTestGenerateEmbedUrl()
    {
        return array(
            array('xrrwdr', 'http://www.dailymotion.com/embed/video/xrrwdr'),
        );
    }

    public function dataForTestThumbnailUrl()
    {
        return array(
            array('xrrwdr', 'http://s2.dmcdn.net/ecYc.jpg', 'thumbnail_url'),
            array('xrrwdr', 'http://s2.dmcdn.net/ecYc/x360-0qm.jpg', 'thumbnail_360_url'),
        );
    }

    public function dataForTestThumbnailUrlFalse()
    {
        return array(
            array('xrrwdr', ''),
            array('456456456', null),
        );
    }

    protected function getService($options = array())
    {
        return new Dailymotion($options);
    }

    /**
     * @dataProvider dataForTestThumbnailUrl
     */
    public function testGetThumbnailUrl($id, $thumbnailUrl, $thumbnailSize = 'thumbnail_url')
    {
        $service = $this->getService(array('thumbnail' => $thumbnailSize));
        $video = new Tube($service);
        $video->id = $id;

        $this->assertEquals($thumbnailUrl, $video->thumbnail());
    }
}
