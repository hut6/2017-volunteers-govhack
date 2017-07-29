<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Report controller.
 *
 * @Route("report")
 */
class ReportController extends AppController
{
    /**
     * Lists all report entities.
     *
     * @Route("/", name="report_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reports = $em->getRepository('AppBundle:Report')->findBy(['archive' => false]);

        return $this->render('report/index.html.twig', array(
            'reports' => $reports,
        ));
    }

    /**
     * Creates a new report entity.
     *
     * @Route("/new", name="report_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $report = new Report();
        $form = $this->createForm('AppBundle\Form\ReportType', $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            return $this->redirectToRoute('report_index');
        }

        return $this->render('report/new.html.twig', array(
            'report' => $report,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing report entity.
     *
     * @Route("/{id}/edit", name="report_ignore")
     * @Method({"GET", "POST"})
     */
    public function ignoreAction(Request $request, Report $report)
    {
        $report->setArchive(true);
        $this->em()->flush();

        return $this->redirectToRoute("report_index");

    }

    /**
     * Displays a form to edit an existing report entity.
     *
     * @Route("/{id}/edit", name="report_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Report $report)
    {
        $editForm = $this->createForm('AppBundle\Form\ReportType', $report);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('report_index');
        }

        return $this->render('report/edit.html.twig', array(
            'report' => $report,
            'edit_form' => $editForm->createView(),
        ));
    }
}
