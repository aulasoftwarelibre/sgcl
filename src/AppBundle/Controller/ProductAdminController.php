<?php
/**
 * Created by PhpStorm.
 * User: jmb
 * Date: 25/03/15
 * Time: 23:06
 */

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;
use AppBundle\Entity;

class ProductAdminController extends Controller
{
    public function getTrademarkOptionsFromProductAction($trademarkId)
    {
        $html = ""; // HTML as response
        $trade = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($trademarkId);

        $categories = $trade->getTrademark();

        foreach($categories as $cat){
            $html .= '<option value="'.$cat->getId().'" >'.$cat->getName().'</option>';
        }

        return new Response($html, 200);
    }
}
