<?php

namespace Pdfsystems\AppliedTextilesSDK\Dtos;

use DateTimeImmutable;
use DateTimeInterface;
use MyCLabs\Enum\Enum;
use ReflectionClass;
use ReflectionProperty;

class DataTransferObject
{
    /**
     * @throws \Exception
     */
    public function __construct(array $args = [])
    {
        foreach (static::getProperties() as $property) {
            if (! array_key_exists($property->getName(), $args)) {
                continue;
            }

            $propertyType = $property->getType()->getName();
            $value = $args[$property->getName()];

            /*
             * If the property is an object type there are special considerations for instantiation
             */
            if (class_exists($propertyType) || interface_exists($propertyType)) {
                $propertyClass = new ReflectionClass($propertyType);

                if (is_object($value) && $propertyClass->isInstance($value)) {
                    // If the value was provided as an object of the correct type, use it directly with no alternations
                    $this->{$property->getName()} = $value;
                } else {
                    // Otherwise, the course of action we take depends on the type of object
                    if ($propertyClass->isSubclassOf(Enum::class)) {
                        $this->{$property->getName()} = new $propertyType($value);
                    } elseif ($propertyClass->implementsInterface(DateTimeInterface::class)) {
                        $this->{$property->getName()} = new DateTimeImmutable($value);
                    } else {
                        $this->{$property->getName()} = $value;
                    }
                }
            } elseif (is_string($value)) {
                $this->{$property->getName()} = trim($value);
            } else {
                $this->{$property->getName()} = $value;
            }
        }
    }

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
