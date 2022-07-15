<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    
    
    
    /**
     * @Route("/task")
     */
    public function index(): Response
    {

        $tasks = ['zzzzz','aaaaa','cccc'];

        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            "tasks" => $tasks
        ]);
    }


    public function createTask(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $task = new Task();
        $task->setTitle('Keyboard');
        $task->setStatus(0);
        $task->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($task);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$task->getId());
    }
}
