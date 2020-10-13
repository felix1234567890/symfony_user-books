<?php

namespace App\Controller\User;

use App\Form\UserType;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api/user", name="update_user", methods={"PUT"})
 */
class UpdateUserController
{
  private UserResolver $userResolver;
  private EntityManagerInterface $entityManager;
  private FormFactoryInterface $formFactory;

  public function __construct(UserResolver $userResolver,FormFactoryInterface $formFactory,
                              EntityManagerInterface $entityManager)
  {
      $this->userResolver = $userResolver;
      $this->formFactory = $formFactory;
      $this->entityManager = $entityManager;
  }

    public function __invoke(Request $request)
    {
      $user = $this->userResolver->getCurrentUser();
      $form = $this->formFactory->createNamed('user', UserType::class, $user);
      $form->submit($request->request->get('user'), false);
      if($form->isValid()){
          $this->entityManager->flush();
          return ['user'=>$user];
      }
      return ['form'=>$form];
    }
}
