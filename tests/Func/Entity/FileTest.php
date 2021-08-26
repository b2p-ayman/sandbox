<?php

namespace App\Tests\Func\Entity;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }
}
