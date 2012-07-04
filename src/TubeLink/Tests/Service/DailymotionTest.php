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

class DailymotionTest extends ServiceTestCase
{
    public function dataForTestParse()
    {
        return array(
            array('http://www.dailymotion.com/video/xrme0d_la-seance-du-mardi-ep22-un-bonheur-n-arrive-jamais-seul_shortfilms', 'xrme0d'),
            array('http://www.dailymotion.com/video/xr9av5', 'xr9av5'),
            array('http://www.dailymotion.com/embed/video/xrrwdr', 'xrrwdr'),
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

    protected function getService()
    {
        return new Dailymotion();
    }
}
