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

    protected function getService()
    {
        return new Dailymotion();
    }
}
