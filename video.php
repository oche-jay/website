<!doctype html>
<html>
    <head>
        <title>Energy-Aware Adaptation Experiment</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <?php session_start();?>
        <link rel="stylesheet" type="text/css" href="video.css">
        <script src="dashjs/dist/dash.all.debug.js "></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <!-- <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
    </head>
    <body style="overflow: hidden;">
            <script>
          $(function() {
            $( document ).tooltip();
          });
        //   </script>
        
        <script>
        var videos = ["bunny", "tears", "spring", "fifa"]; //0a, 0b, 0c, 0d, 1a, 1b, 1c, 1d, 
        var profiles = ["high_only", "low_only", "aggressive", "conservative"]
        var next_profile;
        var next_video;
        var form_data;
        var rating;

        var current_video = "<?php 
            if (isset($_GET["video"])){
                echo  $_GET["video"];
            } 
            else {
                echo "bunny";
            } 
        ?>" ;
        var current_profile = "<?php 
            if (isset($_GET["profile"])){
                echo  $_GET["profile"];
            } 
            else {
                echo "high_only";
            } 
        ?>";

        var profile_index 
        var video_index 
        var json_summary = {};
        var unhappiness_events = [];
        var happiness_events = [];

        var session_id = "<?php echo session_id(); ?>";
        var DURATION = 60;
        if (current_video == 'tears')
            DURATION = 71;
        if (current_video == 'bunny')
            DURATION = 64;
        var url = "http://ogogoro.cs.st-andrews.ac.uk/html/videos/"+current_video+"_1min.mpd";
        var videoPlayer;
        var player;
        var dashMetrics;
        var levels;
        var max;
        var starttime;
        var timingInterval
        var unhappy = 0;
        var happy = 0;
        
        json_summary.session_id = session_id;
        json_summary.video_url = url;
        json_summary.adaptation_profile = current_profile;
        json_summary.unhappiness_events = unhappiness_events;
        json_summary.happiness_events = happiness_events;
    
        document.onkeydown = function(event) {
                    switch (event.keyCode) {
                        case 38: //KeyCode for A
                            console.log("[GreenDASH] Key Pressed: " +  event.keyCode);
                            document.querySelector('#overlay_1').innerHTML = "Happiness detected"; 
                            happy += 1;
                            var ctime = videoPlayer.currentTime;
                            // document.querySelector('#keypress_up').innerHTML = 'happy key pressed ' + happy + 'times';
                            happiness_events.push(ctime);
                            console.log(json_summary);
                            var overlay = document.getElementById('overlay_1');
                            var elm = overlay;
                            var newone = elm.cloneNode(true);
                            elm.parentNode.replaceChild(newone, elm);
                            overlay.style.visibility='hidden';  
                            break;

                        case 40: //KeyCode for L
                            console.log("[GreenDASH] Key Pressed: " +  event.keyCode);
                            document.querySelector('#overlay_1').innerHTML = "Unhappiness detected"; 
                            unhappy += 1;
                            var ctime = videoPlayer.currentTime;
                            // document.querySelector('#keypress_down').innerHTML = 'unhappy key pressed ' + unhappy + 'times  ';
                            unhappiness_events.push(ctime);
                            console.log(json_summary);
                            var overlay = document.getElementById('overlay_1');
                            var elm = overlay;
                            var newone = elm.cloneNode(true);
                            elm.parentNode.replaceChild(newone, elm);
                            overlay.style.visibility='hidden';  
                            break;

                        default:
                        console.log("[GreenDASH] Key pressed but doing nothing");
                         break;
                    } 
                    
                       
            };

        function updateStats(){
            player.setStableBufferTime(2)
            dashMetrics = player.getDashMetrics();
            var buff = "Buffer Lever: " + player.getBufferLength() + " s";
            var qual = "Current Video quality level: " + player.getQualityFor('video');
            levels = player.getBitrateInfoListFor('video');
            current_bw = levels[player.getQualityFor('video')].bitrate;
            console.log("[GreenDASH] " + buff);
            console.log("[GreenDASH] " + qual);
            console.log("[GreenDASH] Current Bitrate: " + current_bw);


            // document.querySelector('#stats').innerHTML = buff + "\n" + qual + "\n"; 
        
        }

        function counter(){
                    var now = videoPlayer.currentTime;
                    var elapsed =  now - starttime;
                    console.log("[GreenDASH] Video has played for: " + elapsed + " s");
                    if (elapsed >= DURATION){
                        console.log("[GreenDASH] PLAYBACK COMPLETED");
                        clearInterval(timingInterval);
                        var ov = document.getElementsByClassName('overlay2');
                        ov[0].style.visibility = "visible" ;    
                }     
            }

        function storeData(){
            console.log("[GreenDASH] STORING DATA!!!")
            // http://stackoverflow.com/questions/6418220/javascript-send-json-object-with-ajax
            //http://stackoverflow.com/questions/21024640/get-json-data-from-ajax-post-send
            var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
            xmlhttp.open("POST", "partid.php");
            form_data = new FormData();
            rating = document.querySelector('input[name="rating"]:checked').value;
            form_data.append('video', current_video);
            form_data.append('url', url);
            form_data.append('profile', current_profile);
            form_data.append('session_id', session_id);
            form_data.append('rating', rating );
            form_data.append('js', JSON.stringify(json_summary));
            form_data.append('happiness_events', happiness_events.join());
            form_data.append('unhappiness_events', unhappiness_events.join());
            xmlhttp.send(form_data);

        }

        function nextVideo(){
            storeData();
            var profile_index = profiles.indexOf(current_profile);
            var video_index = videos.indexOf(current_video);

            if (profile_index <= profiles.length - 2 ) //2nd to last index
            {
                next_profile = profiles[profile_index + 1];
                next_video = current_video;
                window.location.assign("video.php?video=" + next_video + "&profile=" + next_profile);
 
            } 
            else if (profile_index == profiles.length - 1) //last index
            {
                if (video_index < (videos.length - 1)){
                next_video = videos[video_index + 1];
                next_profile = profiles[0];
                window.location.assign("video.php?video=" + next_video + "&profile=" + next_profile);
                }
                else{
                    console.log('Experiment Over');
                    window.location.assign("evaluation.php");  
                }
            }
       
        }

    </script>
    <div class="main_body">
        <div>
            <video id="videoPlayer" controls> </video>
        </div>

        <div class='run-animation overlay' id='overlay_1'> Playback Started</div>
    

    <!-- Uncomment for Testing -->
      <!--   <div>
            <span id="stats"></span>
        </div>
          <div>
            <span id="keypress_up"></span>
            stats
        </div> 


        <div>
            <span id="keypress_down"></span>
            stats
        </div> -->

    <!-- Uncomment for Testing -->
       
        <script>
            (function(){
                var STRT_BITRATE = 10000000; //TODO: get this dynamically from .getBitrateInfoListFor('video');
                videoPlayer = document.querySelector("#videoPlayer");
                player = dashjs.MediaPlayer().create();
                player.initialize(videoPlayer, url, false);
                player.setInitialBitrateFor('video', STRT_BITRATE);
                player.setBufferTimeAtTopQuality(2);
                player.enableLastBitrateCaching(false);
                player.setAutoSwitchQualityFor('video', false);
                player.setAutoSwitchQualityFor('audio', false);
                player.setBufferToKeep(10);
                player.setStableBufferTime(10);
                setInterval(updateStats,1000);
                console.log("[GreenDASH] PLAYBACK STARTING");
                starttime = videoPlayer.currentTime;
                player.play();

        		switch (current_profile){
        		case "aggressive":
        		    console.log("[GreenDASH] AGGRESSIVE Adaptation");
                	setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 3)}, 10000);
                	setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') + 1)}, 20000);
               		setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 1)}, 30000); 
                	setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') + 1)}, 40000);
                    setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 1)}, 50000);
                break;
                case "conservative":
                console.log("[GreenDASH] CONSERVATIVE Adaptation");
                setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 1)}, 10000);
                setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 1)}, 20000);
                setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') + 1)}, 30000); 
                setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 1)}, 40000);
                setTimeout(function(){player.setQualityFor('video', player.getQualityFor('video') - 1)}, 50000);
                break;
                case "low_only":
                console.log("[GreenDASH] LOW_ONLY Adaptation");
                setTimeout(function(){player.setQualityFor('video', 0)}, 2000);
                break;
                case "high_only":
                default:
                player.setBufferTimeAtTopQuality(10);
                console.log("[GreenDASH] HIGH_ONLY Adaptation");
                // do nothing
                break
                }

                timingInterval = setInterval(counter,1000);

        })();

        </script>

        <div class='blocker'></div>
        <div class='blocker2'></div>
    


        <!-- <div class="box">
    <a class="button" href="#popup1">Let me Pop up</a>
