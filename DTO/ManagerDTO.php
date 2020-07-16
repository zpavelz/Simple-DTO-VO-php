<?php

namespace App\DTO;

use App\VO\PhoneVO;

/**
 * Class ManagerDTO
 *
 * @method string getId()
 * @method PhoneVO getPhone()
 * @method string getJoinedAt()
 */
class ManagerDTO extends ParentDTO
{

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var PhoneVO
     */
    protected PhoneVO $phone;

    /**
     * @var string
     */
    protected string $joinedAt;

}
