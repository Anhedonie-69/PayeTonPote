<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\Campaign;
use App\Entity\Participant;
use App\Form\PaymentType;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/payment')]
final class PaymentController extends AbstractController
{
    #[Route('/new/{id}', name: 'app_payment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Campaign $campaign): Response
    {        
        $payment = new Payment();
        $participant = new Participant();

        $amount = $request->query->get('amount');
        if ($amount) {
            $payment->setAmount($amount);
        }
        $payment->setParticipant($participant);

        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $participant = $payment->getParticipant();
            $participant->setCampaign($campaign);

            $currentTotal = $campaign->getTotalCollected();
            $newTotal = $currentTotal + $payment->getAmount();
            
            if ($newTotal > $campaign->getGoal()) {
                $this->addFlash('error', 'Le montant dépasse l’objectif de la campagne.');
                return $this->redirectToRoute('app_payment_new', [
                    'id' => $campaign->getId()
                ]);
            }
            
            $entityManager->persist($payment);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payment/payment.html.twig', [
            'campaign' => $campaign,
            'payment' => $payment,
            'form' => $form,
        ]);
    }
}
