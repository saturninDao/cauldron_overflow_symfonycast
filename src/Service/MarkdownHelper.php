<?php


namespace App\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownHelper
{
    private $markdownParser;
    private $cache;

    /**
     * MarkdownHelper constructor.
     * @param $markdownParser
     * @param $cache
     */
    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse(string $source):string
    {
        $parsedQuestionText = $this->cache->get('markdown_'.md5($source),function() use ($source){
            return $this->markdownParser->transformMarkdown($source);
        });
    }

}