<?php


namespace App\Controller;


use App\Entity\File;
use App\Form\Type\FileType;
use App\Repository\FileRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

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
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $files = $this->fileRepository->findAll();

        //// La pagination
        $files = $paginator->paginate(
            $files, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

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
    public function createFile(Request $request, FileUploader $fileUploader) : Response
    {
        $file = new File();
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $file->setBrochureFilename($brochureFileName);
            }

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

    /**
     * @Route("/refuse_accept/file/{id}/{refuse_accept}", name="file_refuse_accept")
     */
    public function refuseAccepteFile(File $file, string $refuse_accept)
    {
        if($refuse_accept == 'accept')
            $file->setStateFile(true);
        elseif ($refuse_accept == 'refus')
            $file->setStateFile(false);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($file);
        $entityManager->flush();

        $this->flashMessage->add("success","Le fichier a été traité avec succès !");
        return $this->redirectToRoute('file_list');
    }

}