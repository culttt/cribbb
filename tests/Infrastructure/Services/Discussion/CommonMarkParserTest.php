<?php namespace Cribbb\Tests\Infrastructure\Services\Discussion;

use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use Cribbb\Infrastructure\Services\Discussion\CommonMarkParser;
use Cribbb\Infrastructure\Services\Discussion\CommonMarkExtensions\MentionParser;

class CommonMarkParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var Parser */
    private $service;

    public function setUp()
    {
        $environment   = Environment::createCommonMarkEnvironment();
        $environment->addInlineParser(new MentionParser());
        $parser        = new DocParser($environment);
        $renderer      = new HtmlRenderer($environment);
        $this->service = new CommonMarkParser($environment, $parser, $renderer);
    }

    /** @test */
    public function should_render_markdown_as_html()
    {
        $text = $this->service->render('Cribbb is **awesome**');

        $this->assertEquals('<p>Cribbb is <strong>awesome</strong></p>', rtrim($text));
    }

    /** @test */
    public function should_render_mention()
    {
        $text = $this->service->render('You should follow @philipbrown!');

        $this->assertEquals(
            '<p>You should follow <a href="https://cribbb.com/philipbrown">@philipbrown</a>!</p>',
            rtrim($text));
    }

    /** @test */
    public function should_extract_users()
    {
        $users = $this->service->users('You should follow @philipbrown and @jack');

        $this->assertEquals(['philipbrown', 'jack'], $users);
    }
}
