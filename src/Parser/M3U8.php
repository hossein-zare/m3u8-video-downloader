<?php

namespace App\Parser;

class M3U8
{
    /**
     * The content of the file.
     * 
     * @var string
     */
    private string $content;

    /**
     * The extracted links.
     * 
     * @var array
     */
    private array $links = [];

    /**
     * Create a new instance.
     * 
     * @param  string  $name
     */
    public function __construct(public string $name)
    {
        $this->read()->extract();
    }

    /**
     * Read file into memory.
     * 
     * @return \App\Parser\M3U8
     */
    private function read(): M3U8
    {
        $this->content = @file_get_contents($this->name);

        if (empty($this->content))
            throw new \Exception("The m3u8 file doesn't exist.");

        return $this;
    }

    /**
     * Extract links.
     * 
     * @return \App\Parser\M3U8
     */
    private function extract(): M3U8
    {
        preg_match_all("/#EXTINF:.+\n(.+)/m", $this->content, $matches, PREG_SET_ORDER, 0);

        foreach ($matches as $match) {
            array_push($this->links, $match[1]);
        }

        if (count($matches) === 0)
            throw new \Exception("The m3u8 file is invalid.");

        return $this;
    }

    /**
     * Get links.
     * 
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }
}
