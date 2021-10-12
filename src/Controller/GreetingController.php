<?php

namespace App\Controller;

use App\Entity\Greeting;
use App\Entity\Notification;
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
        /*$bus->dispatch(new Greeting(9));

        $theMssg = 'This is the message from Controller';
        $notification = new Notification();
        $notification->setBody($theMssg);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($notification);
        $entityManager->flush();*/

        return new Response('I passed from GreetingController ...');
    }
}
