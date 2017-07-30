<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $reports = $em->getRepository('AppBundle:Report')->findRecent();

        return $this->render('report/index.html.twig', [
            'reports' => $reports,
            'colours' => $this->generateColours(count($reports)),
        ]);
    }

    public function generateColours($number)
    {
        $start = [255, 30, 20];
        $end = [255, 255, 0];
        $colours = [];
        for ($x = 2; $x <= $number; $x++) {
            $colours = $this->graduateRGB($start, $end, $x);
        }
        return $colours;
    }

    public function graduateRGB($c1, $c2, $nc)
    {
        $c = [];
        $dc = [($c2[0] - $c1[0]) / ($nc - 1), ($c2[1] - $c1[1]) / ($nc - 1), ($c2[2] - $c1[2]) / ($nc - 1)];
        for ($i = 0; $i < $nc; $i++) {
            $c[$i][0] = round($c1[0] + $dc[0] * $i);
            $c[$i][1] = round($c1[1] + $dc[1] * $i);
            $c[$i][2] = round($c1[2] + $dc[2] * $i);
            $c[$i] = sprintf("%02x%02x%02x", $c[$i][0], $c[$i][1], $c[$i][2]);
        }

        return $c;
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

        return $this->render('report/new.html.twig', [
            'report' => $report,
            'form' => $form->createView(),
        ]);
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

        return $this->render('report/edit.html.twig', [
            'report' => $report,
            'edit_form' => $editForm->createView(),
        ]);
    }
}
