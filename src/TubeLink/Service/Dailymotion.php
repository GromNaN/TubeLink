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
use Guzzle\Http\Client;

class Dailymotion implements ServiceInterface
{
    private $thumbnailSize;

    /**
     * Define the thumbnail size.
     *
     * Check the possible values of `thumbnail_*_url` here:
     * http://www.dailymotion.com/doc/api/obj-video.html
     *
     * @param  string     $thumbnailSize    Identifies which thumbnail size to use
     */
    public function __construct($thumbnailSize = 'thumbnail_url')
    {
        $this->thumbnailSize = $thumbnailSize;
    }

    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data  = parse_url($url);
        if (empty($data['host'])) {
          return false;
        }
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

    /**
     * {@inheritDoc}
     */
    public function getThumbnailUrl(Tube $video)
    {
        if (empty($this->thumbnailSize)) {
            return false;
        }

        $client = new Client('https://api.dailymotion.com');

        try {
            $data = $client
                ->get(sprintf('/video/%s?fields=%s', $video->id, $this->thumbnailSize))
                ->send()
                ->json();
        } catch (\Exception $e) {
            return false;
        }

        return $data[$this->thumbnailSize];
    }
}
