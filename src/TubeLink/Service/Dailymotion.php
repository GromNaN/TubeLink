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

class Dailymotion implements ServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data  = parse_url($url);

        if (false !== strpos($data['host'], 'dailymotion.com')
            && preg_match('#^/video/([0-9a-z]+)(_[-_\w]+)?$#', $data['path'], $matches)
        ) {
            $id = $matches[1];
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
<iframe frameborder="0" width="560" height="245" src="http://www.dailymotion.com/embed/video/{id}"></iframe>
HTML;

        return str_replace('{id}', $video->id, $html);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dailymotion';
    }
}
