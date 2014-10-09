<?php

namespace DeclareNounou\GestNounouBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DeclareNounou\GestNounouBundle\Entity\Pointage;
use DeclareNounou\GestNounouBundle\Form\PointageType;

/**
 * Pointage controller.
 *
 */
class PointageController extends Controller
{

    /**
     * Lists all Pointage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DeclareNounouGestNounouBundle:Pointage')->findAll();

        return $this->render('DeclareNounouGestNounouBundle:Pointage:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pointage entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pointage();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pointage_show', array('id' => $entity->getId())));
        }

        return $this->render('DeclareNounouGestNounouBundle:Pointage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Pointage entity.
    *
    * @param Pointage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pointage $entity)
    {
        $form = $this->createForm(new PointageType(), $entity, array(
            'action' => $this->generateUrl('pointage_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter','attr' => array('class' => 'addButton btn btn-danger')));

        return $form;
    }

    /**
     * Displays a form to create a new Pointage entity.
     *
     */
    public function newAction()
    {
        $entity = new Pointage();
        $form   = $this->createCreateForm($entity);

        return $this->render('DeclareNounouGestNounouBundle:Pointage:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pointage entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Pointage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pointage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Pointage:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Pointage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Pointage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pointage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Pointage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pointage entity.
    *
    * @param Pointage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pointage $entity)
    {
        $form = $this->createForm(new PointageType(), $entity, array(
            'action' => $this->generateUrl('pointage_update', array('id' => $entity->getId())),
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
     * Edits an existing Pointage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Pointage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pointage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pointage_edit', array('id' => $id)));
        }

        return $this->render('DeclareNounouGestNounouBundle:Pointage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pointage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DeclareNounouGestNounouBundle:Pointage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pointage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pointage'));
    }

    /**
     * Creates a form to delete a Pointage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this
                ->createFormBuilder()
                ->setAction($this->generateUrl('pointage_delete', array('id' => $id)))
                ->setMethod('DELETE')
                ->add(
                    'submit',
                    'submit',
                    array(
                        'label' => 'Supprimer',
                        'attr' => array('class' => 'deleteButton btn btn-danger')
                        )
                    )
            ->getForm()
        ;
    }
}
