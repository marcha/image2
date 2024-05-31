<?php 

namespace marcha\Image2\Servers;

interface ServerInterface {

	public function isFromCache();

	public function getImageData();

	public function serve();

}
