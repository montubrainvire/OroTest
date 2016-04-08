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
        
        ini_set('memory_limit', '-1');
        
        $searchResult    =  explode(' ', $searchElement);
        $finalDataArr = array();
         
        // define the path in which file is resides.
        $dir = $this->get('kernel')->getRootDir() . '/../web/uploads/files/';
        
        // if csv dir does not exist create new one
        if (!is_dir($dir))
            mkdir($dir);
        
        // call the finder class.
        $finder = new Finder();
        $finder->in($dir)->ignoreDotFiles(false);
        $finder->in($dir);   
        $finder->in($dir)->files()->name('*.*');
        
        foreach ($searchResult as $value){
            $finder->in($dir)->files()->contains($value);
        }
        foreach ($finder as $file) {
            $finalDataArr[]= $file->getRelativePathname();
        }
        $finalDataArr = array_unique($finalDataArr);
        
        return $finalDataArr;
    }
}

?>
