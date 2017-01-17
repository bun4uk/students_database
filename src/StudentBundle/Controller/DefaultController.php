<?php

namespace StudentBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    const CACHE_TIME = 5;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $repo = $this->getDoctrine()->getRepository('StudentBundle:Student');
        dump($repo->getSlugs()); die;

    }

    /**
     *
     * @param $slug
     *
     * @Route("/student/{slug}", name="student")
     *
     * @return Response
     */
    public function studentAction($slug)
    {
        $repo = $this->getDoctrine()->getRepository('StudentBundle:Student');

        $student = $repo->findOneBy(['path' => $slug]);

        return $this->render('default/index.html.twig', [
            'student' => $student,
            'time' => (new \DateTime())->format('d-m-Y H:i:s'),
        ])
            ->setMaxAge(self::CACHE_TIME)
            ->setSharedMaxAge(self::CACHE_TIME);

    }
}
