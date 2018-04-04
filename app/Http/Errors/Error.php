<?php

namespace Minix\Http\Errors;

use JsonSerializable;

class Error implements JsonSerializable
{
    /**
     * Machine identifier.
     *
     * @var string
     */
    public $id;

    /**
     * Human description.
     *
     * @var string|null
     */
    public $message;

    /**
     * Extra information to help narrow the cause of the error.
     *
     * @var string|null
     */
    public $hint;

    /**
     * If more than one error occurred, they are listed here.
     *
     * @var array|null
     */
    public $errors;

    /**
     * @param string      $id
     * @param string|null $message
     * @param string|null $hint
     * @param array|null  $errors
     */
    public function __construct(
        $id,
        $message = null,
        $hint = null,
        $errors = null
    ) {
        $this->id = $id;
        $this->message = $message;
        $this->hint = $hint;
        $this->errors = $errors;
    }

    /**
     * @param string|null $message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string|null $hint
     *
     * @return self
     */
    public function setHint($hint): self
    {
        $this->hint = $hint;

        return $this;
    }

    /**
     * @param string|null $errors
     *
     * @return self
     */
    public function setErrors($errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'object' => 'error',
            'id' => $this->id,
            'message' => $this->message,
            'errors' => $this->errors,
            'hint' => $this->hint,
        ]);
    }
}
