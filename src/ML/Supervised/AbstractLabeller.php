<?php

namespace Chess\ML\Supervised;

abstract class AbstractLabeller
{
    abstract public function label(array $end);
}
