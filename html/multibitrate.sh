#/bin/bash
input=$1; 

for size in 360 720 1080 2160; 
do 
echo "ffmpeg -y -i $input -c:a libfdk_aac -ac 2 -ab 128k -c:v libx264 -x264opts 'keyint=24:min-keyint=24:no-scenecut' -vf "scale=-1:$size" ${input%_4k*}_$size.mp4;" 
ffmpeg -y -i $input -c:a libfdk_aac -ac 2 -ab 128k -c:v libx264 -x264opts 'keyint=24:min-keyint=24:no-scenecut' -vf "scale=-1:$size" ${input%_4k*}_$size.mp4; 


done;
