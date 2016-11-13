const MAX_NUM = 7
var typelist = ["aab", "aba", "baa", "abb", "bab", "bba"];
var correct = [3, 2, 1, 1, 2, 3];
var order = parseInt(get("order"));
var num = 0;
var vid = parseInt(get("vid"));
var trial = parseInt(get("try"));
var partid = parseInt(get("partid"));
var dist = parseInt(get("dist"));

// Sends the general questionnaire results to the database.
function submitPersonal(form){
    if (validate()) {
        // Get participant id from php file.
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "partid.php?newid", false);
        xhr.setRequestHeader("Content-type", "text/html");
        xhr.setRequestHeader("Content-length", 0);
        xhr.send();

        // Build request parameters for thpe database writer php file (This includes
        // the answers from the participant and the participant id (anonymous questions)
        partid = xhr.responseText;
        
        var params = 'age=' + document.getElementById('age').value + '&';
        params += 'gender=' + document.getElementById('gender').value + '&';
        
        var corr = document.getElementsByName('correction');
        params += 'corr=';
        if (corr[0].checked || corr[1].checked)
            params += (corr[0].checked ? 'yes' : 'no') + '&';
        else
            params += 'na&';
        var worn = document.getElementsByName('worn');
        params += 'worn=';
        if (worn[0].checked || corr[1].checked)
            params += (worn[0].checked ? 'yes' : 'no') + '&';
        else
            params += 'na&';
        
        var screen = document.getElementById("screen").value;
        if (screen == "other") {
            screen = document.getElementById("other_specify").value;
        }
        params += 'sc_type=' + screen + '&';
        var screen_size = document.getElementById("screen_size").value;
        params += 'sc_size=' + screen_size + '&';
        var screen_res = document.getElementById("screen_res").value;
        params += 'sc_res=' + screen_res + '&';
        var screen_used = document.getElementById("screen_used").value;
        params += 'sc_used=' + screen_used;
        
        dist = 'q';
        post(params);
        vid = 0;
        trial = 0;
        dist = 1;
        nextVideo();
    } else
        alert("All fields marked by an asterisk have to be filled in");
    return false;
}

function validate() {
    var corr = document.getElementsByName('correction');
    if (!(corr[0].checked || corr[1].checked))
        return false;
    var worn = document.getElementsByName('worn');
    if (!(worn[0].checked || worn[1].checked))
        return false;
    if (document.getElementById("screen").value == "na")
        return false;
    if (document.getElementById("screen_size").value == "0")
        return false;
    if (document.getElementById("screen_res").value == "na")
        return false;
    if (document.getElementById("screen_used").value == "na")
        return false;
    return true;
}


// Decide on the video order and redirect the user to the playback.
function nextVideo() {
    if (vid >= MAX_NUM) {
        if (trial == 1 && dist == 3) {
            window.location.replace("goodbye.html");
            return false;
        } else if (trial == 1 && dist == 1) {
            window.location.replace("distance.html?partid=" + partid + "&dist=" + dist);
        } else {
            window.location.replace("repeat.html?partid=" + partid + "&dist=" + dist);
            return false;
        }
    } else {
        order = Math.floor((Math.random() * 3)) + (trial * 3);
        window.location.replace("tester.html?partid=" + partid + "&dist=" + dist + "&vid=" + (vid+1) + "&order=" + order + "&try=" + trial);
    }
}

// Play the other version of the video (4k if 2k was first, and 2k otherwise).
function playVid() {
    var video = document.getElementById('video2');
    if (video.children.length == 0) {
        vidtype = (typelist[order].charAt(num) == "a")? "4k" : "2k";
        var loc = "./videos/" + vidtype + "/" + vid + ".mp4";
        var video = document.getElementById('video2');
        
        var source = document.createElement('source');
        source.setAttribute('src', loc);
        video.appendChild(source);
        video.load();
    }
    var body = document.getElementsByTagName('body')[0];
    body.setAttribute('style', "margin:0;");
    var but = document.getElementById("button");
    document.body.style.cursor = 'none';
    
    but.style.visibility = "hidden";
    document.getElementById("overlay").innerHTML = vid +"/"+(num+1);
    video.style.visibility = "visible";

    video.play();
    return false;
}

// Replace first video with button.
function nextButton() {
    var video = document.getElementById("video2");
    var but = document.getElementById("button");
    document.getElementById("overlay").innerHTML = "";
    document.body.style.cursor = 'default';
    video.style.visibility = "hidden";
    while (video.firstChild) {
        video.removeChild(video.firstChild);
    }
    if (num == 2) {
        window.location.replace("eval.html?partid=" + partid + "&dist=" + dist + "&vid=" + vid + "&order=" + order + "&try=" + trial);
    }
    else {
        num += 1;
        but.style.visibility = "visible";
        but.focus();
        vidtype = (typelist[order].charAt(num) == "a")? "4k" : "2k";
        var loc = "./videos/" + vidtype + "/" + vid + ".mp4";
        
        var source = document.createElement('source');
        source.setAttribute('src', loc);
        video.appendChild(source);
        video.load();
    }
    return;
}

// Load the questionnaire. This only replaces the button text if the last video
// has been played.
function loadEval() {
    if (vid >= MAX_NUM) {
        document.getElementById('submit').value = "Submit >>"
    }
    
}

// Evaluates and submits the results of each video to the backend.
function submitEval(form){
    // The radio button is required to continue.
    var params = 'ID=' + vid + '&';
    var choice = document.getElementsByName('choice')
    for(var i = 0; i < choice.length; i++) {
        if(choice[i].checked) {
            choice_val = choice[i].value;
        }
    }
    if (typeof choice_val === 'undefined') {
        document.getElementById('required').style  = "background: #FCC;";
        alert('Please choose an option from the first box before you proceed!');
        return false;
    }
    // If radio is checked, get the one that is chosen and get its correctness.
    params += 'choice=' + choice_val + '&';
    params += 'correct=' + ((correct[order] == choice_val) ? 1 : 0) + '&';
    
    // Add the rest of the form elements to the request.
    var elem = form.elements;
    for (var i = 4; i < elem.length; i++) {
        if (typeof(elem[i].checked) === 'undefined')
            continue;
        if (elem[i].getAttribute('type') == "submit") {
            continue;
        }
        if (elem[i].getAttribute('type') == "checkbox") {
            value = elem[i].checked ? 1:0;
        } else {
            value = elem[i].value;
        }
        params += elem[i].id + "=" + encodeURIComponent(value) + "&";
    }

    post(params);
    nextVideo();
    return false;

}


// Show please specify box when screen type other is selected
function evalScreen() {
    var screen = document.getElementById("screen");
    var screen_other = document.getElementById("screen_other");
    if (screen.value == "other"){
        screen_other.style.visibility = "visible";
    } else {
        screen_other.style.visibility = "hidden";
    }
}

var changed = false;
function changeSize(input){
    if (!changed) {
        changed = true;
        input.min = "1";
    }
    return input.value + '\" (' + Math.round(parseInt(input.value) * 2.54) + ' cm)'
}


// Extract the GET request parameter.
function get(name) {
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search)) {
        return decodeURIComponent(name[1]);
    }
}

// Send POST request to submit form data.
function post(params) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit.php?partid=" + partid + "&dist=" + dist, false);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("Content-length", params.length);
    xhr.send(params);
}

