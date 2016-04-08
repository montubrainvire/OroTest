<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;

class FinderServiceController extends Controller {

    protected $container;
    protected $em;
    protected $session;
    protected $securitycontext;
    protected $request;

    public function __construct($container) {

        $this->container = $container;

        $this->em = $container->get('doctrine')->getManager();
        $this->session = $container->get('session');
        $this->securitycontext = $container->get('security.context');
        $this->request = $container->get('request');
    }
    
    // return search file names..
    public function getFinderData($searchElement){
        
        //ini_set('memory_limit', '-1');
        
        $searchV    =  explode(' ', $searchElement);
        $csvFinalDataArr = array();
         
        // define the path in which file is resides.
        $csvDir = $this->get('kernel')->getRootDir() . '/../web/uploads/files/';
        
        // if csv dir does not exist create new one
        if (!is_dir($csvDir))
            mkdir($csvDir);
        
        // call the finder class.
        $finder = new Finder();
        $finder->in($csvDir)->ignoreDotFiles(false);
        $finder->in($csvDir);   
        $finder->in($csvDir)->files()->name('*.*');
        
        foreach ($searchV as $value){
            $finder->in($csvDir)->files()->contains($value);
        }
        foreach ($finder as $file) {
            $csvFinalDataArr[]= $file->getRelativePathname();
        }
        $csvFinalDataArr = array_unique($csvFinalDataArr);
        
        return $csvFinalDataArr;
    }
}

?>
