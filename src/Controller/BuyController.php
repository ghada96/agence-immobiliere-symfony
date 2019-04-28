<?php
namespace App\Controller;
use App\Entity\Buy;
use App\Repository\BuyOneRepository;
use App\Repository\BuyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  Twig\Environment  ;


class BuyController extends AbstractController {
    /**
     * @Route("/buy" , name="buy.index")
     * @var Environment
     * @return Response
     */

    private $repository;

    public function __construct(BuyOneRepository $repository){
        $this->repository= $repository;
    }


    public function index():response{
        $properties=$this->repository->findAllVisible();
        $buy=new Buy();
        $buy->setTitle("mon premier bien")
            ->setPrice("256")
            ->setRooms(4)
            ->setBedroom(3)
            ->setDescription("c'est une description")
            ->setSurface(500)
            ->setChauffage("electrique")
            ->setFloor(4)
            ->setCity("sousse")
            ->setAddress("rue ibn khaldoun")
            ->setCodepostal(4000);
        //EntityManager gere la persistence au sein de la base de données
        $en=$this->getDoctrine()->getManager();
        //persister $buy
        $en->persist($buy);
        //porter le changement qui ont été fait   au niveau de l 'entitymanager dans la base de données
        //envoyer $buy au base de données
        $en->flush();
        //$buy=$this->repository->findBy(['floor'=>3]);
        //$buy=$this->repository->findAllVisible();

        // envoyer buy a la vue
        dump($buy);

        return $this->render('pages/buy.html.twig', [
            "properties"=>$properties
        ]);
    }
    /**
     * @Route("/buy/{slug}.{id}" , name="buy.show")
     *
     * @return Response
     */
    public function show($slug,$id):Response{
        $property=$this->repository->find($id);
        return $this->render('pages/show.html.twig',['property'=>$property]);

    }
}