<?php


namespace App\Entities\Discord;

class CommandEntity
{
    public function __construct(
        public string $name,
        public object $callable,
        public OptionEntity $options,
    )
    {
    }

}
