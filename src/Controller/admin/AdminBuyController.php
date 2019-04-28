<?php
namespace App\Controller\admin;
use App\Entity\Buy;
use App\Form\BuyType;
use App\Repository\BuyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;


class AdminBuyController extends AbstractController{
    /**
     * @var BuyRepository*/
    private $repository;
    /**
     * @var ObjectManager*/
    private $em;

    public function __construct(BuyRepository $repository,ObjectManager $em)
    {
        $this->repository=$repository;
        $this->em=$em;
    }

    /**
     * @Route("/admin" , name="admin.buy.index")
     *
     *
     */
    public function index():Response{
       $properties= $this->repository->findAll();
        return $this->render('pages/admin/index.html.twig',['properties'=>$properties]);

    }
    /**
     *@Route("/admin/{id}" , name="admin.buy.edit")
     *@param Request $request
     *@param Buy $buy
     * @return Response
     */

    public  function edit(Buy $buy,Request $request){

        $form=$this->createForm(BuyType::class,$buy);
        //gerer la requete
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($buy);
            $this->em->flush();
            return $this->redirectToRoute('admin.buy.index');

        }
        return $this->render('pages/admin/edit.html.twig',['buy'=>$buy ,
            'form'=>$form->createView()]);





    }
    /**
     *@Route("/admin/buy/create" , name="admin.buy.create")

     */
    public  function create(Request $request){
        $buy=new Buy();
        $form=$this->createForm(BuyType::class,$buy);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($buy);
            $this->em->flush();
            return $this->redirectToRoute('admin.buy.index');

        }

        return $this->render('pages/admin/create.html.twig',['buy'=>$buy ,
            'form'=>$form->createView()]);

    }
    /**
     *@Route("/admin/buy/{id}" , name="admin.buy.delete" ,methods="DELETE")
     * @param Buy $buy
     * @return Response

     */
    public function delete(Buy $buy,Request $request){

        $this->em->remove($buy);
        $this->em->flush();

        return $this->redirectToRoute('admin.buy.index');

    }
}