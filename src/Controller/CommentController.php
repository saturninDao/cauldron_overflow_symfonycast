<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     * @Route("comments/{id}/vote/{direction<up|down>}", methods="POST")
     */
    public function commentVote($id,$direction, LoggerInterface $logger){

        //todo use id to query database

        // use a real logic here to save this to the database
        if ($direction==='up'){
            $logger->info("voting up yeah!");
            $currentVoteCount = rand(7,100);
        }else{
            $logger->info("voting down yeah!");
            $currentVoteCount = rand(0, 5);
        }

        return $this->json(['votes'=> $currentVoteCount]);
    }
}