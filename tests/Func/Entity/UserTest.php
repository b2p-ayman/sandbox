<?php

namespace App\Tests\Func\Entity;

use App\Tests\Utils\AbstractEndPoint;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends AbstractEndPoint
{
    public function testGetUsers(): void
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/users');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertResponseIsSuccessful();
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testGetFiles(): void
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/files');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertResponseIsSuccessful();
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

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testPostFile(): void
    {
        $filePayload = '{"titre" : "test titre", "description":"test description","user":"/api/users/3"}';

        $response = $this->getResponseFromRequest(
            Request::METHOD_POST,
            '/api/files',
            $filePayload
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    private function getPayload(): string
    {
        $userPayload = '{"email" : "%s", "password":"password","username":"username"}';

        $faker = Factory::create();

        return sprintf($userPayload, $faker->email);
    }
}
