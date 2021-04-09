<?php

namespace App;

use App\Fetch;

class Merge
{
    /**
     * Create a new instance.
     * 
     * @param  \App\Fetch  $fetch
     * @param  string  $outputName
     */
    public function __construct(private Fetch $fetch, private string $outputName)
    {
        //
    }

    /**
     * Merge files.
     */
    public function merge()
    {
        $file = fopen('output/' . $this->outputName, 'a');
        $list = $this->fetch->getList();
        $path = $this->fetch->getFolderPath();

        foreach ($list as $item) {
            $itemPath = $path . '/' . $item;
            
            fwrite($file, file_get_contents($itemPath));
            unlink($itemPath);
        }

        fclose($file);
    }
}
