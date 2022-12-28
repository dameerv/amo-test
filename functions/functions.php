<?php
function ifFormSubmitted(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function isFileValid(string $file, array $validExtensions = ['txt']): bool
{
    $extensions = implode('|', $validExtensions);
    $pattern = '/(.*)\.(' . $extensions . ')$/i';

    if (preg_match('/[[:cntrl:]]/', $file)) {
        return false;
    }

    if (1 === preg_match($pattern, $file)) {
        return true;
    }

    return false;
}

function createDataFromFile(string $fileName, string $stringSeparator = ';'): array
{
    $content = file_get_contents($fileName,);

    if (!$content) {
        return [];
    }

    $content = explode(';', $content);
    $array = [];
    foreach ($content as $string) {
        //todo: не понятно, что считать за цифру \d или \d+. Задании не указано.
        preg_match_all('#\d+#', $string, $matches);

        $array[] = [
            'string' => $string,
            'numbers' => count($matches[0])
        ];
    }

    return $array;
}
