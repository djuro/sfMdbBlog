<?php

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\Type\UserType;
use Acme\BlogBundle\Document\User;
use Acme\BlogBundle\Form\Model\User as FormUser;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/user")
*/
class UserController extends Controller
{
    
	/**
    * Displays user form and handles form submission.
    *
    * @Route("/new", name="blog_user_new")
    * @Template()
    */
    public function newAction(Request $request)
    {
        $formUser = new FormUser();

        $form = $this->createForm(new UserType(), $formUser);


        $form->handleRequest($request);

        if ($form->isValid())
        {
                        
            $documentUser = new User();

            $documentUser->setFirstName($formUser->getFirstName());
            $documentUser->setLastName($formUser->getLastName());
            $documentUser->setPassword($formUser->getPassword());
            $documentUser->setEmail($formUser->getEmail());

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($documentUser);
            $dm->flush();

            return $this->redirect($this->generateUrl('blog_user_list'));

        }

        return array(
            'form' => $form->createView()
            );
    }


    /**
    *  Lists user data in grid.
    *
    * @Route("/list",name="blog_user_list")
    * @Template()
    */
    public function listAction()
    {
        $users = $this ->get('doctrine_mongodb')
                        ->getRepository('AcmeBlogBundle:User')
                        ->findAll();

        if (!$users) 
        {
            throw $this->createNotFoundException('No Users found');
        }

        return array(
            'users' => $users
            );
    }


    /**
    *  Displays user form for editing and handles form submission.
    *
    * @Route("/edit/{userId}",name="blog_user_edit")
    * @Template()
    */
    public function editAction(Request $request, $userId)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $documentUser = $dm->getRepository('AcmeBlogBundle:User')->find($userId);

        if (!$documentUser)
        {
            throw $this->createNotFoundException('No User found having id: '.$userId);
        }

        $formUser = new FormUser();
        $formUser->setFirstName($documentUser->getFirstName());
        $formUser->setLastName($documentUser->getLastName());
        $formUser->setEmail($documentUser->getEmail());

        $form = new UserType();

        $form = $this->createForm(new UserType(), $formUser);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $documentUser->setFirstName($formUser->getFirstName());
            $documentUser->setLastName($formUser->getLastName());
            $documentUser->setEmail($formUser->getEmail());

            $dm->persist($documentUser);
            $dm->flush();

            return $this->redirect($this->generateUrl('blog_user_list'));
        }

        return array(
            'form' => $form->createView()
            );
    }


}
