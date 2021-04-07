<?php


namespace App\Controller;


use App\Service\MarkdownHelper;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;


class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(){

        return $this->render('homepage.html.twig');

    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @param $slug
     * @param MarkdownParserInterface $markdownParser
     * @param CacheInterface $cache
     * @return Response
     */
    public function show($slug, MarkdownHelper $markdownHelper){

        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";

        $parsedQuestionText = $markdownHelper->parse($questionText);

        $answers = [
            'Make sure your cat is sitting percfectly',
            'Honestly, I like furry shoes better than MY cat',
            "Maybe... try saying the spell backwards ?",
        ];

        return $this->render('/question/show.html.twig',[
            'question' => ucwords(str_replace('-',' ',$slug)),
            'answers' => $answers,
            'questionText' => $questionText
            ]);
    }

}