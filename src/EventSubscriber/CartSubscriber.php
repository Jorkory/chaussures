<?php

namespace App\EventSubscriber;

use App\Service\CartService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class CartSubscriber implements EventSubscriberInterface
{
    public function __construct(private CartService $cartService, private Environment  $twig)
    {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $count = $this->cartService->getCartItemsCount();
        $this->twig->addGlobal('cartItemsCount', $count);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
