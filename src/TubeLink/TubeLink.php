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
use TubeLink\Exception\ServiceNotFoundException;

/**
 * Video.
 *
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
class TubeLink implements TubeLinkInterface
{
    private $services = array();

    /**
     * Register a service detector
     *
     * @return TubeLink
     */
    public function registerService(ServiceInterface $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function parse($url)
    {
        foreach ($this->services as $service) {
            $video = $service->parse($url);

            if (false !== $video) {
                return $video;
            }
        }

        throw new ServiceNotFoundException($url);
    }
}
