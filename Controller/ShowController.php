<?php

namespace Acme\BlogBundle\Controller;

//use Acme\BlogBundle\Form\Type\PostType;
use Acme\BlogBundle\Document\Post;
use Acme\BlogBundle\Document\Tag;
//use Acme\BlogBundle\Form\Model\Post as FormPost;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class ShowController extends Controller
{

	/**
    * Displays several recent post titles with text snippets.
    *
    * @Route("/home", name="blog_show_home")
    * @Template()
    */
    public function homeAction(Request $request)
    {
    	$posts = $this ->get('doctrine_mongodb')
                        ->getRepository('AcmeBlogBundle:Post')
                        ->findAll();

        if (!$posts) 
        {
            throw $this->createNotFoundException('No Posts found');
        }

        return array(
            'posts' => $posts
            );
    }

    /**
    * Displays selected post.
    *
    * @Route("/{slug}", name="blog_show_slug")
    * @Template()
    */
    public function articleAction(Request $request, $slug)
    {
    	$post = $this->get('doctrine_mongodb')
        ->getRepository('AcmeBlogBundle:Post')
        ->findOneBySlug($slug);

		if (!$post)
        {
            throw $this->createNotFoundException('No Post found having slug: '.$slug);
        }
        return array(
            'post' => $post
            );
    }
}