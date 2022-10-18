<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @covers
 */
class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'New Cat',
            description: 'New desc',
            isActive: true
        );

        $this->assertNotNull($category->createdAt());
        $this->assertNotEmpty($category->id());
        $this->assertEquals('New Cat', $category->name);
        $this->assertEquals('New desc', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New Cat',
            isActive: false
        );

        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDesabled()
    {
        $category = new Category(
            name: 'New Cat'
        );

        $this->assertTrue($category->isActive);
        $category->desable();
        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $category = new Category(
            id: $uuid,
            name: 'New Cat',
            description: 'New desc',
            isActive: true
        );

        $category->update(
            name: 'new name',
            description: 'new description'
        );

        $this->assertEquals('new name', $category->name);
        $this->assertEquals('new description', $category->description);
    }

    public function testExceptionName()
    {
        try {
            $uuid = (string) Uuid::uuid4()->toString();
    
            $category = new Category(
                id: $uuid,
                name: 'Ne',
                description: 'Description'
            );   

            $this->assertTrue(false);
        } catch (\Exception $e) {
            $this->assertInstanceOf(EntityValidationException::class, $e);
        }
    }
}