</div> -->
        <div id="popup1" class="overlay2">
            <div class="popup">
                <h2>Rating </h2>
                <div class="content">
                    <p> Thank you. </p> 
                    <p> Based on quality, please give the video you just saw a score between 1 and 9 on the rating system below.</p>
                        <fieldset class="rating">
                            <legend>Please rate:</legend>
                            <input class="v_input"  type="radio" id="star9" name="rating" value="9"/><label class="v_label"  for="star9" title="9: Excellent!" required>9 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star8" name="rating" value="8"/><label class="v_label"  for="star8" title="8: Almost Excellent">8 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star7" name="rating" value="7"/><label class="v_label"  for="star7" title="7: Very Good">7 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star6" name="rating" value="6"/><label class="v_label"  for="star6" title="6: Good">6 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star5" name="rating" value="5"/><label class="v_label"  for="star5" title="5: Very Fair">5 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star4" name="rating" value="4"/><label class="v_label"  for="star4" title="4: Fair">4 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star3" name="rating" value="3"/><label class="v_label"  for="star3" title="3: Poor">3 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star2" name="rating" value="2"/><label class="v_label"  for="star2" title="2: Very Poor">2 stars</label class="v_label" >
                            <input class="v_input"  type="radio" id="star1" name="rating" value="1"/><label class="v_label"  for="star1" title="1: Extremely Poor, Unusable">1 star</label>
                        </fieldset>                          
                </div>
                <script>
                    $(document).ready(function() {
                           $('input[type="radio"]').click(function() {
                               if($(this).attr('name') == 'rating') {
                                    $('#show-me').show();  
                                    console.log("[GreenDASH] clicked")         
                               }
                               else {
                                    $('#show-me').hide();
                                    console.log("[GreenDASH] hidden")   
                               }
                           });
                        });
                </script>
                 <!--TODO: display this only when above radio has been checked -->
                 <div id='show-me' class="ting" style='display:none'> <a class="button" href="#" onclick=nextVideo();return false;>Go to next video</a></div>
            </div>
        </div>
    </div> 
    </body>
</html>
