<?php

namespace Chess\Tutor;

use Chess\Piece\AbstractPiece;
use Chess\Variant\Classical\PGN\AN\Color;

/**
 * Human-like phrase.
 *
 * @license GPL
 */
class PiecePhrase
{
    /**
     * Array of phrases.
     *
     * @var array
     */
    public static $phrase = [
        [
            'id' => "B",
            'color' => "w",
            'meaning' => "the bishop",
        ],
        [
            'id' => "B",
            'color' => "b",
            'meaning' => "the bishop",
        ],
        [
            'id' => "K",
            'color' => "w",
            'meaning' => "White's king",
        ],
        [
            'id' => "K",
            'color' => "b",
            'meaning' => "Black's king",
        ],
        [
            'id' => "N",
            'color' => "w",
            'meaning' => "the knight",
        ],
        [
            'id' => "N",
            'color' => "b",
            'meaning' => "the knight",
        ],
        [
            'id' => "P",
            'color' => "w",
            'meaning' => "the pawn",
        ],
        [
            'id' => "P",
            'color' => "b",
            'meaning' => "the pawn",
        ],
        [
            'id' => "Q",
            'color' => "w",
            'meaning' => "White's queen",
        ],
        [
            'id' => "Q",
            'color' => "b",
            'meaning' => "Black's queen",
        ],
        [
            'id' => "R",
            'color' => "w",
            'meaning' => "the rook",
        ],
        [
            'id' => "R",
            'color' => "b",
            'meaning' => "the rook",
        ],
    ];

    public static function create(AbstractPiece $piece): ?string
    {
        foreach (self::$phrase as $item) {
            if (
                $item['id'] === $piece->getId() &&
                $item['color'] === $piece->getColor()
            ) {
                return "{$item['meaning']} on {$piece->getSq()}";
            }
        }

        return null;
    }
}
