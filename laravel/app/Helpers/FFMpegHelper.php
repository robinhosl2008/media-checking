<?php

namespace App\Helpers;

use FFMpeg\FFMpeg;

class FFMpegHelper
{
    public function __construct()
    {}

	public function buscarResolucao($file)
	{
		$ffmpeg = FFMpeg::create();
		$video = $ffmpeg->open($file);
		$stream = $video->getStreams()->all()[0];
		
		$arr = [
			'status' => true,
			'duracao' => $stream->get('duration'),
			'largura' => $stream->get('width'),
			'altura' => $stream->get('height'),
			'toString' => $stream->get('width') . 'x' . $stream->get('height'),
			'aspectRatio' => $stream->get('display_aspect_ratio')
		];

		return $arr;
	}
}