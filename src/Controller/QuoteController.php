<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Form\QuoteLineItemType;
use App\Form\QuoteType;
use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Route("/quote")
 */
class QuoteController extends AbstractController
{
    /**
     * @Route("/", name="quote_index", methods={"GET"})
     */
    public function index(QuoteRepository $quoteRepository): Response
    {
        return $this->render('quote/index.html.twig', [
            'quotes' => $quoteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="quote_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quote = new Quote();
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quote);
            $entityManager->flush();

            return $this->redirectToRoute('quote_index');
        }

        return $this->render('quote/new.html.twig', [
            'quote' => $quote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quote_show", methods={"GET"})
     */
    public function show(Quote $quote): Response
    {
        return $this->render('quote/show.html.twig', [
            'quote' => $quote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quote_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quote $quote): Response {

        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(QuoteType::class, $quote);
        $quoteLineItemForm = $this->createForm(QuoteLineItemType::class);

        if ($request->getMethod() === 'POST' ) {

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                foreach ($quote->getQuoteLineItems() as $quoteLineItem) {
                    $quoteLineItem->setQuote($quote);
                }

                $entityManager->persist($quote);
                $entityManager->flush();

                $this->addFlash('success', 'Quoted saved');

                return $this->redirectToRoute('quote_index', array(
                    'id' => $quote->getId()
                ));
            }
        }

        return $this->render('quote/edit.html.twig', [
            'quote' => $quote,
            'form' => $form->createView(),
            'quoteLineItemForm' => $quoteLineItemForm->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="quote_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quote $quote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quote_index');
    }
}
