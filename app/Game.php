<?php

namespace App;
class Game
{
    private array $board;
    private array $slotValue;

    public function __construct(array $board, array $slotValue)
    {
        $this->board = $board;
        $this->slotValue = $slotValue;
    }

    public function boardFill(): array
    {
        for ($i = 0; $i < count($this->board); $i++) {
            for ($j = 0; $j < count($this->board[0]); $j++) {
                $this->board[$i][$j] = $this->slotValue[rand(0, count($this->slotValue) - 1)];
            }
        }
        return $this->board;
    }

    function checkWinnerRow(array $insertedBoard): ?array
    {
        $arr=[];
        $slotValue = ["*", "@", "#", "$", "%", "&", "=", "+"];
        $payLines = [
            [[0, 0], [0, 1], [0, 2], [0, 3], [0, 4]],
            [[1, 0], [1, 1], [1, 2], [1, 3], [1, 4]],
            [[2, 0], [2, 1], [2, 2], [2, 3], [2, 4]],
            [[0, 0], [1, 1], [2, 2], [1, 3], [0, 4]],
            [[2, 0], [1, 1], [0, 2], [1, 3], [2, 4]],
            [[0, 0], [0, 1], [1, 2], [2, 3], [2, 4]],
            [[2, 0], [2, 1], [1, 2], [0, 3], [0, 4]],
            [[1, 0], [0, 1], [1, 2], [2, 3], [1, 4]],
            [[1, 0], [2, 1], [1, 2], [0, 3], [1, 4]],
            [[0, 0], [1, 1], [1, 2], [1, 3], [2, 4]],
            [[2, 0], [1, 1], [0, 2], [1, 3], [0, 4]],
            [[1, 0], [2, 1], [1, 2], [0, 3], [1, 4]],
            [[1, 0], [2, 1], [1, 2], [2, 3], [1, 4]],
            [[2, 0], [1, 1], [2, 2], [1, 3], [2, 4]],
            [[0, 0], [1, 1], [0, 2], [1, 3], [0, 4]],
            [[0, 0], [1, 1], [2, 2], [1, 3], [2, 4]],
            [[2, 0], [1, 1], [2, 2], [1, 3], [2, 4]],
            [[1, 0], [0, 1], [1, 2], [0, 3], [1, 4]],
            [[1, 0], [0, 1], [1, 2], [2, 3], [1, 4]],
            [[0, 0], [0, 1], [2, 2], [0, 3], [0, 4]],
            [[0, 0], [0, 1], [1, 2], [0, 3], [0, 4]],
            [[1, 0], [1, 1], [0, 2], [1, 3], [1, 4]],
            [[1, 0], [1, 1], [2, 2], [1, 3], [1, 4]],
            [[2, 0], [2, 1], [1, 2], [2, 3], [2, 4]],
            [[0, 0], [0, 1], [0, 2], [1, 3], [2, 4]],
            [[1, 0], [1, 1], [1, 2], [2, 3], [1, 4]],
            [[2, 0], [1, 1], [1, 2], [1, 3], [0, 4]],
            [[2, 0], [2, 1], [2, 2], [1, 3], [0, 4]],
            [[2, 0], [2, 1], [0, 2], [2, 3], [2, 4]]

        ];
        foreach ($slotValue as $slot) {
            foreach ($payLines as $pay) {
                $result = 0;
                $counter = 0;
                foreach ($pay as $position) {
                    [$x, $y] = $position;
                    if ($insertedBoard[$x][$y] === $slot && $counter === $result) {
                        $result++;
                        $counter++;
                    } else {
                        $counter++;
                    }
                }
                if ($result === 3 || $result === 4 || $result === 5) {
                    $arr[]=[true, $slot, $result];
                }

            }
        }
        return $arr;
    }

    public function checkMoney(int $spinNumber, int $cost, float $startCapital): float
    {
        return ($startCapital - $spinNumber * $cost);
    }
}


