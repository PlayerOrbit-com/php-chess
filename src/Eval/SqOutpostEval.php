<?php

namespace Chess\Eval;

use Chess\Piece\P;
use Chess\Tutor\PiecePhrase;
use Chess\Variant\Classical\PGN\AN\Color;
use Chess\Variant\Classical\PGN\AN\Piece;
use Chess\Variant\Classical\Board;

/**
 * SqOutpostEval
 *
 * @link https://en.wikipedia.org/wiki/Outpost_(chess)
 */
class SqOutpostEval extends AbstractEval
{
    const NAME = 'Outpost square';

    public function __construct(Board $board)
    {
        $this->board = $board;

        $this->result = [
            Color::W => [],
            Color::B => [],
        ];

        $sqs = [];
        foreach ($this->board->getPieces() as $piece) {
            if ($piece->getId() === Piece::P) {
                $captureSqs = $piece->getCaptureSqs();
                if ($piece->getRanks()->end !== (int) substr($captureSqs[0], 1)) {
                    $left = chr(ord($captureSqs[0]) - 1);
                    $right = chr(ord($captureSqs[0]) + 1);
                    if (
                        !$this->isFileAttacked($piece->getColor(), $captureSqs[0], $left) &&
                        !$this->isFileAttacked($piece->getColor(), $captureSqs[0], $right)
                    ) {
                        $this->result[$piece->getColor()][] = $captureSqs[0];
                    }
                    if (isset($captureSqs[1])) {
                        $left = chr(ord($captureSqs[1]) - 1);
                        $right = chr(ord($captureSqs[1]) + 1);
                        if (
                            !$this->isFileAttacked($piece->getColor(), $captureSqs[1], $left) &&
                            !$this->isFileAttacked($piece->getColor(), $captureSqs[1], $right)
                        ) {
                            $this->result[$piece->getColor()][] = $captureSqs[1];
                        }
                    }
                }
            }
        }

        $this->result[Color::W] = array_unique($this->result[Color::W]);
        $this->result[Color::B] = array_unique($this->result[Color::B]);

        $this->explain($this->result);
    }

    private function isFileAttacked($color, $sq, $file): bool
    {
        $rank = substr($sq, 1);
        for ($i = 2; $i < 8; $i++) {
            if ($piece = $this->board->getPieceBySq($file.$i)) {
                if (
                    $piece->getId() === Piece::P &&
                    $piece->getColor() === Color::opp($color)
                ) {
                    if ($color === Color::W) {
                        if ($i > $rank) {
                            return true;
                        }
                    } else {
                        if ($i < $rank) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    private function explain(array $result): void
    {
        $singular = mb_strtolower('an ' . self::NAME);
        $plural = mb_strtolower(self::NAME.'s');

        $this->shorten($result, $singular, $plural);
    }
}
