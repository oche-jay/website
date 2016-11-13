<!DOCTYPE html>
<html>
<head>
<script>
<?php 
session_start();
?>
</script>
<!-- Bootstrap core CSS -->
    <link href="./bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="./bootstrap-3.3.6/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="./bootstrap-3.3.6/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->


    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="video.css" rel="stylesheet">

<!-- <link rel="stylesheet" type="text/css" href="style.css" media="screen" /> -->
<script type="text/javascript" src="script.js"></script>
<title>Energy Aware Adaptation Experiment</title>
</head>

<body>   

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Energy-Aware Video Quality Assessment</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ethics <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

        <div class="container">
            <div class="theme-showcase" role="main">
                <div class="page-header">

                 <!-- Main jumbotron for a primary marketing message or call to action -->
                  <div class="jumbotron">
                    <h1>Welcome</h1>

                    <p >Welcome to this video quality evaluation experiment.<br/> </p>
                        
                    <p> First, you will need to answer a short questionnaire to get some demographic
                        information from you, as well as your regular Internet video
                        viewing habits and energy saving preferences.</p>
                    
                    <p>Then, you will be asked to watch four versions of a set of 4 video sequences.
                        While watching each video sequence, every time you become  <em>unhappy</em> with the quality of 
                        the video, or you notice a degradation in video quality 
                       , please press the 'down' key on the keyboard.
                        Similarly, every time you notice an improvement in the video quality and
                        you become <em>happy / happier</em> with this quality, please press the 'up' key on the keyboard to
                        register this. 
                        You will then have to give each video an
                        overall score between 1 and 9.</p>

                    <p>The entire experiment should take no longer than 30 minutes. Thank you for your time.</p>
                    
                    
                  </div>
                    <div class="form_div"> 
                        <form id="form" method="post" class="form-horizontal" action="connection.php">
                            <fieldset>
                                <legend>Personal information</legend>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="age">Age:</label>
                                    <input type="number" name="age" id="age"  class="col-sm-2" required />
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="gender">Gender:</label>
                                    <select id="gender" name="gender" class="col-sm-2">
                                                <option value="N" selected>Prefer not to say</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                                <option value="O">Other</option>
                                    </select>
                                </div>
                                        
                                 <div class="form-group">  
                                        <p class="col-sm-offset-1">
                                            <b> Eye correction required (glasses, contact lenses etc.): </b>
                                        </p>

                                        <label class="control-label col-sm-offset-1 col-sm-1" for="c_yes">Yes
                                        <input type="radio" name="correction" id="c_yes" value="1" required />
                                        </label>

                                        <label class="control-label col-sm-1" for="c_no">No
                                        <input type="radio" name="correction" id="c_no" value="0" required />
                                        </label>

                                </div>

                                <div class="form-group">        
                                        <p class="col-sm-offset-1">
                                            <b> Eye correction worn: </b></p>
                                        <label class="control-label col-sm-offset-1 col-sm-1" for="w_yes">Yes
                                        <input type="radio" name="worn" id="w_yes" value="1" required />
                                        </label>

                                        <label class="control-label col-sm-1" for="w_no">No       
                                        <input type="radio" name="worn" id="w_no" value="0" required />
                                        </label>
                                </div>

                            </fieldset>

                            <fieldset>
                                <legend>Normal viewing properties </legend>
                                <p>Please specify the properties of the primary screen that you use most often for online entertainment (i.e. watching TV shows, movies, Youtube, Netflix etc.)</p>
                              
                                  <div class="form-group">  
                                        <label class="control-label col-sm-2" for="screen"> Type of screen:</label>
                                        
                                            <select size="6" id="screen" name="screen" onload="evalScreen();" onchange="evalScreen();" required class="col-sm-2" >
                                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                                <option value="phone">Phone</option>
                                                <option value="tablet">Tablet</option>
                                                <option value="laptop">Laptop</option>
                                                <option value="desktop">Desktop monitor</option>
                                                <option value="tv">Flatscreen TV</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <span id="screen_other" style="visibility: hidden">Please specify: 
                                                <input type="text" name="other_specify" id="screen_otherx" value="" />
                                            </span>
                                        
                                    
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="screen_size"> Size of screen:</label>
                                        
                                            <input type="range" id="screen_size" style="width: 60%" name="screen_size" value="0" min="0" max="70" oninput="screen_size_label.value = changeSize(this)"/>
                                            <output class="col-sm-2" name="screen_size_label" for="screen_size">0" (0 cm)</output>
                                     </div>

                                     <div class="form-group">
                                        <label class="control-label col-sm-2" for="screen_res"> Resolution:</label>
                                        
                                            <select size="27" class="col-sm-4" id="screen_res"  name="screen_res" required>
                                                <option value="" style="visibility:hidden" selected>&nbsp;</option>
                                                <option value="unknown">I don't know</option>
                                                <option value="240p">320x240 (XGA)</option>
                                                <option value="320p">480x320 (iPhone)</option>
                                                <option value="360p">640x360 (360p)</option>
                                                <option value="ntsc">640x400 (NTSC)</option>
                                                <option value="vga">640x480 (VGA)</option>
                                                <option value="pal">720x576 (PAL)</option>
                                                <option value="svga">800x600 (SVGA)</option>
                                                <option value="iphone4">960x640 (iPhone 4S)</option>
                                                <option value="qvga">1024x768 (QVGA)</option>
                                                <option value="iphone5">1136x640 (iPhone 5 Retina)</option>
                                                <option value="720p">1280x720 (720p HD)</option>
                                                <option value="wxga">1280x800 (WXGA)</option>
                                                <option value="sxga">1280x1024 (SXGA)</option>
                                                <option value="iphone6">1334x750 (iPhone 6)</option>
                                                <option value="hdready">1366x768 (HD Ready)</option>
                                                <option value="wsxga">1440x900 (WSXGA)</option>
                                                <option value="900p">1600x900 (HD+)</option>
                                                <option value="uxga">1600x1200 (UXGA)</option>
                                                <option value="hd">1920x1080 (1080p Full HD)</option>
                                                <option value="wuxga">1920x1200 (WUXGA)</option>
                                                <option value="1440p">2560x1440 (1440p iMac Retina)</option>
                                                <option value="ipadpro">2732x2048 (iPad Pro)</option>
                                                <option value="macbookpro">2880x1800 (MacBook Pro Retina)</option>
                                                <option value="surface">3000x2000 (Microsoft Surface Book)</option>
                                                <option value="uhd">3840x2160 (2160p 4K UHD)</option>
                                                <option value="5k">5120x2880 (5K Retina)</option>
                                            </select>
                                            (Pick the one that is closest)
                                        
                                    </div>
                                      <div class="form-group">
                                    
                                        <label class="control-label col-sm-2" for="screen_hours">How many hours a week do you spend using this screen?</label>
                                            <select size="5" class="col-sm-4"  id="screen_hours" name="screen_hours" required>
                                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                                <option value="5">less than 7 hours </option>
                                                <option value="10"> between 7 and 13 hours </option>
                                                <option value="20"> between 14 and 27 hours </option>
                                                <option value="30"> between 28 and 35 hours </option>
                                                <option value="40"> more than 35 hours </option>
                                            </select>
                                            (Note: This is the amount of time spent using this screen/device for ALL purposes during the week)
                                        
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label col-sm-2" for="screen_usage"> Usage ratio:</label>
                                            <select size="5" class="col-sm-4"  id="screen_usage" name="screen_usage" required>
                                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                                <option value="20">&lt;20%</option>
                                                <option value="40">20-40%</option>
                                                <option value="60">40-60%</option>
                                                <option value="80">60-80%</option>
                                                <option value="100">&gt;80%</option>
                                            </select>
                                            (Note: This is the percentage of total time you spend using this device for entertainment purposes to the total number of hours of usage for ALL purposes)
                                        
                                    </div>
                                
                            </fieldset>
