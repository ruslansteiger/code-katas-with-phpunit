<?php

use App\Player;
use App\TennisMatch;
use PHPUnit\Framework\TestCase;

class TennisMatchTest extends TestCase
{
    /**
     * @test
     * @dataProvider scores
     */
    function it_scores_a_tennis_match(
        int $playerOnePoints,
        int $playerTwoPoints,
        string $score
    ) {
        $match = new TennisMatch(
            $john = new Player('John'),
            $jane = new Player('Jane'),
        );

        for ($i = 0; $i < $playerOnePoints; $i++) {
            $john->score();
        }

        for ($i = 0; $i < $playerTwoPoints; $i++) {
            $jane->score();
        }

        $this->assertSame($score, $match->score());
    }

    public function scores(): array
    {
        return [
            [0, 0, 'love-love'],
            [1, 0, 'fifteen-love'],
            [1, 1, 'fifteen-fifteen'],
            [2, 0, 'thirty-love'],
            [3, 0, 'forty-love'],
            [2, 2, 'thirty-thirty'],
            [3, 3, 'deuce'],
            [4, 4, 'deuce'],
            [5, 5, 'deuce'],
            [4, 3, 'Advantage: John'],
            [3, 4, 'Advantage: Jane'],
            [4, 0, 'Winner: John'],
            [0, 4, 'Winner: Jane'],
        ];
    }
}
