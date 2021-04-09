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
     * @return $this
     */
    private function read()
    {
        $this->content = file_get_contents($this->name);

        return $this;
    }

    /**
     * Extract links.
     * 
     * @return $this
     */
    private function extract()
    {
        preg_match_all("/#EXTINF:.+\n(.+)/m", $this->content, $matches, PREG_SET_ORDER, 0);

        foreach ($matches as $match) {
            array_push($this->links, $match[1]);
        }

        return $this;
    }

    /**
     * Get links.
     * 
     * @return  array
     */
    public function getLinks()
    {
        return $this->links;
    }
}
