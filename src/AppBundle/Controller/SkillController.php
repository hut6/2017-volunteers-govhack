<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Skill;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Skill controller.
 *
 * @Route("skill")
 */
class SkillController extends AppController
{
    /**
     * Lists all skill entities.
     *
     * @Route("/", name="skill_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository(Skill::class)->findAll();

        return $this->render('skill/index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * Creates a new skill entity.
     *
     * @Route("/new", name="skill_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $skill = new Skill();
        $form = $this->createForm('AppBundle\Form\SkillType', $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            return $this->redirectToRoute('skill_index');
        }

        return $this->render('skill/new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing skill entity.
     *
     * @Route("/{id}/edit", name="skill_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Skill $skill)
    {
        $editForm = $this->createForm('AppBundle\Form\SkillType', $skill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skill_index');
        }

        return $this->render('skill/edit.html.twig', array(
            'skill' => $skill,
            'edit_form' => $editForm->createView(),
        ));
    }

}
