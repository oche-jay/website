#!/bin/bash

input=$1
MP4Box -v -dash 2000 -rap -frag-rap -profile onDemand -out ${input}_test.mpd ${input}_360.mp4#video ${input}_480.mp4#video ${input}_720.mp4#video ${input}_1080.mp4#video ${input}_2160.mp4#video ${input}_audio.mp4#audio

