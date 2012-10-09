<?php
/*
 * This file is part of the TubeLink package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @licence MIT
 */

namespace TubeLink\Tests;

use TubeLink\TubeLink;
use TubeLink\Service\Youtube;

class TubeLinkTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $video = $this->getTubeLink()->parse('http://www.youtu.be/gHYfY9lZaRE');

        $this->assertInstanceOf('\TubeLink\Tube', $video);
        $this->assertEquals('youtube', $video->getService()->getName());
    }

    /**
     * @expectedException \TubeLink\Exception\ServiceNotFoundException
     */
    public function testParseException()
    {
        $this->getTubeLink()->parse('http://www.google.fr/');
    }

    protected function getTubeLink()
    {
        $detective = new TubeLink();
        $detective->registerService(new Youtube());

        return $detective;
    }
}
