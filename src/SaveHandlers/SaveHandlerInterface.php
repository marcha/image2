<?php 

namespace marcha\Image2\SaveHandlers;

use marcha\Image2\Image;
use marcha\Image2\Providers\ProviderInterface;

interface SaveHandlerInterface {

    public function getPublicPath();

    public function exists($filename);

    public function save($filename, array $data);

    public function getSrcPath();

    public function setPaths($imgPath, $publicPath);

    public function getSize($filename);
}
