<?php

// Run initialization script
shell_exec('bash ' . __DIR__ . '/init.sh');

require __DIR__ . '/../public/index.php';