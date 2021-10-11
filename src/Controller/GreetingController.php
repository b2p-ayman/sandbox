<?php

namespace App\Controller;

use App\Entity\Greeting;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class GreetingController extends AbstractController
{
    /**
     * @Route("/placenotif", name="placenotif")
     * @param MessageBusInterface $bus
     * @return Response
     */
    public function placeGreeting(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new Greeting(9));

        return new Response('Your greeting has been placed');
    }
}
