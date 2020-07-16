<?php

namespace App\VO;

/**
 * Class ParentVO
 */
class ParentVO
{
    /**
     * @var string
    */
    protected string $value;

    /**
     * @param string $value
    */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
    */
    public function __invoke(): string
    {
        return $this->value;
    }
}
