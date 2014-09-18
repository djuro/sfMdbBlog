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
}