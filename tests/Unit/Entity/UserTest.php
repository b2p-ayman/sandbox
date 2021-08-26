<?php

namespace App\Tests\Unit\Entity;

use App\Entity\File;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function testConstruct()
    {
        $this->assertEquals(['ROLE_USER'], $this->user->getRoles());
    }

    public function testGetEmail(): void
    {
        $value = 'ayman@email.com';
        $response = $this->user->setEmail($value);

        $this->assertInstanceOf(User::class, $response);
        $this->assertEquals($value, $this->user->getEmail());
    }

    public function testGetUsername(): void
    {
        $value = 'Ayman';
        $response = $this->user->setUsername($value);

        $this->assertInstanceOf(User::class, $response);
        $this->assertEquals($value, $this->user->getUsername());
    }

    public function testGetRoles(): void
    {
        $value = ['A', 'B'];
        $response = $this->user->setRoles($value);

        $this->assertInstanceOf(User::class, $response);
        $this->assertEquals(['A', 'B', 'ROLE_USER'], $this->user->getRoles());
    }

    public function testGetFiles(): void
    {
        $value = new File();
        $value2 = new File();
        $value3 = new File();

        //$response = $this->user->addFile($value);
        $this->user->addFile($value);
        $this->user->addFile($value2);
        $this->user->addFile($value3);

        $this->assertCount(3, $this->user->getFiles());
        $this->assertTrue($this->user->getFiles()->contains($value));
        $this->assertTrue($this->user->getFiles()->contains($value2));
        $this->assertTrue($this->user->getFiles()->contains($value3));

        $response = $this->user->removeFile($value);

        $this->assertInstanceOf(User::class, $response);
        $this->assertCount(2, $this->user->getFiles());
        $this->assertFalse($this->user->getFiles()->contains($value));
        $this->assertTrue($this->user->getFiles()->contains($value2));
        $this->assertTrue($this->user->getFiles()->contains($value3));
    }
}
