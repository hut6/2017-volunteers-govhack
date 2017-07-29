<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmergencyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Emergencytype controller.
 *
 * @Route("emergencytype")
 */
class EmergencyTypeController extends Controller
{
    /**
     * Lists all emergencyType entities.
     *
     * @Route("/", name="emergencytype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emergencyTypes = $em->getRepository('AppBundle:EmergencyType')->findAll();

        return $this->render('emergencytype/index.html.twig', array(
            'emergencyTypes' => $emergencyTypes,
        ));
    }

    /**
     * Creates a new emergencyType entity.
     *
     * @Route("/new", name="emergencytype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $emergencyType = new Emergencytype();
        $form = $this->createForm('AppBundle\Form\EmergencyTypeType', $emergencyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emergencyType);
            $em->flush();

            return $this->redirectToRoute('emergencytype_index');
        }

        return $this->render('emergencytype/new.html.twig', array(
            'emergencyType' => $emergencyType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing emergencyType entity.
     *
     * @Route("/{id}/edit", name="emergencytype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EmergencyType $emergencyType)
    {
        $editForm = $this->createForm('AppBundle\Form\EmergencyTypeType', $emergencyType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emergencytype_edit', array('id' => $emergencyType->getId()));
        }

        return $this->render('emergencytype/edit.html.twig', array(
            'emergencyType' => $emergencyType,
            'edit_form' => $editForm->createView(),
        ));
    }

}
