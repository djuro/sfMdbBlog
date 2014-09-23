<?php

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\Type\CommentType;
use Acme\BlogBundle\Document\Post;
use Acme\BlogBundle\Document\Comment;
use Acme\BlogBundle\Form\Model\Comment as FormComment;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use \DateTime;

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
        $dm = $this->get('doctrine_mongodb')->getManager();
    	$post = $dm->getRepository('AcmeBlogBundle:Post')->findOneBySlug($slug);

        
        $id = new \MongoId($post->getId());
        
        
		if (!$post)
        {
            throw $this->createNotFoundException('No Post found having slug: '.$slug);
        }

        $comments = $post->getComments();

        $formComment = new FormComment();
        $form = $this->createForm(new CommentType(), $formComment);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $comment = new Comment();
            if(!$comment)
            {
                new Exception("New comment has not been created.");
            }

            $comment->setText($formComment->getText());
            $comment->setAuthor($formComment->getAuthor());
            $comment->setCreatedAt(new DateTime());

            $post->addComment($comment);
            $dm->persist($post);
            $dm->flush();
        }

        return array(
            'post' => $post,
            'form' => $form->createView(),
            'comments' => $comments,
            'id' => $id,
            );
    }
}