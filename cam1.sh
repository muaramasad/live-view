#!/bin/sh
today=`/bin/date '+%d-%m-%Y__%H-%M-%S'`;
i=1;
begin=$(date +%s)
echo "Starting Stopwatch... Press q to exit"
while true; do
   now=$(date +%s)
      diff=$(($now - $begin))
         mins=$(($diff / 60))
	    secs=$(($diff % 60))
	       hours=$(($diff / 3600))
	          days=$(($diff / 86400))

		     # \r  is a "carriage return" - returns cursor to start of line
		        # with \33[2K we clear the current line
			   printf "\33[2K\r%3d Days, %02d:%02d:%02d" $days $hours $mins $secs


#Grab snapshot from RTSP-stream
D:/JAPFA/laragonginx/ffmpg/bin/ffmpeg -rtsp_transport tcp -i rtsp://admin:FIW170845@10.21.113.112:554/stream=0.sdp -vf scale=844:480 -r 1/1 -t 120 D:/JAPFA/laragonginx/www/cctv/public/video/0/ip-%01d.jpeg

#Delete previous taken snapshots older than 7 days
find D:/JAPFA/laragonginx/www/cctv/public/video/0/ -name '*.jpeg' -mmin +1 -delete

i=$(($i+1))


# -n 1 to get one character at a time, -t 0.1 to set a timeout 
   read -n 1 -t 0.1 input                  # so read doesn't hang
      if [[ $input = "q" ]] || [[ $input = "Q" ]] 
         then
	       echo # to get a newline after quitting
	             break
		        fi
			done
