<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Group;
use App\Security\UserVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientController extends AbstractController
{
    private $em;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    /**
     * @Route("/clients", name="show_client", methods={"GET", "POST"})
     */
    public function showClient()
    {
        $this->denyAccessUnlessGranted(UserVoter::VIEW_ADMIN, $this->getUser());

        $em = $this->getDoctrine()->getManager();

        $clients =  $em->getRepository(User::class)->findAll();

        return $this->render('Client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/new", name="new_client", methods={"GET", "POST"})
     */
    public function newClient()
    {
        $this->denyAccessUnlessGranted(UserVoter::VIEW_ADMIN, $this->getUser());

        return $this->render('Client/new.html.twig');
    }

    /**
     * @Route("/create-client", name="create_client", methods={"GET", "POST"})
     */
    public function createClientAction(Request $request)
    {
        $this->denyAccessUnlessGranted(UserVoter::CREATE_USER_ACTION, $this->getUser());

        $em = $this->getDoctrine()->getManager();

        //переделать -> все группы кроме админа в select
        $group = $em->getRepository(Group::class)->findOneBy(['name' => 'client']);

        if ($request->isXmlHttpRequest()) {

            $user = new User();
            $user
                ->setLogin($request->get('login'))
                ->setPassword($this->passwordEncoder->encodePassword($user, $request->get('pass')))
                ->setName($request->get('name'))
                ->setSurname($request->get('surname'))
                ->setPhone($request->get('phone'))
                ->setEmail($request->get('email'))
                ->setGroups([$group]);

            $em->persist($user);
            $em->flush();

            return new JsonResponse('success');
        }

        return new JsonResponse('error');
    }
}
