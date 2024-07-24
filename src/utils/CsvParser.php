<?php

class CsvParser
{
    /**
     * Converts data from csv file into associative array
     *
     * @param string $fileTmpPath path to the file inside tmp directory
     * @return array data
     */
    public function processFile(string $fileTmpPath): array
    {
        $csvData = [];
        if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csvData[] = $data;
            }
            fclose($handle);
        }
        return $csvData;
    }


    /**
     * Returns data for the first table
     *
     * @param array $femaleData
     * @param array $maleData
     * @return array
     */
    public function getOscarsByYearData(array $femaleData, array $maleData): array
    {
        $headers = ["Year", "Women", "Men"];
        $result = [];

        $combinedData = [
            'female' => $femaleData,
            'male' => $maleData,
        ];

        foreach ($combinedData as $gender => $data) {
            foreach ($data as $row) {
                if (count($row) < 4) {
                    continue;
                }

                $year = isset($row[1]) ? trim($row[1]) : '';
                $age = isset($row[2]) ? trim($row[2]) : '';
                $name = isset($row[3]) ? trim($row[3]) : '';
                $movie = isset($row[4]) ? trim($row[4]) : '';

                if (!is_numeric($year)) {
                    continue;
                }

                if (!isset($result[$year])) {
                    $result[$year] = ['Women' => [], 'Men' => []];
                }

                if ($gender == 'female') {
                    $result[$year]['Women']['name'] = $name;
                    $result[$year]['Women']['age'] = $age;
                    $result[$year]['Women']['movie'] = $movie;
                } else {
                    $result[$year]['Men']['name'] = $name;
                    $result[$year]['Men']['age'] = $age;
                    $result[$year]['Men']['movie'] = $movie;
                }
            }
        }

        return [$headers, $result];
    }


    /**
     * Returns data for the second table
     *
     * @param array $femaleData
     * @param array $maleData
     * @return array
     */
    public function getMoviesWithBothRolesData(array $femaleData, array $maleData): array
    {
        $headers = ["Movie", "Year", "Women", "Men"];
        $result = [];

        $femaleMovies = [];
        foreach ($femaleData as $femaleRow) {
            $year = isset($femaleRow[1]) ? trim($femaleRow[1]) : '';
            $name = isset($femaleRow[3]) ? trim($femaleRow[3]) : '';
            $movie = isset($femaleRow[4]) ? trim($femaleRow[4]) : '';

            if (!is_numeric($year)) {
                continue;
            }

            $femaleMovies[$movie] = [
                'year' => $year,
                'women' => $name,
            ];
        }

        foreach ($maleData as $maleRow) {
            $year = isset($maleRow[1]) ? trim($maleRow[1]) : '';
            $name = isset($maleRow[3]) ? trim($maleRow[3]) : '';
            $movie = isset($maleRow[4]) ? trim($maleRow[4]) : '';

            if (isset($femaleMovies[$movie])) {
                $result[] = [
                    'Movie' => $movie,
                    'Year' => $year,
                    'Women' => $femaleMovies[$movie]['women'],
                    'Men' => $name
                ];
            }
        }

        usort($result, function($a, $b) {
            return strcmp($a['Movie'], $b['Movie']);
        });

        return [$headers, $result];
    }
}

