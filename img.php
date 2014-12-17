<?php
$content = file_get_contents("http://www.soup.io/fof/cef3d49bce353b86ca4ca9d364a64059.rss?type=image");
preg_match_all('@\"url\":\"([^"]*)\"@', $content, $matches);
#var_dump($matches[1]);
echo json_encode($matches[1]);
