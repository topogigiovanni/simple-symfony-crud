<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProdutoController extends Controller
{

    /**
     * @Route("/produtos", name="product_list")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $products = $em->getRepository('AppBundle:Produto')->findAll();

        Dump($products);
        //die;

        return $this->render('produto/list.html.twig', [
            'products' => $products
            ]
        );
    }


     /**
     * @Route("/productos/criar", name="product_create")
     */
    public function createAction(Request $request)
    {

        $product = new Produto();

        $productForm = $this->get('form.factory')
            ->createNamed(
                '',
                'AppBundle\Form\Type\ProdutoSaveType',
                $product,
                array(
                    'action' => $this->generateUrl('product_create'),
                    'method' => 'POST'
                )
            );

        $productForm->handleRequest($request);
        
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = $productForm->getData();
            $em = $this->getDoctrine()->getManager();

            $product->setDataCadastro(new \DateTime());

            $em->persist($product);
            $em->flush();

            $this->addFlash(
                'success',
                'Produto salvo com sucesso!'
            );

            return $this->redirectToRoute('product_list', [
                'request' => $request
            ], 301);
        }

         return $this->render('produto/save.html.twig', [
            'form' => $productForm->createView()
            ]
        );

    }

    /**
     * @Route("/produtos/editar/{idProduto}", name="product_edit")
     */
    public function editAction(Produto $product, Request $request)
    {

        $productForm = $this->get('form.factory')
            ->createNamed(
                '',
                'AppBundle\Form\Type\ProdutoSaveType',
                $product,
                array(
                    'action' => $this->generateUrl('product_edit', array('idProduto' => $product->getIdProduto())),
                    'method' => 'POST'
                )
            ); 


        $productForm->handleRequest($request);       
        
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            
            $product = $productForm->getData();
            $em = $this->getDoctrine()->getManager();

            $em->merge($product);
            $em->flush();

            $this->addFlash(
                'success',
                'Categoria editada!'
            );

            return $this->redirectToRoute('product_list', [
                'request' => $request
            ], 301);
        }

        return $this->render('categoria/save.html.twig', [
            'form' => $productForm->createView(),
            ]
        );

    }

    /**
     * @Route("/produtos/deletar/{idProduto}", name="product_delete")
     * @Method("POST")
     */
    public function deleteAction(Produto $product, Request $request)
    {
      
        $response = array('isValid' => false);
        
        if (!is_null($product)) {
            
            $em = $this->getDoctrine()->getManager();

            $em->remove($product);
            $em->flush();

            $response['isValid'] = true;

        }


        return new JsonResponse($response);


    }

}