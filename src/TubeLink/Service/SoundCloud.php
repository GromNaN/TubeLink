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

class SoundCloud implements ServiceInterface
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
        if (false !== strpos($data['host'], 'soundcloud.com') && isset($data['query'])) {
          $queryFields = array();
           parse_str($data['query'], $queryFields);
           if (isset($queryFields['url']) && preg_match('#http://api.soundcloud.com/([^&]*)#', $queryFields['url'], $matches)) {
             $id = $matches[1];
           } else {
             return false;
           }
        } else {
            return false;
        }

        $tube = new Tube($this);
        $tube->id = $id;

        return $tube;
    }

    /**
     * {@inheritDoc}
     */
    public function generateEmbedUrl(Tube $video)
    {
        return 'http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2F'.urlencode($video->id);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'soundcloud';
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
