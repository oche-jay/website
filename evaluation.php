 <!DOCTYPE html>
<html>
<head>
<script>
<?php 
session_destroy();
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
<script type="text/javascript" src="script.js"></script>
<title>Energy Aware Adaptation Experiment</title>
</head>

<body>  
<div class="container">
    <div class="form_div" style="padding-top: 44px;"> 
        <form id="form" method="post" class="form-horizontal" action="connection2.php">
             <fieldset>
                <legend>Energy saving preferences 2</legend>
                <p>Having watched videos of varying quality, please choose the options which most closely match your attitude.<p/>
          
                  <div class="form-group">  
                        <label class="control-label col-sm-2" for="money-saving-attitude">How likely are you to choose a lower quality video to save <strong>money</strong> (e.g. on a monthly subscription)?</label>
                        
                            <select size="5" id="money_saving_attitude" name="money_saving_attitude" required class="col-sm-8" >
                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                <option value="1"> Very likely - I would always choose a lower quality video to save money.</option>
                                <option value="2"> Quite likely - I may consider choosing a lower quality video to save money.</option>
                                <option value="3"> Neutral - I am neutral either way.</option>
                                <option value="4"> Quite unlikely - I am unlikely to choose a lower quality video to save money. </option>
                                <option value="5"> Very unlikely - I would never choose a lower quality video to save money. </option>
                            </select>
                            
                        </div>
        

                     <div class="form-group">
                        <label class="control-label col-sm-2" for="video_energy_saving_attitude">  How likely are you to choose a lower quality video to save <strong>energy</strong>?</label>
                        
                            <select size="5" id="video_energy_saving_attitude" name="video_energy_saving_attitude" required class="col-sm-8" >
                                <!-- <option value="" style="visibility:hidden" selected>&nbsp;</option> -->
                                <option value="1"> Very likely - I would always choose a lower quality video to save energy.</option>
                                <option value="2"> Quite likely - I may consider choosing a lower quality video to save energy.</option>
                                <option value="3"> Neutral - I am neutral either way.</option>
                                <option value="4"> Quite unlikely - I am unlikely to choose a lower quality video to save energy.</option>
                                <option value="5"> Very unlikely - I would never choose a lower quality video to save energy. </option>
                            </select>    
                    </div>

                   
            <input type="submit" value="Finish Experiment" >
        </form>
    </div>
</div> <!--./page-header -->
    </div> <!-- /. rter-template -->
   </div><!-- /.container -->

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
