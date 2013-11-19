<?php
/*
 * This file is part of the TubeLink package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @licence MIT
 */

/**
 * Simple autoloader that follow the PHP Standards Recommendation #0 (PSR-0)
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md for more informations.
 *
 * @author Jérôme Tamarelle <jerome@tamarelle.net>
 */
function autoload_tubelink($className) {
    $className = ltrim($className, '\\');
    if (0 === strpos($className, 'TubeLink')) {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (is_file($fileName)) {
            require $fileName;

            return true;
        }
    }

    return false;
};

spl_autoload_register('autoload_tubelink');
