<?php

namespace App;

use App\Parser\M3U8;

class Fetch
{
    /**
     * The file list.
     * 
     * @var array
     */
    private array $list = [];

    /**
     * Create a new instance.
     * 
     * @param  \App\Parser\M3U8  $parser
     */
    public function __construct(private M3U8 $parser)
    {
        $this->createFolder();
    }

    /**
     * Create a folder.
     */
    private function createFolder()
    {
        $path = $this->getFolderPath();

        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    /**
     * Download files.
     * 
     * @return \App\Fetch
     */
    public function download(): Fetch
    {
        foreach ($this->parser->getLinks() as $key => $link) {
            $data = file_get_contents($link);
            $file = $this->getDir($key);

            file_put_contents($file, $data);
            array_push($this->list, $key);
        }

        return $this;
    }

    /**
     * Get folder path.
     * 
     * @return string
     */
    public function getFolderPath(): string
    {
        return 'files/' . $this->parser->name;
    }

    /**
     * Get direction.
     * 
     * @param  string  $file
     * @return string
     */
    private function getDir(string $file): string
    {
        return $this->getFolderPath() . '/' . $file;
    }

    /**
     * Get list.
     */
    public function getList(): array
    {
        return $this->list;
    }
}
