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

abstract class ServiceTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataForTestParse
     */
    public function testParse($url, $id)
    {
        $video = $this->getService()->parse($url);

        $this->assertInstanceOf('\TubeLink\Video', $video);
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

    abstract public function dataForTestParse();

    abstract public function dataForTestParseFalse();

    abstract protected function getService();
}
