<?php

namespace Minix\Exchange\Maps;

use Illuminate\Support\Arr;

class Mapping
{
    /**
     * @var string
     */
    public $attribute;

    /**
     * @var string|array
     */
    public $key;

    /**
     * @var Callable|null
     */
    public $callback;

    /**
     * @param string        $attribute
     * @param string|array  $key
     * @param Callable|null $callback
     */
    public function __construct($attribute, $key, $callback = null)
    {
        $this->attribute = $attribute;
        $this->key = $key;
        $this->callback = $callback;
    }

    /**
     * @param array $json
     * @param bool  $ignoreErrors
     *
     * @return mixed|null
     *
     * @throws \InvalidArgumentException
     */
    public function execute(array $json, $ignoreErrors = false)
    {
        $extract = $this->extract($json);

        $isExtractionRequired = !$ignoreErrors && ($this->key !== null);
        $validExtract = is_array($this->key) ? (count($extract) === count($this->key)) : $extract;

        if ($isExtractionRequired && $validExtract) {
            throw new \InvalidArgumentException(
                'Failed to map `'.$this->attribute.'` due to missing key/s: `'.$this->key.'`'
            );
        }

        if ($this->callback) {
            $extract = is_array($extract) ? $extract : [$extract];

            return call_user_func_array($this->callback, $extract);
        }

        if (is_array($extract)) {
            throw new \InvalidArgumentException(
                'An array of keys to extract should only be present if a callback is provided.'
            );
        }

        return $extract;
    }

    /**
     * Get all values from json for given key/s.
     *
     * @param array $json
     *
     * @return string|array|null
     */
    private function extract(array $json)
    {
        if (is_array($this->key)) {
            $values = [];

            foreach ($this->key as $key) {
                $values[] = Arr::get($json, $key);
            }

            return $values;
        }

        return Arr::get($json, $this->key);
    }

    /**
     * @param string        $attribute
     * @param string|array  $key
     * @param Callable|null $callback
     *
     * @return Mapping
     */
    static function make($attribute, $key, $callback = null)
    {
        return new Mapping($attribute, $key, $callback);
    }
}