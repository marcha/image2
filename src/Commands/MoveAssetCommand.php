<?php

namespace Marcha\Image2\Commands;

use Illuminate\Console\Command;

class MoveAssetCommand extends Command
{
    public $signature = 'marcha:image:moveasset';

    public $description = 'Move required assets to public path';

    public function handle(): int
    {
        $jsFile = Config::get('image::js_path');
		$oldPath = base_path() . '/vendor/imagecow/imagecow/Imagecow/Imagecow.js';
		$newPath = base_path() . $jsFile;
		$this->info('Moving ' . $oldPath . ' to ' . $newPath);

		if(!copy($oldPath, $newPath)) {
			$this->error('Unable to move file, please move it manually.');
		}
        
        $this->comment('All done');

        return self::SUCCESS;
    }
}
