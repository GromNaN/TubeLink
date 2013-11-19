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

use TubeLink\Tube;

abstract class ServiceTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataForTestParse
     */
    public function testParse($url, $id)
    {
        $video = $this->getService()->parse($url);

        $this->assertInstanceOf('\TubeLink\Tube', $video);
        $this->assertEquals($id, $video->id);
    }

    /**
     * @dataProvider dataForTestParseFalse
     */
    public function testParseFalse($url)
    {
        $video = $this->getService()->parse($url);

        $this->assertSame(false, $video);
    }

    /**
     * @dataProvider dataForTestGenerateEmbedUrl
     */
    public function testGenerateEmbedUrl($id, $url)
    {
        $service = $this->getService();
        $video = new Tube($service);
        $video->id = $id;

        $this->assertEquals($url, $service->generateEmbedUrl($video));
    }

    /**
     * @dataProvider dataForTestThumbnailUrlFalse
     */
    public function testGetThumbnailUrlFalse($id, $thumbnailSize)
    {
        $service = $this->getService(array('thumbnail' => $thumbnailSize));
        $video = new Tube($service);
        $video->id = $id;

        $this->assertFalse($video->thumbnail());
    }

    abstract public function dataForTestParse();

    abstract public function dataForTestParseFalse();

    abstract public function dataForTestGenerateEmbedUrl();

    abstract public function dataForTestThumbnailUrlFalse();

    abstract protected function getService();
}
