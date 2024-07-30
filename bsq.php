<?php
function Algo($argv)
{
    $filename = $argv[1];

    $fileContents = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $numRows = intval($fileContents[0]);
    $grid = array_slice($fileContents, 1);
    $numCols = strlen($grid[0]);

    $square = array_fill(0, $numRows, array_fill(0, $numCols, 0));
    $largestSquare = 0;
    $bottomRight = 0;
    $bottomRight2 = 0;

    for ($row = 0; $row < $numRows; $row++) {
        for ($col = 0; $col < $numCols; $col++) {
            if ($grid[$row][$col] === '.') {
                if ($row == 0 || $col == 0) {
                    $square[$row][$col] = 1;
                } else {
                    $square[$row][$col] = min($square[$row - 1][$col], $square[$row][$col - 1], $square[$row - 1][$col - 1]) + 1;
                }

                if ($square[$row][$col] > $largestSquare) {
                    $largestSquare = $square[$row][$col];
                    $bottomRight = $row;
                    $bottomRight2 = $col;
                }
            }
        }
    }

    for ($row = $bottomRight; $row > $bottomRight - $largestSquare; $row--) {
        for ($col = $bottomRight2; $col > $bottomRight2 - $largestSquare; $col--) {
            $grid[$row][$col] = 'x';
        }
    }

    foreach ($grid as $line) {
        echo $line . "\n";
    }
}

Algo($argv);
