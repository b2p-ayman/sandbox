<?php

namespace App\Tests\Func\Entity;

use App\Tests\Utils\AbstractEndPoint;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FileTest extends AbstractEndPoint
{
    public function testGetFileById(): void
    {
        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/files/20');
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        //dd($responseDecoded);
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

    public function testPutFile(): void
    {
        $filePayload = '{"titre" : "test titre", "description":"test description","user":"/api/users/1"}';

        $response = $this->getResponseFromRequest(
            Request::METHOD_PUT,
            '/api/files/20',
            $filePayload
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertResponseIsSuccessful();
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    public function testPostFile(): void
    {
        $filePayload = '{"titre" : "test titre", "description":"test description","user":"/api/users/1"}';

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

    public function testUpdateTitle(): void
    {
        $filePayload = '{"titre" : "new title test", "description":"test description","user":"/api/users/1"}';

        $response = $this->getResponseFromRequest(
            Request::METHOD_PUT,
            '/api/files/20/update-title',
            $filePayload
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        self::assertResponseIsSuccessful();
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }
}
