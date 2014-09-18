<?php

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\Type\UserType;
use Acme\BlogBundle\Document\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    

	/**
     * @Route("/new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $form = new UserType();
        $form = $this->createForm( new UserType());


        $form->handleRequest($request);

        if ($form->isValid()) {
            // spremiti u bazu
            $data = $form->getData();

            $user = new User();


    $user->setFirstName('Pero');
    $user->setLastName('Perić');

    $dm = $this->get('doctrine_mongodb')->getManager();
    $dm->persist($user);
    $dm->flush();
            //return $this->redirect($this->generateUrl('task_success'));

        }

        return array(
            'form' => $form->createView()
            );
    	//return array('nesto' => "Ovo je kako nekakav tekst za prvu stranicu ...");
    }


}
