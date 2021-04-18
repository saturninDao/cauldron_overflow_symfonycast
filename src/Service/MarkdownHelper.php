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
    private $markdownLogger;
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
                                LoggerInterface $appLogger,LoggerInterface $mdLogger)
    {
        $this->logger = $mdLogger;
       // $this->markdownLogger = $markdownLogger;
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
    }

    public function parse(string $source):string
    {
        /**/
        dump($this->isDebug);
        if (stripos($source, 'cat') !== false) {
            $this->logger->info('Meow!');
        }
        return $this->cache->get('markdown_'.md5($source),function() use ($source){

                return $this->markdownParser->transformMarkdown($source);

        });
        /**/

    }

}