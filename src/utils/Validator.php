<?php

class Validator
{
    public function validateFile(mixed $file): bool
    {
        $fileType = $file['type'];

        if ($fileType !== 'text/csv') {
            echo "Invalid file type. Only CSV files are allowed.";
            return false;
        }

        $fileName = strtolower($file['name']);
        if (!str_contains($fileName, 'female') && !str_contains($fileName, 'male')) {
            echo "File name must contain 'female' or 'male'.";
            return false;
        }

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($fileExtension !== 'csv') {
            echo "Invalid file extension. The file must have a .csv extension.";
            return false;
        }

        return true;
    }
}
