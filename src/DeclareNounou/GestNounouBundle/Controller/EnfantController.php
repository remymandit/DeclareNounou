<?php

namespace DeclareNounou\GestNounouBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DeclareNounou\GestNounouBundle\Entity\Enfant;
use DeclareNounou\GestNounouBundle\Form\EnfantType;

/**
 * Enfant controller.
 *
 */
class EnfantController extends Controller
{
    /**
     * Lists all Enfant entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DeclareNounouGestNounouBundle:Enfant')->findAll();

        return $this->render('DeclareNounouGestNounouBundle:Enfant:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Enfant entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Enfant();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enfant_show', array('id' => $entity->getId())));
        }

        return $this->render('DeclareNounouGestNounouBundle:Enfant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Enfant entity.
    *
    * @param Enfant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Enfant $entity)
    {
        $form = $this
            ->createForm(new EnfantType(), $entity, array(
                'action' => $this->generateUrl('enfant_create'),
                'method' => 'POST',
            )
        );

        $form->add(
            'submit',
            'submit',
            array(
                'label' => 'Ajouter',
                'attr' => array('class' => 'btn btn-danger')
            )
        );

        return $form;
    }

    /**
     * Displays a form to create a new Enfant entity.
     *
     */
    public function newAction()
    {
        $entity = new Enfant();
        $form   = $this->createCreateForm($entity);

        return $this->render('DeclareNounouGestNounouBundle:Enfant:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Enfant entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Enfant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enfant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Enfant:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Enfant entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Enfant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enfant entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Enfant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Enfant entity.
    *
    * @param Enfant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Enfant $entity)
    {
        $form = $this->createForm(new EnfantType(), $entity, array(
            'action' => $this->generateUrl('enfant_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier', 'attr' => array('class' => 'btn btn-warning')));

        return $form;
    }

    /**
     * Edits an existing Enfant entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Enfant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enfant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('enfant_edit', array('id' => $id)));
        }

        return $this->render('DeclareNounouGestNounouBundle:Enfant:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Enfant entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DeclareNounouGestNounouBundle:Enfant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Enfant entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('enfant'));
    }

    /**
     * Creates a form to delete a Enfant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('enfant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
