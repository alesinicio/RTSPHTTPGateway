# RTSP/HTTP Gateway

Simple docker-based gateway to convert RTSP streams to HTTP streams.

Uses `cvlc` as a backend process to convert multiple (configurable) RTSP stream into HTTP streams. A simple PHP script is used to run a `cvlc` process for each stream and keep it running/restart it as needed.

The default settings force the output to a specific format, but should be easy to change if needed.

This project was built to solve a specific _"I need to use my RTSP camera in a browser"_ problem, so its scope is fairly limited. But, feel free to fork/contribute!

## Installation

1. Clone the repository
2. Configure the `cameras.json` and `.env` files
3. Start the container with `docker-compose up -d`

## Usage

There are two things to be configured: the RTSP streams and the port-binding.

The RTSP stream configuration is done by creating a `/config/cameras.json` file (sample provided). This JSON file contains an array of streams, and each object contains the internal container port on which the HTTP stream will be created (must be unique for each stream) and the RTSP address (stream must be acessible on this address without any interaction needed).

The port-binding is configured by creating a `.env` file (sample provided). Usually you will set the internal ports configured on the `cameras.json` file to be publically accessible, but you can map otherwise if needed.

When the container starts, all streams will be initialized. If any stream fails (either or startup or during execution), it will be automatically restarted in a few seconds.

## Advanced

No advanced configuration is present at the moment, but if you are up to it:

`app/entrypoint.php` contains an `$options` variable that represent the startup params of the `cvlc` process. It is forcing the output to a specific format/codec. Should be easy to update if necessary.

## FAQ

#### How many streams can I create?

It really depends on what piece of hardware you are using. Video transcoding put a heavy load on CPU, so you should really try and see. The larger the input video, the more CPU will be used. The higher the output framerate/quality, the higher the CPU load will be.

Tests done running ~10 camera streams on low quality in a dedicated Raspberry Pi3 showed about 50% CPU usage on average (fluctuates a lot).

#### Can the HTTP stream be password-protected?

Yes (although I never tested it personally). You will need to manually update the `entrypoint.php` file to add some options to the `$option` variable:

`--sout-http-user=<string> --sout-http-pwd=<string>`

There is no support for doing this in a "nice" way at the moment, nor is there support for setting different user/pass for different streams (I didn't need this at the time). If you really need it, raise an issue or... even better... contribute :smile:
