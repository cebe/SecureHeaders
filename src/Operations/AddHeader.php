<?php

namespace Aidantwoods\SecureHeaders\Operations;

use Aidantwoods\SecureHeaders\HeaderBag;
use Aidantwoods\SecureHeaders\Operation;

class AddHeader implements Operation
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;

        if ( ! is_array($value))
        {
            $value = [$value];
        }

        $this->value = $value;
    }

    /**
     * Transform the given set of headers
     *
     * @param HeaderBag $headers
     * @return void
     */
    public function modify(HeaderBag &$headers)
    {
        if ( ! $headers->has($this->name))
        {
            foreach ($this->value as $value)
            {
                $headers->add($this->name, $value);
            }
        }
    }
}
