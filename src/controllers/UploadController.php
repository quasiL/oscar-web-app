<?php

require_once 'utils/CsvParser.php';
require_once 'utils/Validator.php';

class UploadController
{
    private object $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function handleRequest(): void
    {
        $action = $_GET['action'] ?? 'upload';
        switch ($action) {
            case 'display':
                $this->handleFileUpload();
                break;
            default:
                $this->showUploadForm();
                break;
        }
    }

    private function showUploadForm(): void
    {
        include 'views/upload.php';
    }

    private function handleFileUpload(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_FILES) === 2) {
            $femaleFile = null;
            $maleFile = null;

            foreach ($_FILES as $file) {
                if (!$this->validator->validateFile($file)) {
                    return;
                }

                if (strpos(strtolower($file['name']), 'female') !== false) {
                    $femaleFile = $file['tmp_name'];
                } elseif (strpos(strtolower($file['name']), 'male') !== false) {
                    $maleFile = $file['tmp_name'];
                }
            }

            if ($femaleFile && $maleFile) {
                $parser = new CsvParser();
                $femaleData = $parser->processFile($femaleFile);
                $maleData = $parser->processFile($maleFile);
                $oscarByYearData = $parser->getOscarsByYearData($femaleData, $maleData);
                $oscarByMovieData = $parser->getMoviesWithBothRolesData($femaleData, $maleData);
                include 'views/display.php';
            } else {
                echo "Please upload one file containing 'female' and another containing 'male' in the filename.";
            }
        } else {
            echo "Error: You must upload exactly two files.";
        }
    }
}