<br>
<br>
                             <fieldset>
                                <legend>Energy saving preferences</legend>
                                <p>Please choose the options which most closely match your attitude.<p/>
                          
                                  <div class="form-group">  
                                    
                                        <p> <strong> What is your general attitude towards saving energy</strong> </p>


                                        <!-- <label class="control-label col-sm-2" for="energy-saving-attitude">What is your general attitude towards saving energy?</label> -->
                                        
                                            <select size="5" id="energy_saving_attitude" name="energy_saving_attitude" required class="col-sm-12" >
                                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                                <option value="1"> Very positive - I actively try to save energy almost all the time and believe I can make a difference.</option>
                                                <option value="2"> Slightly positive - I occasionally try to save energy but it is not part of my daily practices.</option>
                                                <option value="3"> Neutral - I do not often try to save energy but I am concious of energy usage in general</option>
                                                <option value="4"> Slightly negative - I do not try to save energy as I am not concious of energy usage </option>
                                                <option value="5"> Very negative - I never try to save energy and I use as much energy as I can. </option>
                                            </select>
                            
                                        </div>
                        

                                     <div class="form-group">
                                        <p> <strong>How aware of you of the environmental impact of energy use? </strong> </p>
                                        <!-- <label class="control-label col-sm-2" for="environmental-impact"> How aware of you of the environmental impact of energy use?</label> -->
                                        
                                            <select size="5" id="environmental_impact" name="environmental_impact" required class="col-sm-12" >
                                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                                <option value="1"> Very aware - I am very aware and often do my own research and keep abreast of developments.</option>
                                                <option value="2"> Slightly aware - I am quite aware of the situation and interested in it to a good extent</option>
                                                <option value="3"> Neutral - I am aware of the current debate but not convinced that energy usage has an impact on the environment</option>
                                                <option value="4"> Unaware - I am not aware that energy usage has an impact on the environment </option>
                                                <option value="5"> Cynical - I do not care about the impact of energy usage on the environment</option>
                                            </select>
                                    </div>

                                    <label> Which of these ideas currently, or could potentially motivate you to save energy, and to
                                        what extent? <br/> </label>    
                                    
                                     <div class="form-group">
                            
                                            <label class="col-sm-1 col-sm-offset-2">Never</label>
                                            <label class="col-sm-1">Rarely</label>
                                            <label class="col-sm-1">Ocassionally</label>
                                            <label class="col-sm-1">Often</label>
                                            <label class="col-sm-1">Always</label>
                                    </div>

                                    <div class="form-group">
                                            <label  class="control-label col-sm-2">Keeping energy costs down</label>
                                            <label class="col-sm-1"> <input type="radio" name="keep_costs_down" class="radio-inline" value="1" required></label>
                                            <label class="col-sm-1"> <input type="radio" name="keep_costs_down" class="radio-inline" value="2"></label>
                                            <label class="col-sm-1"> <input type="radio" name="keep_costs_down" class="radio-inline" value="3"></label>
                                            <label class="col-sm-1"> <input type="radio" name="keep_costs_down" class="radio-inline" value="4"></label>
                                            <label class="col-sm-1"> <input type="radio" name="keep_costs_down" class="radio-inline" value="5"></label>
                                    </div>

                                    <div class="form-group">
                                         <label class="control-label col-sm-2"> Protecting the environment</label>
                                         <label class="col-sm-1"><input type="radio" name="protect_environment" class="radio-inline" value="1" required></label>
                                         <label class="col-sm-1"><input type="radio" name="protect_environment" class="radio-inline" value="2"></label>
                                         <label class="col-sm-1"><input type="radio" name="protect_environment" class="radio-inline" value="3"></label>
                                         <label class="col-sm-1"><input type="radio" name="protect_environment" class="radio-inline" value="4"></label>
                                         <label class="col-sm-1"><input type="radio" name="protect_environment" class="radio-inline" value="5"></label>
                                    </div>


                                    <div class="form-group">

                                         <label  class="control-label col-sm-2"> Not being wasteful </label>
                                            <label class="col-sm-1"> <input type="radio" name="not_wasteful" class="radio-inline" value="1" required></label>
                                            <label class="col-sm-1"> <input type="radio" name="not_wasteful" class="radio-inline" value="2"></label>
                                            <label class="col-sm-1"> <input type="radio" name="not_wasteful" class="radio-inline" value="3"></label>
                                            <label class="col-sm-1"> <input type="radio" name="not_wasteful" class="radio-inline" value="4"></label>
                                            <label class="col-sm-1"> <input type="radio" name="not_wasteful" class="radio-inline" value="5"></label>
                                     </div>

                                   <div class="form-group">
                                         <label  class="control-label col-sm-2"> Following instructions (rules, policies etc.) e.g. at school, office or residence.</label>
                                            <label class="col-sm-1"> <input type="radio" name="following_rules" class="radio-inline" value="1" required></label>
                                            <label class="col-sm-1"> <input type="radio" name="following_rules" class="radio-inline" value="2"></label>
                                            <label class="col-sm-1"> <input type="radio" name="following_rules" class="radio-inline" value="3"></label>
                                            <label class="col-sm-1"> <input type="radio" name="following_rules" class="radio-inline" value="4"></label>
                                            <label class="col-sm-1"> <input type="radio" name="following_rules" class="radio-inline" value="5"></label>
                                    </div>

                                    <div class="form-group">
                                         <label  class="control-label col-sm-2"> Motivating and encouraging others by setting a good example</label>
                                            <label class="col-sm-1"> <input type="radio" name="motivating_others" class="radio-inline" value="1" required></label>
                                            <label class="col-sm-1"> <input type="radio" name="motivating_others" class="radio-inline" value="2"></label>
                                            <label class="col-sm-1"> <input type="radio" name="motivating_others" class="radio-inline" value="3"></label>
                                            <label class="col-sm-1"> <input type="radio" name="motivating_others" class="radio-inline" value="4"></label>
                                            <label class="col-sm-1"> <input type="radio" name="motivating_others" class="radio-inline" value="5"></label>
                                    </div>

                                    <div class="form-group">
                                         <label  class="control-label col-sm-2"> Impressing others</label>
                                            <label class="col-sm-1"><input type="radio" name="impressing_others" class="radio-inline" value="1" required></label>
                                            <label class="col-sm-1"><input type="radio" name="impressing_others" class="radio-inline" value="2"></label>
                                            <label class="col-sm-1"><input type="radio" name="impressing_others" class="radio-inline" value="3"></label>
                                            <label class="col-sm-1"><input type="radio" name="impressing_others" class="radio-inline" value="4"></label>
                                            <label class="col-sm-1"><input type="radio" name="impressing_others" class="radio-inline" value="5"></label>
                                    </div>

                                    <div class="form-group">
                                         <label  class="control-label col-sm-2"> Other (please give details below)</label>
                                            <label class="col-sm-1"><input type="radio" name="energy_motivation7" class="radio-inline" value="1" checked required></label>
                                            <label class="col-sm-1"><input type="radio" name="energy_motivation7" class="radio-inline" value="2"></label>
                                            <label class="col-sm-1"><input type="radio" name="energy_motivation7" class="radio-inline" value="3"></label>
                                            <label class="col-sm-1"><input type="radio" name="energy_motivation7" class="radio-inline" value="4"></label>
                                            <label class="col-sm-1"><input type="radio" name="energy_motivation7" class="radio-inline" value="5"></label>
                                    </div>
                                    <input type="text" class="col-sm-4 col-sm-offset-2" name="energy_motivation7_detail">
                            </fieldset>
                            <br/>
                            <input type="submit" value="Progress to first video >" >
                        </form>
                    </div>
                </div> <!--./page-header -->
    </div> <!-- /. rter-template -->
   </div><!-- /.container -->n
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./bootstrap-3.3.6/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <script src="./bootstrap-3.3.6/docs/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./bootstrap-3.3.6/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>
