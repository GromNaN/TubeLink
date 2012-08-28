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

$t = TubeLink\TubeLink::create();

?>
<!DOCTYPE html>
<html>
<head><title>Videos</title></head>
<body>
    <h1>Youtube</h1>
    <?php echo $t->parse('http://youtu.be/gHYfY9lZaRE')->render() ?>

    <h1>Dailymotion</h1>
    <?php echo $t->parse('http://www.dailymotion.com/video/xr9av5')->render() ?>

    <h1>Vimeo</h1>
    <?php echo $t->parse('http://vimeo.com/15247292')->render() ?>
</body>
</html>
