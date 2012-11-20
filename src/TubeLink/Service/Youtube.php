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

        if (!isset($data['host'])) {
            return false;
        }

        if (false !== strpos($data['host'], 'youtube.')
            && in_array($data['path'], array('/watch', '/all_comments'))
            && isset($query['v'])
            && preg_match('#^[\w-]{11}$#', $query['v'])
        ) {
            $id = $query['v'];
        } elseif (false !== strpos($data['host'], 'youtu.be')
            && preg_match('#^/?[\w-]{11}/?$#', $data['path'])
        ) {
            $id = trim($data['path'], '/');
        } elseif (false != preg_match('/^www\.youtube(-nocookie)?\.com$/',$data['host'])
            && preg_match('{^/embed/([\w-]{11})}', $data['path'], $matches)
        ) {
            $id = $matches[1];
        } elseif (false != preg_match('/^www\.youtube(-nocookie)?\.com$/',$data['host'])
            && preg_match('{^/v/([\w-]{11})}', $data['path'], $matches)
        ) {
            $id = $matches[1];
        } elseif (false != preg_match('/^www\.youtube(-nocookie)?\.com$/',$data['host'])
            && preg_match('{^/p/([\w-]{16})}', $data['path'], $matches)
        ) {
            $id = $matches[1];
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
        return sprintf('http://www.youtube.com/embed/%s', $video->id);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'youtube';
    }
}
