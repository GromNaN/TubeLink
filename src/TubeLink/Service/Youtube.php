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
    private $thumbnailSize;

    /**
     * Define the thumbnail size.
     *
     * Check the possible values of `yt:name` here:
     * https://developers.google.com/youtube/2.0/reference#youtube_data_api_tag_media:thumbnail
     *
     * @param  array     $options
     *                      - thumbnail: Identifies which thumbnail size to use (default: hqdefault)
     */
    public function __construct($options = array())
    {
        $this->thumbnailSize = isset($options['thumbnail']) ? $options['thumbnail'] : 'hqdefault';
    }

    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        $data = parse_url($url);

        if (empty($data['host'])) {
            return false;
        }

        $query = array();
        if (isset($data['query'])) {
            parse_str($data['query'], $query);
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

    /**
     * Get the thumbnail from a given URL.
     *
     * @param Tube $video Tube object
     *
     * @return string Thumbnail url
     */
    public function getThumbnailUrl(Tube $video)
    {
        if (0 === strlen($this->thumbnailSize)) {
            return false;
        }

        return sprintf('http://img.youtube.com/vi/%s/%s.jpg', $video->id, $this->thumbnailSize);
    }
}
