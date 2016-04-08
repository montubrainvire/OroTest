<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $searchElement = '';
        $result = array();
        if ($request->getMethod() == "POST") {
            $searchElement = $request->request->get('search');
            if ($searchElement != '') {
                // call the finder services...
                $result = $this->get('finderService')->getFinderData($searchElement);
            }
        }
        return $this->render('AcmeTestBundle:Default:index.html.twig', array('result' => $result, 'searchElement' => $searchElement));
    }

}
