<?php

$cols = explode(" ", "A B C D E F G H I J K L M N O P");

$s = '="["';
foreach ($cols as $c) {
    $s .= '&"\'"&$' . $c . '$1&"\'=>\'"&' . $c . '2 &"\', "';
}

$s .= '&"], "';
print $s;
