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

class Vimeo implements ServiceInterface
{
    private $thumbnailSize;

    /**
     * Define the thumbnail size.
     *
     * Check the possible values of `thumbnail_*` here:
     * http://developer.vimeo.com/apis/simple#response-data
     *
     * @param  string     $thumbnailSize    Identifies which thumbnail size to use
     */
    public function __construct($thumbnailSize = 'thumbnail_large')
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
        if (false !== strpos($data['host'], 'vimeo.com')
            && preg_match('#^/(video/)?([0-9]+)?$#', $data['path'], $matches)
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
        return sprintf('http://player.vimeo.com/video/%s', $video->id);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'vimeo';
    }

    /**
     * Get the thumbnail from a given URL.
     *
     * @param Tube $video Tube object
     *
     * @return string Thumbnail url
     */
    public function getThumbnailUrl(Tube $video)
    {
        if (empty($this->thumbnailSize)) {
            return false;
        }

        $client = new Client('http://vimeo.com');

        try {
            $data = $client
                ->get(sprintf('/api/v2/video/%s.json', $video->id))
                ->send()
                ->json();
        } catch (\Exception $e) {
            return false;
        }

        return $data[0][$this->thumbnailSize];
    }
}
