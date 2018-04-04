<?php

namespace Minix\Support;

class ModelAttribute extends Enum
{
    public static $relations = [];

    private static $relationsCache = null;

    /**
     * Check if the given attribute is an attribute representing a relationship.
     *
     * @param string $attribute
     *
     * @return bool
     */
    static function isRelation($attribute)
    {
        if (self::$relationsCache == null) {
            self::$relationsCache = [];
        }

        $class = get_called_class();

        if (!array_key_exists($class, self::$relationsCache)) {
            try {
                $reflect = new \ReflectionClass($class);

                self::$relationsCache[$class] = array_fill_keys(
                    $reflect->getStaticProperties()['relations'], 1
                );
            } catch (\ReflectionException $e) {
                // no-op
            }
        }

        return array_key_exists($attribute, self::$relationsCache[$class]);
    }

    /**
     * Convert an attribute to a foreign key identifier.
     *
     * @param string $attribute
     *
     * @return string
     */
    static function toForeignKey($attribute)
    {
        return $attribute.'_id';
    }
}

