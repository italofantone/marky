<?php

namespace Italofantone\Marky\Services;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;

class MarkyService
{
    protected MarkdownConverter $converter;

    public function __construct()
    {
        $config = config('marky');

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new HeadingPermalinkExtension());
        $environment->addExtension(new TableOfContentsExtension());

        $this->converter = new MarkdownConverter($environment);
    }    
    
    public function render(string $markdown): string
    {        
        return $this->convert($markdown)->getContent();
    }

    protected function convert(string $markdown): RenderedContentInterface
    {
        return $this->converter->convert($markdown);
    }
}