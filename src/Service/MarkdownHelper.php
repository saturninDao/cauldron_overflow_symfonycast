<?php


namespace App\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    private $markdownParser;
    private $cache;
    private $isDebug;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MarkdownHelper constructor.
     * @param MarkdownParserInterface $markdownParser
     * @param CacheInterface $cache
     * @param bool $isDebug
     * @param LoggerInterface $appLogger
     */
    public function __construct(MarkdownParserInterface $markdownParser,
                                CacheInterface $cache,
                                bool $isDebug,
                                LoggerInterface $appLogger)
    {
        $this->logger = $appLogger;
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
    }

    public function parse(string $source):string
    {
        dump($this->isDebug);
        return $this->cache->get('markdown_'.md5($source),function() use ($source){

                return $this->markdownParser->transformMarkdown($source);

        });
    }

}