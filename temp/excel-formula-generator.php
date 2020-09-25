<?php

$cols = explode(" ", "A B C D E F");

$s = '="["';
foreach ($cols as $c) {
    $s .= '&"\'"&$' . $c . '$1&"\'=>\'"&' . $c . '2 &"\', "';
}

$s .= '&"], "';
print $s;
