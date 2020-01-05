<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\Type\PostType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoListController extends AbstractController
{
    public function index()
    {

        $todos = $this -> getDoctrine() -> getRepository(Todo::class) -> findBy(['deleted' => 0]);

        if (!$todos) {
            $this->addFlash(
                'notice',
                'Please add a todo!'
            );
            return $this -> redirectToRoute('new');
        }

        return $this->render('todo_list/index.html.twig', [
            'todos' => $todos
        ]);
    }

    public function new(Request $request)
    {
        $todo = new Todo();

        $form = $this->createForm(PostType::class, $todo);

        $form->handleRequest($request);

        if($form -> isSubmitted() && $form->isValid()) {
            $todo = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('todo_list/add.html.twig', [
            'form' => $form -> createView()
        ]);
    }

    public function edit(Request $request, $id)
    {

        $todo = $this -> getDoctrine() -> getRepository(Todo::class) -> findOneBy(['id' => $id]);

        if (!$todo) {
            $this->addFlash(
                'notice',
                'Sorry, Todo not found!'
            );
            return $this -> redirectToRoute('new');
        }

        $form = $this->createForm(PostType::class, $todo);

        $form->handleRequest($request);

        if($form -> isSubmitted() && $form->isValid()) {
            $todo = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('todo_list/edit.html.twig', [
            'form' => $form -> createView(),
            'todo' => $todo
        ]);
    }

    public function delete($id)
    {
        $todo = $this -> getDoctrine() -> getRepository(Todo::class) -> findOneBy(['id' => $id]);
        $todo -> setDeleted(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($todo);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Todo Removed'
        );

        return $this -> redirectToRoute('index');

    }

    public function sendReminders(MailerInterface $mailer) {
        $todos = $this -> getDoctrine() -> getRepository(Todo::class) -> findAll();
        foreach($todos as $todo) {
            // now send reminders out to users
            $email = (new Email())
                ->from('site@test.com')
                ->to('daniel.lambert15@gmail.com')
                ->subject('Outstanding todo list')
                ->html('<p>You have an outstanding todo list item to complete</p>');
            $sentEmail = $mailer->send($email);
            var_dump($sentEmail -> getMessageId());
        }
        die();
        return $this -> redirectToRoute('sendReminders');
    }
}
