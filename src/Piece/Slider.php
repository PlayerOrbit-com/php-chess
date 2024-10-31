<?php

namespace Chess\Piece;

/**
 * Class that represents a bishop, a rook or a queen.
 *
 * @author Jordi Bassagaña
 * @license GPL
 */
abstract class Slider extends AbstractPiece
{
    /**
     * Constructor.
     *
     * @param string $color
     * @param string $sq
     * @param array $size
     * @param string $id
     */
    public function __construct(string $color, string $sq, array $size, string $id)
    {
        parent::__construct($color, $sq, $size, $id);
    }

    /**
     * Returns the piece's legal moves.
     *
     * @return array
     */
    public function sqs(): array
    {
        $sqs = [];
        foreach ($this->mobility as $key => $val) {
            foreach ($val as $sq) {
                if (in_array($sq, $this->board->getSqCount()->free)) {
                    $sqs[] = $sq;
                } elseif (in_array($sq, $this->board->getSqCount()->used->{$this->oppColor()})) {
                    $sqs[] = $sq;
                    break 1;
                } else {
                    break 1;
                }
            }
        }

        return $sqs;
    }

    /**
     * Returns the squares defended by the piece.
     *
     * @return array|null
     */
    public function defendedSqs(): ?array
    {
        $sqs = [];
        foreach ($this->mobility as $key => $val) {
            foreach ($val as $sq) {
                if (in_array($sq, $this->board->getSqCount()->used->{$this->getColor()})) {
                    $sqs[] = $sq;
                    break 1;
                } elseif (in_array($sq, $this->board->getSqCount()->used->{$this->oppColor()})) {
                    break 1;
                }
            }
        }

        return $sqs;
    }
}
