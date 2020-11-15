<?php

namespace App\Controller;

use App\Entity\ReqUser;
use App\Form\ReqUserType;
use App\Repository\ReqUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Security\Core\Security;

class RequestIndexController extends AbstractController
{
    /**
     * @var ReqUserRepository
     */

    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var Security
     */
    private $security;

    public function __construct(ReqUserRepository $repository, EntityManagerInterface $em, Security $security)
    {
        $this->repository = $repository;
        $this->em = $em;
        $this->security = $security;
    }

    /**
     * @Route("/request/index", name="request_index")
     * @param Request $request
     * @param $repository
     * @return Response
     */
    public function index(Request $request,ReqUserRepository $repository) : Response
    {
        $req = new ReqUser();
        $form = $this->createForm(ReqUserType::class, $req);
        $form->handleRequest($request);
        $client = HttpClient::create();
        $user = $this->security->getUser();
        $u =
        $requs = $user->getRequest;

        if ($form->isSubmitted() && $form->isValid()){
            $meth = $form->get('Method')->getData();
            $url = $form->get('Url')->getData();
            $token = $form->get('Token')->getData();
            $body = $form->get('Body')->getData();

            if ($meth == 0){
                $methode = "GET";
            } elseif ($meth == 1) {
                $methode = "POST";
            } elseif ($meth == 2) {
                $methode = "UPDATE";
            } elseif ($meth == 3) {
                $methode = "DELETE";
            }

            $response = $client->request($methode, $url, [
                'headers' => [
                    'token' => $token,
                ],
            ]);
            $content = $response->getContent();
            var_dump($content);

            $data = new ReqUser();
            $data->setMethod($meth)
            ->setUrl($url)
            ->setToken($token)
            ->setBody($body)
            ->setReqResponse($content)
            ->setUserReq($user);
            $this->em->persist($data);
            $this->em->flush();
            return $this->redirectToRoute('request_index');
        }

        return $this->render('request_index/index.html.twig', [
            'request' => $req,
            'form' => $form->createView(),
            'controller_name' => 'RequestIndexController',
            'requs' => $requs,
        ]);
    }
}
