<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;

class Category
{
    use MethodsMagicsTrait;

    public function __construct(
        protected string $name = '',
        protected string $id = '',
        protected string $description = '',
        protected bool $isActive = true,
    ) {   
        $this->validate();     
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function desable(): void
    {
        $this->isActive = false;
    }

    public function update(
        string $name,
        string $description = ''
    ): void {
        $this->name = $name;
        $this->description = $description;
        $this->validate();
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new EntityValidationException("nome inválido");
        }

        if (strlen($this->name) <= 2) {
            throw new EntityValidationException("nome inválido");
        }

        if (
            !empty($this->description) && 
            (
                strlen($this->description) < 2 || 
                strlen($this->description) > 255
            )
        ) {
            throw new EntityValidationException("description inválido");
        }
    }
}