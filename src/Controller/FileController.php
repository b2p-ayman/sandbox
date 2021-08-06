<?php


namespace App\Controller;


use App\Entity\File;
use App\Form\Type\FileType;
use App\Repository\FileRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    private $fileRepository;
    private $flashMessage;

    public function __construct(FileRepository $fileRepository, FlashBagInterface $flashMessage)
    {
        $this->fileRepository = $fileRepository;
        $this->flashMessage = $flashMessage;
    }

    /**
     * @Route("/", name="file_list")
     * @IsGranted("ROLE_USER")
     */
    public function index( )
    {
        $files = $this->fileRepository->findAll();

        return $this->render('home.html.twig',[
            "myFiles" => $files
        ]);
    }

    /**
     * @Route("/file/{id}", name="file_show")
     */
    public function showFile(int $id)
    {
        $file = $this->fileRepository
            ->find($id);

        return $this->render('show.html.twig',[
            "myFile" => $file
        ]);
    }

    /**
     * @Route("/create/file", name="file_create")
     */
    public function createFile(Request $request) : Response
    {
        $file = new File();
        //dd($this->getUser());
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $form->getData();
            $user = $this->getUser();
            $file->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();

            $this->flashMessage->add("success","Fichier ajouté !");
            return $this->redirectToRoute('file_list');
        }

        return $this->render('addFile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/file/{id}", name="file_edit")
     */
    public function modifyFile(File $file, Request $request) : Response
    {
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $file = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();

            $this->flashMessage->add("success","Fichier modifié !");
            return $this->redirectToRoute('file_list');
        }

        return $this->render('editFile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/file/{id}", name="file_delete")
     */
    public function deleteFile(File $file)
    {
        //$file = $this->fileRepository->find($id); // we can pass juste File $file as argument, symfony will understand
            // and search for the file with the $id

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($file);
        $entityManager->flush();

        $this->flashMessage->add("success","Fichier supprimé !");
        return $this->redirectToRoute('file_list');
    }

}