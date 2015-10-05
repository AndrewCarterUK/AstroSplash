<?php

return array_merge_recursive(
    include 'config/container.global.php',
    include 'config/container.local.php'
);
