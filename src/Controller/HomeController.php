<?php
namespace App\Controller;
use App\Repository\BuyOneRepository;
use App\Repository\BuyRepository;
use Symfony\Component\HttpFoundation\Response;
use  Twig\Environment  ;

class HomeController{
    
    /**
     * @var Environment
     */
    private $twig;

    public function __construct($twig){
        $this->twig = $twig;
    }

    public  function index(BuyOneRepository $repository):Response{
        $buy=$repository->findLatest();

        return new Response($this->twig->render('pages/home.html.twig',['properties'=>$buy]));
    }
}