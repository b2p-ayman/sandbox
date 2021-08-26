<?php

namespace App\Tests\Func\Entity;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory;

class UserTest extends AbstractEndPoint
{
    private $userPayload = '{"email" : "%s", "password":"password","username":"username"}';
    private $filePayload = '{"titre" : "test titre", "description":"test description","user":"/api/users/3"}';

    public function testGetUsers(): void
    {
        //dd($this->getResponseFromRequest(Request::METHOD_GET, '/api/users'));
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/users');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testGetFiles(): void
    {
        //dd($this->getResponseFromRequest(Request::METHOD_GET, '/api/files'));
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/files');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testPostUser(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_POST,
            '/api/users',
            $this->getPayload()
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        //dd($responseDecoded);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testPostFile(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_POST,
            '/api/files',
            $this->filePayload
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        //dd($responseDecoded);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    private function getPayload(): string
    {
        $faker = Factory::create();

        return sprintf($this->userPayload, $faker->email);
    }

}
