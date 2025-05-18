<?php
function tryGetJsonContent(string $path, array &$jsonContentResult): bool
{
    if (!file_exists($path)) {

        error_log("JSON-file not found. PATH: $path");
        return false;
    }

    $jsonContentResult = json_decode(file_get_contents($path), true);
    return true;
}

/** @return array<string> */
function getFileNames(string $filePattern, bool $removeFileExtension): array
{
    return array_map(function ($fullPath) use ($removeFileExtension) {
        $result = basename($fullPath);
        if ($removeFileExtension) {
            $result = pathinfo($result, PATHINFO_FILENAME);
        }
        return $result;
    }, glob($filePattern));
}
