<?php

namespace DeclareNounou\GestNounouBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DeclareNounou\GestNounouBundle\Entity\Nounou;
use DeclareNounou\GestNounouBundle\Form\NounouType;

/**
 * Nounou controller.
 *
 */
class NounouController extends Controller
{
    /**
     * Lists all Nounou entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DeclareNounouGestNounouBundle:Nounou')->findByUser($this->getUser());

        return $this->render('DeclareNounouGestNounouBundle:Nounou:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Nounou entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Nounou();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUser($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nounou_show', array('id' => $entity->getId())));
        }

        return $this->render('DeclareNounouGestNounouBundle:Nounou:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Nounou entity.
    *
    * @param Nounou $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Nounou $entity)
    {
        $form = $this->createForm(new NounouType(), $entity, array(
            'action' => $this->generateUrl('nounou_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter', 'attr' => array('class' => 'addButton btn btn-danger')));

        return $form;
    }

    /**
     * Displays a form to create a new Nounou entity.
     *
     */
    public function newAction()
    {
        $entity = new Nounou();
        $form   = $this->createCreateForm($entity);

        return $this->render('DeclareNounouGestNounouBundle:Nounou:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Nounou entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Nounou')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nounou entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Nounou:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Nounou entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Nounou')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nounou entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Nounou:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Nounou entity.
    *
    * @param Nounou $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Nounou $entity)
    {
        $form = $this->createForm(new NounouType(), $entity, array(
            'action' => $this->generateUrl('nounou_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add(
            'submit',
            'submit',
            array(
                'label' => 'Modifier',
                'attr' => array('class' => 'updateButton btn btn-warning')
            )
        );

        return $form;
    }

    /**
     * Edits an existing Nounou entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Nounou')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nounou entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nounou_edit', array('id' => $id)));
        }

        return $this->render('DeclareNounouGestNounouBundle:Nounou:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Nounou entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DeclareNounouGestNounouBundle:Nounou')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nounou entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nounou'));
    }

    /**
     * Creates a form to delete a Nounou entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nounou_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'deleteButton btn btn-danger')))
            ->getForm()
        ;
    }
}
