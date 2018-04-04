<?php

namespace Minix\Support;

/**
 * @see https://stackoverflow.com/a/254543
 */
abstract class Enum
{
    /**
     * Cache constants for faster retrieval and lower memory consumption as a new ReflectionClass
     * is not required on each retrieval.
     *
     * @var array|null
     */
    private static $constantsCache = null;

    /**
     * Instantiation is not allowed for an Enum type.
     */
    private function __construct()
    {
    }

    /**
     * Get all constant values set on the enum and fill the cache with them set as the key to
     * enable faster search times O(1).
     *
     * @return array
     */
    private static function getConstants()
    {
        if (self::$constantsCache == null) {
            self::$constantsCache = [];
        }

        $class = get_called_class();

        if (!array_key_exists($class, self::$constantsCache)) {
            try {
                $reflect = new \ReflectionClass($class);

                self::$constantsCache[$class] = array_fill_keys($reflect->getConstants(), 1);
            } catch (\ReflectionException $e) {
                // no-op
            }
        }

        return self::$constantsCache[$class];
    }

    /**
     * Get all constant values.
     *
     * @return array
     */
    static function values()
    {
        return array_keys(self::getConstants());
    }

    /**
     * Check if a given value exists.
     *
     * @param string $value
     *
     * @return bool
     */
    static function exists($value)
    {
        return array_key_exists($value, self::getConstants());
    }
}