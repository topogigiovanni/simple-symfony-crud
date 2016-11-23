<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategoriaProduto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoriaController extends Controller
{

	/**
     * @Route("/categorias", name="category_list")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $categories = $em->getRepository('AppBundle:CategoriaProduto')->findAll();

        return $this->render('categoria/list.html.twig', [
            'categories' => $categories
            ]
        );
    }

    /**
     * @Route("/categorias/criar", name="category_create")
     */
    public function createAction(Request $request)
    {

        $category = new CategoriaProduto();

        $saveForm = $this->get('form.factory')
            ->createNamed(
                '',
                'AppBundle\Form\Type\CategoriaSaveType',
                $category,
                array(
                    'action' => $this->generateUrl('category_create'),
                    'method' => 'POST'
                )
            );

        $saveForm->handleRequest($request);
        
        if ($saveForm->isSubmitted() && $saveForm->isValid()) {
            $category = $saveForm->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush();

            $this->addFlash(
                'success',
                'Categoria salva com sucesso!'
            );

            return $this->redirectToRoute('category_list', [
			    'request' => $request
			], 301);
        }

        return $this->render('categoria/save.html.twig', [
            'form' => $saveForm->createView()
        	]
        );

    }

    /**
     * @Route("/categorias/editar/{idCategoriaPlanejamento}", name="category_edit")
     */
    public function editAction(CategoriaProduto $category, Request $request)
    {

        $categoryForm = $this->get('form.factory')
            ->createNamed(
                '',
                'AppBundle\Form\Type\CategoriaSaveType',
                $category,
                array(
                    'action' => $this->generateUrl('category_edit', array('idCategoriaPlanejamento' => $category->getIdCategoriaPlanejamento())),
                    'method' => 'POST'
                )
            ); 


        $categoryForm->handleRequest($request);       
        
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
        	
        	$category = $categoryForm->getData();
	        $em = $this->getDoctrine()->getManager();

	        $em->merge($category);
			$em->flush();

	        $this->addFlash(
	            'success',
	            'Categoria editada!'
	        );

	        return $this->redirectToRoute('category_list', [
			    'request' => $request
			], 301);
        }

        return $this->render('categoria/save.html.twig', [
            'form' => $categoryForm->createView(),
        	]
        );

    }

    /**
     * @Route("/categorias/deletar/{idCategoriaPlanejamento}", name="category_delete")
     * @Method("POST")
     */
    public function deleteAction(CategoriaProduto $category, Request $request)
    {
      
      	$response = array('isValid' => false);
        
        if (!is_null($category)) {
        	
	        $em = $this->getDoctrine()->getManager();

	        $em->remove($category);
	        $em->flush();

	        $response['isValid'] = true;

        }


		return new JsonResponse($response);


    }

}