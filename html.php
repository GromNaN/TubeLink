<?php
/*
 * This file is part of the TubeLink package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @licence MIT
 */

require __DIR__ . '/src/autoload.php';

use TubeLink\Video;

$videoYoutube = new Video(new TubeLink\Service\Youtube());
$videoYoutube->id = 'gHYfY9lZaRE';

?>
<!DOCTYPE html>
<html>
<head><title>Videos</title></head>
<body>
    <h1>Youtube</h1>
    <?php echo $videoYoutube->render() ?>
</body>
</html>
