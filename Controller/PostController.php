<?php

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\Type\PostType;
use Acme\BlogBundle\Document\Post;
use Acme\BlogBundle\Document\Tag;
use Acme\BlogBundle\Form\Model\Post as FormPost;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/post")
*/
class PostController extends Controller
{

	/**
    * Displays post form and handles form submission.
    *
    * @Route("/new", name="blog_post_new")
    * @Template()
    */
    public function newAction(Request $request)
    {
    	 $formPost = new FormPost();

        
        $form = $this->createForm(new PostType(), $formPost);


        $form->handleRequest($request);

        if ($form->isValid())
        {
                        
            $post = new Post();

            $post->setTitle($formPost->getTitle());
            $post->setBody($formPost->getBody());

            $tags = $this->generateTags($formPost->getTags());

            $post->setTags($tags);
           

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($post);
            $dm->flush();

            return $this->redirect($this->generateUrl('blog_post_list'));

        }

        return array(
            'form' => $form->createView()
            );
    }


/**
    * Displays post form for editing and handles form submission.
    *
    * @Route("/edit/{postId}", name="blog_post_edit")
    * @Template()
    */
    public function editAction(Request $request, $postId)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $post = $dm->getRepository('AcmeBlogBundle:Post')->find($postId);

        if (!$post)
        {
            throw $this->createNotFoundException('No Post found having id: '.$postId);
        }

        $formPost = new FormPost();
        $formPost->setTitle($post->getTitle());
        $formPost->setBody($post->getBody());
        $formPost->setTags($this->formatTags($post->getTags()));

        $form = $this->createForm(new PostType(), $formPost);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $post->setTitle($formPost->getTitle());
            $post->setBody($formPost->getBody());
            $post->setTags($this->generateTags($formPost->getTags()));

            $dm->persist($post);
            $dm->flush();

            return $this->redirect($this->generateUrl('blog_post_list'));
        }

        return array(
            'form' => $form->createView()
            );
    }


    /**
    * Displays all posts, in grid.
    *
    * @Route("/list", name="blog_post_list")
    * @Template()
    */
    public function listAction(Request $request)
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
    * Deletes post.
    *
    * @Route("/delete/{postId}", name="blog_post_delete")
    * @Template()
    */
    public function deleteAction(Request $request, $postId)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $post = $dm->getRepository('AcmeBlogBundle:Post')->find($postId);

        if (!$post) 
        {
            throw $this->createNotFoundException('No Post found having id: '.$postId);
        }


        $dm->remove($post);
        $dm->flush();

        return $this->redirect($this->generateUrl('blog_post_list'));
    }

    /**
    * Instantiates new Tag objects and returns it as array.
    *
    * @param string Tags separated by comma.
    * @return Tag[]
    */
    private function generateTags($tags)
    {
    	$tagDocuments = [];

    	if(!empty($tags))
    	{
    		$explodedTags = explode(",",$tags);

    		foreach($explodedTags as $tagName)
    		{
    			$tagDocument = new Tag($tagName);
    			$tagDocuments[]=$tagDocument;
    		}
    	}

    	return $tagDocuments;
    }

    /**
    * @param Tag[]
    * @return string
    */
    private function formatTags($tags)
    {
        
        $tagsString = "";
        if(!empty($tags))
        {
            foreach($tags as $tag)
            {
                if(!empty($tagsString))
                {
                    $tagsString = $tagsString.','.$tag->getName();
                }
                else
                {
                    $tagsString = $tag->getName();
                }
                
            }
        }

        return $tagsString;
    }

    
}