<?php

namespace Pdfsystems\AppliedTextilesSDK\Dtos;

use DateTimeInterface;
use MyCLabs\Enum\Enum;
use ReflectionClass;
use ReflectionProperty;

class DataTransferObject
{
    /**
     * Gets all the public properties of the class
     *
     * @return ReflectionProperty[]
     */
    public static function getProperties(): array
    {
        $reflection = new ReflectionClass(get_called_class());

        return $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
    }

    /**
     * Gets all the public property names of the class
     *
     * @return string[]
     */
    public static function getPropertyNames(): array
    {
        return array_map(fn ($property) => $property->getName(), static::getProperties());
    }

    /**
     * Gets an associative array of all the public properties of the class
     * Note that some properties will be converted based to a different format based on Applied Textile's documentation
     *
     * @return array
     */
    public function toArray(): array
    {
        // Get all the properties, which are defined above
        $properties = static::getPropertyNames();

        // Initialize an empty array, which will be populated below and ultimately returned
        $array = [];

        foreach ($properties as $property) {
            $value = $this->{$property};

            if ($value instanceof Enum) {
                // For enumerated values, we want to get the backed value of the selected option
                $array[$property] = $value->getValue();
            } elseif (is_bool($value)) {
                // Write boolean values as Y/N instead of 1/0
                $array[$property] = $value ? 'Y' : 'N';
            } elseif ($value instanceof DateTimeInterface) {
                // Dates should be written in m/d/Y format based on Applied Textile's documentation
                $array[$property] = $value->format('m/d/Y');
            } else {
                // Everything else should be written as-is
                $array[$property] = $value;
            }
        }

        // Return the DTO as an associative array, with any data conversions applied
        return $array;
    }
}
