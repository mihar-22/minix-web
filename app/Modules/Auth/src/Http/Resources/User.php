<?php

namespace Minix\Auth\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function with($request)
    {
        return [
            'object' => 'user',
        ];
    }
}
