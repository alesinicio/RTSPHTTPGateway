<?php
use alesinicio\AsyncExecutor\AsyncExecutor;
use alesinicio\AsyncExecutor\AsyncMultiProcess;
use alesinicio\AsyncExecutor\AsyncProcess;

require __DIR__.'/vendor/autoload.php';

$cameras = file_get_contents(__DIR__.'/config/cameras.json');
$cameras = json_decode((string)$cameras, true, JSON_THROW_ON_ERROR);

$async = new AsyncExecutor('cvlc');
$multiAsync	= new AsyncMultiProcess($async);

$options = '--play-and-exit --sout="#transcode{vcodec=MJPG,venc=ffmpeg{strict=1},fps=10,width=640,height=360}:standard{access=http{mime=multipart/x-mixed-replace;boundary=--7b3cc56e5f51db803f790dad720ed50a},mux=mpjpeg,dst=:${PORT}/}"';
$i = 1;
foreach($cameras as $camera) {
	$option = str_replace('${PORT}', $camera['port'], $options);
	$multiAsync->addProcess(new AsyncProcess('camera_'.$i, '', [$camera['url'], $option]));
	$multiAsync->keepRunningProcesses();
}