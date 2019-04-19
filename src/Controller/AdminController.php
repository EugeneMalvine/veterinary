<?php
namespace App\Controller;

use App\Security\UserVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
	/**
     * @Route("/", name="home", methods={"GET", "POST"})
     */
	public function indexAction()
	{
		$this->denyAccessUnlessGranted(UserVoter::CREATE_USER_ACTION, $this->getUser());

		return $this->render('Admin/home.html.twig');
	}

}