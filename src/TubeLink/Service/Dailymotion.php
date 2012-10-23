<?php
/*
 * This file is part of the TubeLink package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @licence MIT
 */

namespace TubeLink\Service;

use TubeLink\Tube;

class Dailymotion implements ServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data  = parse_url($url);

        if (false !== strpos($data['host'], 'dailymotion.com')
            && preg_match('#^(/embed)?/video/([0-9a-z]+)(_[-_\w]+)?$#', $data['path'], $matches)
        ) {
            $id = $matches[2];
        } else if (false !== strpos($data['host'], 'dailymotion.com')
            && preg_match('#^(/embed)?/swf/video/([0-9a-z]+)(_[-_\w]+)?$#', $data['path'], $matches)
        ) {
            $id = $matches[2];
        } else {
            return false;
        }

        $video = new Tube($this);
        $video->id = $id;

        return $video;
    }

    /**
     * {@inheritDoc}
     */
    public function generateEmbedUrl(Tube $video)
    {
        return sprintf('http://www.dailymotion.com/embed/video/%s', $video->id);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dailymotion';
    }
}
