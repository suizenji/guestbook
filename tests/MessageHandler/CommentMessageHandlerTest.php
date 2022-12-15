<?php

namespace App\Tests\MessageHandler;

use App\Message\CommentMessage;
use App\MessageHandler\CommentMessageHandler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentMessageHandlerTest extends KernelTestCase
{
    // TODO record a test data
    public function testSendingEmail(): void
    {
        $container = static::getContainer();
        $handler = $container->get(CommentMessageHandler::class);
        $message = new CommentMessage(1);
        $handler($message);
    }
}
