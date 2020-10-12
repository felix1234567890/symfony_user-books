<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api/register", name="register", methods={"POST"})
 * @View(statusCode=201)
 */
class RegisterController
{
    private FormFactoryInterface $formFactory;
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $encoder;

    public function __construct( FormFactoryInterface $factory,
                                 UserPasswordEncoderInterface $encoder,
                                 EntityManagerInterface $em)
    {
        $this->formFactory = $factory;
        $this->encoder = $encoder;
        $this->entityManager = $em;
    }

    public function __invoke(Request $request)
    {
        $user = new User();
        $form = $this->formFactory->createNamed('user', UserType::class, $user);
        $form->submit($request->request->get('user'));

        if($form->isValid()){
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return ['user' => $user];
        }
        return ['form' => $form];
    }
}
