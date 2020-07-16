<?php

namespace App\DTO;

use Exception;

class ParentDTO
{

    protected const TYPE_INT    = "integer";
    protected const TYPE_STRING = "string";
    protected const TYPE_FLOAT  = "double";
    protected const TYPE_BOOL   = "boolean";

    /**
     * @param array $data
     * @return void
    */
    protected function assemble(array $data): void
    {
        foreach ($data as $property => $value)
            if (property_exists($this, $property))
            {
                switch (gettype($this->$property)):
                    case self::TYPE_INT:
                        $value = (int)$value;
                        break;
                    case self::TYPE_BOOL:
                        $value = (bool)$value;
                        break;
                    case self::TYPE_STRING:
                        $value = (string)$value;
                        break;
                    case self::TYPE_FLOAT:
                        $value = (float)$value;
                        break;
                endswitch;
                $this->$property = $value;
            }
    }

    /**
     * @param array $data
    */
    public function __construct(array $data)
    {
        $this->assemble($data);
    }


    /**
     * @param string $method
     * @param array $arguments
     * @return string|int|object|array|bool|null
     * @throws
    */
    public function __call(string $method, array $arguments)
    {
        preg_match_all('/get([a-zA-Z]+)/u', $method, $aGet);
        if (!empty($aGet[1][0]))
        {
            $varName = lcfirst($aGet[1][0]);

            $className = self::class;
            if (!property_exists($this, $varName))
                throw new Exception("Property {$varName} is not exists in {$className}");

            return $this->$varName;
        }

        return null;
    }

}
