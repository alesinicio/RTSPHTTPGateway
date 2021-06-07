FROM alpine:3.13.1

RUN apk add php7 php7-json php7-posix
RUN apk add vlc jq && sed -i 's/geteuid/getppid/' /usr/bin/vlc
