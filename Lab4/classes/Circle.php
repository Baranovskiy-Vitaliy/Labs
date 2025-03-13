<?php


class Circle
{
    private float $x, $y, $radius;
    public function __construct(float $x = 0, float $y = 0, float $radius = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }
    public function __toString(): string
    {
        return "коло з центром в ({$this->x}, {$this->y}) і радіусом {$this->radius}";
    }
    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function getRadius(): float
    {
        return $this->radius;
    }

    public function setX(float $x)
    {
        $this->x = $x;
    }

    public function setY(float $y)
    {
        $this->y = $y;
    }

    public function setRadius(float $radius)
    {
        $this->radius = $radius;
    }

    public function intersects(Circle $circle): bool
    {
        $distance = sqrt(pow($this->x - $circle->getX(), 2) + pow($this->y - $circle->getY(), 2));
        if ($distance < ($this->radius + $circle->getRadius()))
            return true;
        else
            return false;
    }
}