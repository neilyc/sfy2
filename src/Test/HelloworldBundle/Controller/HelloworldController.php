<?php

namespace Test\HelloworldBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Test\HelloworldBundle\Model\Country;
use Test\HelloworldBundle\Model\Info;
use Test\HelloworldBundle\Model\CountryQuery;

class HelloworldController extends Controller
{
    public function indexAction()
    {
        $countries = CountryQuery::create()->find();
        $context = array('name' => $this->getUser(),
                         'countries' => $countries);

        return $this->render('TestHelloworldBundle::index.html.twig', $context);
    }

    public function helloAction()
    {
        $countries = CountryQuery::create()->find();
        $context = array('name' => $this->getUser(),
                         'countries' => $countries);

        return $this->render('TestHelloworldBundle::indexUser.html.twig', $context);
    }

    public function helloAdminAction()
    {
        $countries = CountryQuery::create()->find()->toKeyValue('Id', 'Name');
        $context = array('name' => $this->getUser(),
                         'countries' => $countries);

        return $this->render('TestHelloworldBundle::indexAdmin.html.twig', $context);
    }

    public function addCountryAction()
    {

        $country = new Country();
        $country->setName($this->get('request')->request->get('_country'));
        $country->save();

        return $this->redirect($$this->generateUrl("_helloworld_admin"));
    }

    public function addInfoAction()
    {

        $info = new Info();
        $info->setCountryId($this->get('request')->request->get('_country'));
        $info->setName($this->get('request')->request->get('_name'));
        $info->setInfo($this->get('request')->request->get('_info'));
        $info->save();

        return $this->redirect($this->generateUrl("_helloworld_admin"));
    }

    public function getUser()
    {
        $name = 'Anonymous';
        if ($this->container->get('security.context')->getToken()->getUser() != 'anon.') {
            $name = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        }

        return $name;
    }
}
