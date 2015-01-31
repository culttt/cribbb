<?php namespace Cribbb\Infrastructure\Services\Discussion;

use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Cribbb\Domain\Services\Discussion\Parser;

class CommonMarkParser implements Parser
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var DocParser
     */
    private $parser;

    /**
     * @var HtmlRenderer
     */
    private $renderer;

    /**
     * Create a new CommonMarkParser
     *
     * @param Environment $environment
     * @param DocParser $parser
     * @param HtmlRenderer $renderer
     * @return void
     */
    public function __construct(Environment $environment, DocParser $parser, HtmlRenderer $renderer)
    {
        $this->environment = $environment;
        $this->parser      = $parser;
        $this->renderer    = $renderer;
    }

    /**
     * Render a string of text
     *
     * @param string $text
     * @return string
     */
    public function render($string)
    {
        $document = $this->parser->parse($string);

        return $this->renderer->renderBlock($document);
    }

    /**
     * Extract the users from the text
     *
     * @param string $text
     * @return array
     */
    public function users($string)
    {
        $pattern = '/(^|[^a-z0-9_])[@＠]([a-z0-9_]{1,20})([@＠\xC0-\xD6\xD8-\xF6\xF8-\xFF]?)/iu';

        preg_match_all($pattern, $string, $result);

        return $result[2];
    }
}
