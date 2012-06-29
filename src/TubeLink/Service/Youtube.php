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

class Youtube implements ServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data  = parse_url($url);
        $query = array();
        if (isset($data['query'])) {
            parse_str($data['query'], $query);
        }

        if (false !== strpos($data['host'], 'youtube.')
            && in_array($data['path'], array('/watch', '/all_comments'))
            && isset($query['v'])
            && preg_match('#^\w{11}$#', $query['v'])
        ) {
            $id = $query['v'];
        } elseif (false !== strpos($data['host'], 'youtu.be')
            && preg_match('#^/?\w{11}/?$#', $data['path'])
        ) {
            $id = trim($data['path'], '/');
        } elseif (false !== strpos($data['host'], 'youtube.com')
            && preg_match('{^/embed/(\w{11})}', $data['path'], $matches)
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
<iframe width="560" height="315" src="http://www.youtube.com/embed/{id}" frameborder="0" allowfullscreen></iframe>
HTML;

        return str_replace('{id}', $video->id, $html);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'youtube';
    }
}
