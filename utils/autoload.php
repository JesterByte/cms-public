<?php

function autoloadUtils($directory) {
    foreach (glob($directory . "/*.php") as $filename) {
        require_once $filename;
    }
}