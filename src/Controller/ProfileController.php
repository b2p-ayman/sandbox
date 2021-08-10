<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('file_list');
        }

        $user = $this->getUser();
        $files = $user->getFiles();

        //// La pagination
        $files = $paginator->paginate(
            $files, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'userFiles' => $files
        ]);
    }
}
