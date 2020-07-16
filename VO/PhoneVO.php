<?php

namespace App\VO;

/**
 * Class PhoneVO
 */
class PhoneVO extends ParentVO
{

    /**
     * @return int
    */
    public function getInt(): int
    {
        return (int)preg_replace('/[^0-9]/', '', $this->value);
    }

}
