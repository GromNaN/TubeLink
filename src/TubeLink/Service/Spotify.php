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

class Spotify implements ServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data  = parse_url($url);
        if (empty($data['host'])) {
          return false;
        }
        if (false !== strpos($data['host'], 'embed.spotify.com')
            && isset($data['query'])
            && preg_match('#^uri=spotify:([0-9a-zA-Z:]+)$#', $data['query'], $matches)) {
            $id = $matches[1];
        } else if (false !== strpos($data['host'], 'open.spotify.com')
          && preg_match('#^/([0-9a-zA-Z/]+)$#', $data['path'], $matches)) {
            $id = str_replace('/', ':', $matches[1]);
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
        return sprintf('https://embed.spotify.com/?uri=spotify:%s', $video->id);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'spotify';
    }

    /**
     * {@inheritDoc}
     */
    public function getThumbnailUrl(Tube $video)
    {
        // Not implemented
        return false;
    }
}
