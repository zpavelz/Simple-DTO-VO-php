# Simple-DTO-VO-php
Some example of using Data Transfer Object and Value Objects in php

# Builder

After injecting Builder class to any place of project you can run your custom method to get DTO

## example 

###### returns ManagerDTO object
$manager = $this->Builder->makeManager($dataOfArrayOrJsonString);
###### returns value which was in 'id' key of $dataOfArrayOrJsonString
$manager->getId();
###### returns PhoneVO object
$manager->getPhone(); 
###### returns int value of phone number 
$manager->getPhone()->getInt();
###### returns string default value of PhoneVO object which was in 'phone' key of $dataOfArrayOrJsonString  
$manager->getPhone()(); 

## example of custom make method

To create your custom makeSample you will need to do something like this:

public function makeSample($data): SampleDTO
{
    /**
     * @var SampleDTO $dto
    */
    $dto = $this->make(
        SampleDTO::class,
        $data,
        [
            SomeDTOorVOClassName::class => 'key_from_data',
        ]
    );
    return $dto;
}