<?php

namespace App;

use App\Fetch;

class Merge
{
    /**
     * The destination directory.
     * 
     * @var string
     */
    public static string $DESTINATION_DIRECTORY = "destination";

    /**
     * Create a new instance.
     * 
     * @param  \App\Fetch  $fetch
     * @param  string  $outputFileName
     */
    public function __construct(private Fetch $fetch, private string $outputFileName)
    {
        //
    }

    /**
     * Merge files.
     */
    public function merge()
    {
        $file = fopen(self::$DESTINATION_DIRECTORY . '/' . $this->outputFileName, 'a');
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
