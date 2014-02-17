<?php

namespace DeclareNounou\GestNounouBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DeclareNounou\GestNounouBundle\Entity\Contrat;
use DeclareNounou\GestNounouBundle\Form\ContratType;

/**
 * Contrat controller.
 *
 */
class ContratController extends Controller
{
    /**
     * Lists all Contrat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em
            ->getRepository('DeclareNounouGestNounouBundle:Contrat')
            ->findBy(
                array(),
                array('datefin'=>'desc')
        );

        return $this->render('DeclareNounouGestNounouBundle:Contrat:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Contrat entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contrat();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contrat_show', array('id' => $entity->getId())));
        }

        return $this->render('DeclareNounouGestNounouBundle:Contrat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Contrat entity.
    *
    * @param Contrat $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Contrat $entity)
    {
        $form = $this->createForm(new ContratType(), $entity, array(
            'action' => $this->generateUrl('contrat_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter', 'attr' => array('class' => 'btn btn-danger')));

        return $form;
    }

    /**
     * Displays a form to create a new Contrat entity.
     *
     */
    public function newAction()
    {
        $entity = new Contrat();
        $form   = $this->createCreateForm($entity);

        return $this->render('DeclareNounouGestNounouBundle:Contrat:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Contrat entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Contrat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contrat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Contrat:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contrat entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Contrat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contrat entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DeclareNounouGestNounouBundle:Contrat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Contrat entity.
    *
    * @param Contrat $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contrat $entity)
    {
        $form = $this->createForm(new ContratType(), $entity, array(
            'action' => $this->generateUrl('contrat_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add(
            'submit',
            'submit',
            array(
                'label' => 'Modifier',
                'attr' => array('class' => 'btn btn-warning')
            )
        );

        return $form;
    }

    /**
     * Edits an existing Contrat entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DeclareNounouGestNounouBundle:Contrat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contrat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contrat_edit', array('id' => $id)));
        }

        return $this->render('DeclareNounouGestNounouBundle:Contrat:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Contrat entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DeclareNounouGestNounouBundle:Contrat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contrat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contrat'));
    }

    /**
     * Creates a form to delete a Contrat entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this
            ->createFormBuilder()
            ->setAction($this->generateUrl('contrat_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
