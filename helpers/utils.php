<?php
function tryGetJsonContent(string $path, array &$jsonContentResult): bool
{
    if (!file_exists($path)) {
        error_log('JSON-file not found');
        return false;
    }

    $jsonContentResult = json_decode(file_get_contents($path), true);
    return true;
}
