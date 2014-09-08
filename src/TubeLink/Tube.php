<?php
/*
 * This file is part of the TubeLink package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @licence MIT
 */

namespace TubeLink;

use TubeLink\Service\ServiceInterface;

/**
 * Tube.
 *
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
class Tube
{
    public $id;

    /**
     * @var ServiceInterface
     */
    private $service;

    /**
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Render the HTML for the embedded video player
     *
     * @return string
     */
    public function render(array $options = array())
    {
        $url = $this->service->generateEmbedUrl($this);
        $options = array_replace(array(
            'width' => 560,
            'height' => 315,
            'frameborder' => 0,
            'allowfullscreen' => ''
        ), $options);

        $html = <<<HTML
<iframe src="$url" width="{$options['width']}" height="{$options['height']}" frameborder="{$options['frameborder']}" {$options['allowfullscreen']}></iframe>
HTML;
        return $html;
    }

    /**
     * Retrun the preview of the video (the thumbnail)
     *
     * @return string
     */
    public function thumbnail()
    {
        return $this->service->getThumbnailUrl($this);
    }

    /**
     * @return ServiceInterface
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return string "{service}/{id}"
     */
    public function __toString()
    {
        return sprintf('%s/%s', $this->service->getName(), $this->id);
    }
}
