<?php

namespace App\Services\Weather\Exceptions;

use Exception;

class DaysCountCannotOutOfBoundsException extends Exception
{
    protected int $days;
    protected int $leftBound;
    protected int $rightBound;

    /**
     * DaysCountCannotOutOfBoundsException constructor.
     *
     * @param int $days
     * @param int $leftBound
     * @param int $rightBound
     */
    public function __construct(int $days, int $leftBound, int $rightBound)
    {
        parent::__construct("Days count cannot be lower than $leftBound and greater than $rightBound", 402);

        $this->days = $days;
        $this->leftBound = $leftBound;
        $this->rightBound = $rightBound;
    }

    /**
     * @return int
     */
    public function getDays(): int
    {
        return $this->days;
    }

    /**
     * @return int
     */
    public function getLeftBound(): int
    {
        return $this->leftBound;
    }

    /**
     * @return int
     */
    public function getRightBound(): int
    {
        return $this->rightBound;
    }
}
