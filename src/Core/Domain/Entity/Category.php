<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Category
{
    use MethodsMagicsTrait;

    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
        protected DateTime|string $createdAt = ''
    ) {   
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();
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
        DomainValidation::notNull($this->name);
        DomainValidation::strMinLength($this->name, 3);
        DomainValidation::strMaxLength($this->name, 255);

        DomainValidation::strCanNotNullAndMaxLength($this->description, 255);
    }
}