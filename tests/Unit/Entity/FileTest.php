<?php

namespace App\Tests\Unit\Entity;

use App\Entity\File;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    private File $file;

    protected function setUp(): void
    {
        parent::setUp();
        $this->file = new File();
    }

    public function testGetTitre(): void
    {
        $value = 'Test Titre';
        $response = $this->file->setTitre($value);

        $this->assertInstanceOf(File::class, $response);
        $this->assertEquals($value, $this->file->getTitre());
    }

    public function testGetDescription(): void
    {
        $value = 'Test Description';
        $response = $this->file->setDescription($value);

        $this->assertInstanceOf(File::class, $response);
        $this->assertEquals($value, $this->file->getDescription());
    }

    public function testGetUser(): void
    {
        $value = new User();
        $response = $this->file->setUser($value);

        $this->assertInstanceOf(File::class, $response);
        $this->assertInstanceOf(User::class, $this->file->getUser());
    }

    public function testGetBrochureFilename(): void
    {
        $value = 'eProtocole.pdf';
        $response = $this->file->setBrochureFilename($value);

        $this->assertInstanceOf(File::class, $response);
        $this->assertEquals($value, $this->file->getBrochureFilename());
    }

    public function testGetStateFile(): void
    {
        $value = true;
        $response = $this->file->setStateFile($value);

        $this->assertInstanceOf(File::class, $response);
        $this->assertEquals($value, $this->file->getStateFile());
    }
}
