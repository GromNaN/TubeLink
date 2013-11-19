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
    <img src="<?php echo $t->parse('http://youtu.be/fZ_JOBCLF-I')->thumbnail() ?>" />
    <?php echo $t->parse('http://youtu.be/fZ_JOBCLF-I')->render() ?>

    <h1>Dailymotion</h1>
    <img src="<?php echo $t->parse('http://www.dailymotion.com/video/xr9av5')->thumbnail() ?>" />
    <?php echo $t->parse('http://www.dailymotion.com/video/xr9av5')->render() ?>

    <h1>Vimeo</h1>
    <img src="<?php echo $t->parse('http://vimeo.com/15247292')->thumbnail() ?>" />
    <?php echo $t->parse('http://vimeo.com/15247292')->render() ?>

    <h1>Spotify</h1>
    <?php echo $t->parse('https://embed.spotify.com/?uri=spotify:track:4bz7uB4edifWKJXSDxwHcs')->render() ?>

    <h1>SoundCloud</h1>
    <?php echo $t->parse('http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F17373708')->render() ?>

</body>
</html>
