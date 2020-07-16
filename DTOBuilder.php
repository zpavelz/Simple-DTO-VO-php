<?php

namespace App;

use App\DTO\ManagerDTO;
use App\DTO\ParentDTO;
use App\VO\ParentVO;
use App\VO\PhoneVO;
use Exception;

class Builder
{

    protected const KEY_PHONE = 'phone';

    /**
     * @param array|string $data
     * @throws
     * @return ManagerDTO
     */
    public function makeManager($data): ManagerDTO
    {
        /**
         * @var ManagerDTO $dto
        */
        $dto = $this->make(
            ManagerDTO::class,
            $data,
            [
                PhoneVO::class => self::KEY_PHONE,
            ]
        );
        return $dto;
    }

    /**
     * @param string $dtoClassName
     * @param array|string $data
     * @param array $complex
     * @throws
     * @return ParentDTO
    */
    protected function make(string $dtoClassName, $data, array $complex = []): ParentDTO
    {
        if (is_string($data))
            $data = json_decode($data, true);

        foreach ($complex as $className => $dataKey)
        {
            if (preg_match("/(VO)$/", $className))
            {
                $data[$dataKey] = $this->makeVO($className, $data[$dataKey]);
            }
            elseif (preg_match("/(DTO)$/", $className))
            {
                $className = explode('\\', $className);
                $data[$dataKey] = $this->{"make" . str_replace("DTO", "", array_pop($className))}($data[$dataKey]);
            }
        }

        $dto = new $dtoClassName($data);

        if (!($dto instanceof ParentDTO))
            throw new Exception("Wrong DTO instance");

        return $dto;
    }

    /**
     * @param string $voClassName
     * @param string $data
     * @throws
     * @return ParentVO
     */
    protected function makeVO(string $voClassName, string $data): ParentVO
    {
        if (is_string($data))
            $data = json_decode($data, true);

        $vo = new $voClassName($data);

        if (!($vo instanceof ParentVO))
            throw new Exception("Wrong VO instance");

        return $vo;
    }

}
