<?php

namespace App\Tests\Func\Entity;

use App\Tests\Utils\AbstractEndPoint;
use Symfony\Component\HttpFoundation\Request;

class FileTest extends AbstractEndPoint
{
    public function testArticles(): void
    {
        $response = $this->getResponseFromRequest(
            Request::METHOD_GET,
            '/api/files'
        );
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);

        //self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertResponseIsSuccessful();
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }
}
