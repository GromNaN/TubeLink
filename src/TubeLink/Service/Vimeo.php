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

use TubeLink\Video;

class Vimeo implements ServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data  = parse_url($url);

        if (false !== strpos($data['host'], 'vimeo.com')
            && preg_match('#^/(video/)?([0-9]+)?$#', $data['path'], $matches)
        ) {
            $id = $matches[2];
        } else {
            return false;
        }

        $video = new Video($this);
        $video->id = $id;

        return $video;
    }

    /**
     * {@inheritDoc}
     */
    public function html(Video $video)
    {
        $html = <<<HTML
<iframe src="http://player.vimeo.com/video/{id}?title=0&amp;byline=0&amp;portrait=0&amp;color=bababa" width="560" height="420" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
HTML;

        return str_replace('{id}', $video->id, $html);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'vimeo';
    }
}
