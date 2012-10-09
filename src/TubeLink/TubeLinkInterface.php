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

use TubeLink\Exception\ProviderNotFoundException;

/**
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
interface TubeLinkInterface
{
    /**
     * Parse a video URL and find its hosting service.
     *
     * @param string $url Tube URL
     *
     * @return Tube
     *
     * @throws ProviderNotFoundException
     */
    public function parse($url);
}
