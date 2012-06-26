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
 * Video.
 *
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
class Video
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
    public function render()
    {
        return $this->service->html($this);
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
