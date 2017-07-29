<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Entity\Interfaces\Common\WorkflowInterface;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\ExceptionInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    const PAGINATION_LIMIT = 25;

    /**
     * @var array
     */
    protected $exportFormats = array('csv', 'xml', 'pdf');

    /**
     * @return string|null
     */
    protected function getFormAction()
    {
        foreach ($this->getRequest()->request->all() as $key => $val) {
            if (preg_match('/^action:(.+)$/', $key, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    /**
     * @return boolean
     */
    protected function isFormAction($actionName)
    {
        return $this->getFormAction() == $actionName;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->get('request_stack')->getCurrentRequest();
    }

    /**
     * @param string $formType
     * @param object $collectionFilter
     * @param array $options
     * @return \Symfony\Component\Form\Form
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     */
    protected function createFilterForm($formType, $collectionFilter, $options = [])
    {
        $filterForm = $this->createForm($formType, $collectionFilter, $options);
        if ($this->getRequest()->get($filterForm->getName())) {
            $filterForm->submit($this->getRequest()->get($filterForm->getName()), false);
        }

        return $filterForm;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|EntityManager|object
     */
    protected function em()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param string $entityName
     *
     * @return \Doctrine\ORM\EntityRepository
     * @throws \LogicException
     */
    protected function repository($entityName = null)
    {
        return $this->em()->getRepository($entityName);
    }

    /**
     * @param mixed $entity
     */
    protected function update($entity)
    {
        $this->em()->persist($entity);
        $this->em()->flush();
    }

    /**
     * @param mixed $password
     * @param User $user
     *
     * @return User
     */
    protected function updatePassword($password, $user = null, $flush = false)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user->setPlainPassword($password);
        $userManager->updateUser($user, $flush);
        return $user;
    }

    /**
     * Check if page request is a export format
     * @return boolean
     */
    protected function isExportRequest()
    {
        return in_array($this->get('request_stack')->getCurrentRequest()
            ->getRequestFormat(), $this->exportFormats, true);
    }

    /**
     * Check if page request is a export format
     * @return boolean
     */
    protected function isFilterRequest()
    {
        return $this->get('request_stack')->getCurrentRequest()->query->has("filter");
    }

    /**
     * @param $queryBuilder
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     * @throws \LogicException
     */
    public function paginate($queryBuilder)
    {
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryBuilder,
            $this->getRequest()->query->getInt('page', 1),
            self::PAGINATION_LIMIT
        );

        return $pagination;
    }

    /**
     * @param $collection
     * @return Response
     */
    public function renderJSON($collection)
    {
        $response = new Response(json_encode($collection), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
