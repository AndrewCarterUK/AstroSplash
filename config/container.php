<?php

foreach (glob('config/container.{global,local}.php', GLOB_BRACE) as $file) {
    $conf = array_merge_recursive($conf ?: [], include $file);
}

return $conf;
