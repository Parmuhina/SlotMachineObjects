<?php
require_once "vendor/autoload.php";

use App\Game;

$spinAmount = [1, 2, 5, 10];
$slotValue = ["*", "*", "*", "@", "@", "#", "#", "$", "$", "%", "%", "&", "=", "+"];
$slotAmount = ["*" => 1, "@" => 1, "#" => 1, "$" => 2, "%" => 2, "&" => 2, "=" => 3, "+" => 3];
$spinNumber = 1;
$winingSum = 0;
$board = [
    [" ", " ", " ", " ", " "],
    [" ", " ", " ", " ", " "],
    [" ", " ", " ", " ", " "]
];

$startCapital = floatval(readline('Insert your start money amount: '));
while ($startCapital <= 0) {
    echo "Inserted value not correct." . PHP_EOL;
    $startCapital = floatval(readline('Insert your start money amount: '));
}

echo "One spin cost: 1$, 2$, 5$, or 10$. Insert only number 1, 2, 5, or 10" . PHP_EOL;
$cost = (int)readline('Chose one spin costs: ');
while (in_array($cost, $spinAmount) === false) {
    echo "Inserted value not correct." . PHP_EOL;
    echo "One spin cost: 1$, 2$, 5$, or 10$. Insert only number 1, 2, 5, or 10" . PHP_EOL;
    $cost = (int)readline('Chose one spin costs: ');
}

$game = new Game($board, $slotValue);


while ($game->checkMoney($spinNumber, $cost, $startCapital) >= 0) {

    $str = readline('Do you want to play game? If yes, press 1, if no, press another key ');
    if ($game->checkMoney($spinNumber, $cost, $startCapital) >= 0 && $str === "1") {
        $insertedBoard = $game->boardFill();
        foreach ($insertedBoard as $row) {
            foreach ($row as $element) {
                echo "|" . $element . "|";
            }
            echo PHP_EOL;
        }

        if ($game->checkWinnerRow($insertedBoard) != []) {
            foreach ($game->checkWinnerRow($insertedBoard) as $row) {
                [$x, $y, $z] = $row;
                if ($x) {
                    echo 'Congratulations, you win' . PHP_EOL;
                    foreach ($slotAmount as $key => $value) {
                        if ($key === $y) {
                            $winingSum += $value * 1 * $z;
                            echo 'Your win is ' . $value * 1 * $z;
                            echo PHP_EOL;
                            $startCapital+=$value * 1 * $z;
                        }
                    }
                }
            }
            echo "All your win is {$winingSum}" . PHP_EOL;
            echo "Your cash is equal to " . $startCapital - $spinNumber * $cost;
            echo PHP_EOL;
        } else {
            echo 'Sorry, you loose.' . PHP_EOL;
            echo "All your win is {$winingSum}" . PHP_EOL;
            echo "Your cash is equal to " . $startCapital - $spinNumber * $cost;
            echo PHP_EOL;
        }
    } else {
        if ($str != "1") {
            echo "Thank you for game. See you soon. Bye!" . PHP_EOL;
            exit;
        }
    }

    $spinNumber++;

}
echo "Money value less than one spin!" . PHP_EOL;
echo "Thank you for game. See you soon. Bye!" . PHP_EOL;

