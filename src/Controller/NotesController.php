<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Notes;

class NotesController extends AbstractController
{
    /**
     * @Route(path="/notes/", name="notes", methods={"GET"})
     */
    public function getNotes(Request $request): JsonResponse
    {
        $page = $request->get('page');
        $limit = $request->get('limit');
        $em = $this->getDoctrine()->getManager()->createQueryBuilder();
        $notes_query = $em->select('e')->from('App\Entity\Notes', 'e')->andWhere('e.is_deleted = false');
        if($limit != '' && $page != '')
        {
            $offset = $limit*($page-1);
            $notes_query = $notes_query->setFirstResult($offset)->setMaxResults($limit);
        }
        $notes = $notes_query->getQuery()->getResult();
        foreach($notes as $note){
            $notesCollection[] = ["id" => $note->getId(), "title" => $note->getName(), "text" => $note->getDescription()]; 
        }
        return new JsonResponse(['data' => $notesCollection]);
    }


    /**
     * @Route(path="/create", name="create_notes", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $response = json_decode($request->getContent(), true);
        $note = new Notes();
        $note->setName($response['name']);
        $note->setDescription($response['description']);
        $note->setIsDeleted(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();
        return new JsonResponse(['data' => 'Note was successfully created']);
    }



    /**
     * @Route(path="/update/{number}", name="update_notes", methods={"POST"})
     */
    public function updateNote(int $number, Request $request): JsonResponse
    {
        if(!$number){
            $json_response = new JsonResponse(['data' => 'Number is not exist']);
            $json_response->setStatusCode(402);
            return $json_response;
        }
        $em = $this->getDoctrine()->getManager()->createQueryBuilder();
        $note_query = $em->select('e')->from('App\Entity\Notes', 'e')->andWhere('e.id = :number')
            ->setParameter(':number', $number)
            ->andWhere('e.is_deleted = false');
        $note = $note_query->getQuery()->getOneorNullResult();
        if(!$note){
            $json_response = new JsonResponse(['data' => 'Note is not exist']);
            $json_response->setStatusCode(404);
            return $json_response;
        }
        $response = json_decode($request->getContent(), true);
        $note->setName($response['name']);
        $note->setDescription($response['description']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();
        return new JsonResponse(['data' => 'Note was successfully updated']);
    }


    /**
     * @Route(path="/note/{number}", name="one_note", methods={"GET"})
     */
    public function get_note(int $number, Request $request): JsonResponse
    {
        if(!$number){
            $json_response = new JsonResponse(['data' => 'Number is not exist']);
            $json_response->setStatusCode(402);
            return $json_response;
        }
        $em = $this->getDoctrine()->getManager()->createQueryBuilder();
        $note_query = $em->select('e')->from('App\Entity\Notes', 'e')->andWhere('e.id = :id')
            ->setParameter(':id', $number)
            ->andWhere('e.is_deleted = false');
        $note = $note_query->getQuery()->getOneorNullResult();
        if(!$note){
            $json_response = new JsonResponse(['data' => 'Note is not exist']);
            $json_response->setStatusCode(404);
            return $json_response;
        }
        return new JsonResponse(['data' => ['name' => $note->getName(), 'description' => $note->getDescription()]]);
    }


    /**
     * @Route(path="/delete/{number}", name="delete_note", methods={"DELETE"})
     */
    public function delete(int $number, Request $request): JsonResponse
    {
        if(!$number){
            $json_response = new JsonResponse(['data' => 'Number is not exist']);
            $json_response->setStatusCode(402);
            return $json_response;
        }
        $em = $this->getDoctrine()->getManager()->createQueryBuilder();
        $note_query = $em->select('e')->from('App\Entity\Notes', 'e')->andWhere('e.id = :id')
            ->setParameter(':id', $number)
            ->andWhere('e.is_deleted = false');
        $note = $note_query->getQuery()->getOneorNullResult();
        if(!$note){
            $json_response = new JsonResponse(['data' => 'Note is not exist']);
            $json_response->setStatusCode(404);
            return $json_response;
        }
        $note->setIsDeleted(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();
        return new JsonResponse(['data' => 'Note was successfully deleted']);
    }


}
