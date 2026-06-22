<?php

const LOCAL_TESTING = false; // change to true for local test

$stream = LOCAL_TESTING ? fopen('input.txt', 'r') : STDIN;
$readData = new ReadData($stream);

$line = $readData->readLine();

$totalBoards = (int)$line;

$gameValidator = new GameValidator;

for ($i = 0; $i < $totalBoards; $i++) {
    $board = new Board($readData);
    if ($board->mountBoard()) {
        $result = $gameValidator->validate($board);
        echo $result . "\n";
    }
}

class ReadData
{
    private $stream;

    public function __construct($stream)
    {
        $this->setStream($stream);
    }

    /**
     * read line in the resource
     * @return string|false
     */

    public function readLine()
    {
        $line = fgets($this->getStream());

        if ($line === false){ // if the input comes to an end
            return false;
        }
        return trim($line);
    }

    /**
     * Get the value of stream
     * @return resource
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the value of stream
     *
     * @param resource $stream
     * @return self
     * @throws InvalidArgumentException
     */
    public function setStream($stream): self
    {
        if (!is_resource($stream)) {
            throw new InvalidArgumentException('The provided stream must be a valid resource.');
        }

        $this->stream = $stream;

        return $this;
    }
}

class Board
{

    private $data;
    private $matrix = [];

    public function __construct(ReadData $data)
    {
        $this->data = $data;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData(ReadData $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Mount the board matrix
     *
     * @return bool
     */

    public function mountBoard(): bool
    {
        $tempMatrix = [];
        while (count($tempMatrix) < 3) {
            $line = $this->data->readLine();
            if ($line === false) { // if input comes to an and
                return false;
            }
            if ($line === '') { //ignore empty lines because SPOJ costume to send variable spaces between boards
                continue;
            }
            $tempMatrix[] = str_split($line);
        }
        $this->matrix = $tempMatrix;
        return true;
    }
    /**
     * Get the value of matrix
     */
    public function getMatrix()
    {
        return $this->matrix;
    }

    /**
     * Set the value of matrix
     *
     * @return  self
     */
    public function setMatrix($matrix): self
    {
        $this->matrix = $matrix;

        return $this;
    }
}

class GameValidator
{

    /**
     * validates the game
     * @param Board $board
     * @return string $result
     */

    public function validate(Board $board): string
    {
        $matrix = $board->getMatrix();

        $countX = $this->countMarks($matrix, "X");
        $countO = $this->countMarks($matrix, "O");
        $countDots = $this->countMarks($matrix, ".");

        if (($countX + $countO + $countDots) !== 9){ // ensures the board contains only valid characters (X, O, .). Any unexpected character would cause the sum to differ from 9
            return 'no';
        }

        if (!$this->isValidMarkCount($countX, $countO)) {
            return 'no';
        }

        $xWins = $this->hasPlayerWon($matrix, 'X');
        $oWins = $this->hasPlayerWon($matrix, 'O');

        if ($xWins && $oWins) {
            return 'no';
        }
        if ($xWins && ($countX != $countO + 1)) {
            return 'no';
        }

        if ($oWins && $countX !== $countO) {
            return 'no';
        }

        return 'yes';
    }

    /**
     * count the number of specific mark
     * @param array $matrix
     * @param string $mark
     * @return int
     */

    private function countMarks(array $matrix, string $mark): int
    {
        $count = 0;

        foreach ($matrix as $row) {
            foreach ($row as $cell) {
                if ($cell === $mark) {
                    $count++;
                }
            }
        }
        return $count;
    }

    private function isValidMarkCount(int $countX, int $countO): bool
    {
        return ($countX === $countO) || ($countX === $countO + 1);
    }

    private function hasPlayerWon(array $matrix, string $mark): bool
    {
        if ($this->checkLines($matrix, $mark) || $this->checkColumns($matrix, $mark) || $this->checkDiagonals($matrix, $mark)) {
            return true;
        }

        return false;
    }

    private function checkLines(array $matrix, string $mark): bool
    {
        for ($row = 0; $row < 3; $row++) {
            if (($matrix[$row][0] === $mark) && ($matrix[$row][1] === $mark) && ($matrix[$row][2] === $mark)) {
                return true;
            }
        }
        return false;
    }

    private function checkColumns(array $matrix, string $mark): bool
    {
        for ($col = 0; $col < 3; $col++) {
            if (($matrix[0][$col] === $mark) && ($matrix[1][$col] === $mark) && ($matrix[2][$col] === $mark)) {
                return true;
            }
        }
        return false;
    }

    private function checkDiagonals(array $matrix, string $mark): bool
    {
        if ((($matrix[0][0] === $mark) && ($matrix[1][1] === $mark) && ($matrix[2][2] === $mark))
            || (($matrix[2][0] === $mark) && ($matrix[1][1] === $mark) && ($matrix[0][2] === $mark))
        ) {
            return true;
        }
        return false;
    }
}
