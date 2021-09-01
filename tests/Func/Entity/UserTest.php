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

    public function testGetUserById(): void
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/users/3');
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

    public function testPutUser(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_PUT,
            '/api/users/4',
            $this->getPayload()
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertResponseIsSuccessful();
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
