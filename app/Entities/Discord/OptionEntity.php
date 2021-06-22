<?php


namespace App\Entities\Discord;

class OptionEntity
{
    public function __construct(
        public array $aliases,
        public int $cooldown,
        public string $cooldownMessage,
        public string $description,
        public string $longDescription,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'aliases' => $this->aliases,
            'cooldown' => $this->cooldown,
            'cooldownMessage' => $this->cooldownMessage,
            'description' => $this->description,
            'longDescription' => $this->longDescription,
        ];
    }
}
