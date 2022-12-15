{{-- ON PHOTO CAPTURE
"webcamCaptured(capturePhoto)" FUNCITON IS CALLED
WITH PHOTO DATA AS ITS PARAMETER
YOU CAN DEFINE THE ABOUVE FUNCTION
AND USE ITS PARAMETER(captured webcam photo) AS YOU WISH

TO RESET TAKE PHOTO
CALL "resetWebcam()" --}}

<div id="webCam" {{ $attributes }}>
  <style>
    /* Webcame */
    #webCam {
      margin: 2rem 0;
      width: 100%;
    }	

    #webCam .photo-box {
      position: relative;
		 width: 100%;
      margin: 1rem 0
    }

    #webCam video {
      width: 100%;
      height: auto;
    }

    #webCam .reset {
      display: none;
    }

    #webCam .capturedHeadShot {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;;
      border: 1px solid grey;
      display: none;
      padding: 1rem;
      background: white;
      box-shadow: 4px 8px 4px rgba(128, 128, 128, 0.555);
      animation: 0.8s snap;
      transition: 1s 0.2s all ease-in;
    }
    #webCam .faceImg {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
    }
    .webcam-photos .add-photo.card {
      position: relative;
    }

    .webcam-photos .empty,
    .webcam-photos .filled {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    @keyframes snap {
      0% {
        transform: scale(1.2);
      }

      100% {
        transform: scale(1);
      }
    }
	  .blinkText{
		   position: absolute;
		  inset: 0;
		  width: 100%;
		  display: grid;
		  justify-content: center;
		  align-items: center;
		  pointer-events: none;
		  z-index: 10;
		  padding-bottom: 50%;
	  }
	  .arrowsbody{
		   position: absolute;
		  inset: 0;
		  width: 100%;
		  display: none;
		  justify-content: center;
		  align-items: center;
	  }
	  .arrow{
		  width: 20%;
		  aspect-ratio : 1 / 1;
		  border-top: 10px solid #fff;
		  border-left: 10px solid #fff;
		  transform: rotate(-45deg);
		  display: none;
	  }
	  .arrowAnimation {
	  	 animation: arrow-load 1s infinite;
	  }
	  .arrowAnimationRight {
	  	 animation: arrow-load-right 1s infinite;
	  }
	  .arrowAnimationUp {
	  	 animation: arrow-load-up 1s infinite;
	  }
	  .arrowAnimationDown {
	  	 animation: arrow-load-down 1s infinite;
	  }
	  @keyframes arrow-load {
		  0%{
			  opacity: 0;
			  transform: rotate(-45deg) translate(60px, 60px);
		  }
		  0%{
			  opacity: 1;
		  }
		  100%{
			  opacity: 0;
			  transform: rotate(-45deg) translate(-60px, -60px);
		  }
	  }
	  
	  @keyframes arrow-load-up {
		  0%{
			  opacity: 0;
			  transform: rotate(45deg) translate(60px, 60px);
		  }
		  0%{
			  opacity: 1;
		  }
		  100%{
			  opacity: 0;
			  transform: rotate(45deg) translate(-60px, -60px);
		  }
	  }
	  
	  @keyframes arrow-load-down {
		  0%{
			  opacity: 0;
			  transform: rotate(225deg) translate(60px, 60px);
		  }
		  0%{
			  opacity: 1;
		  }
		  100%{
			  opacity: 0;
			  transform: rotate(225deg) translate(-60px, -60px);
		  }
	  }
	  @keyframes arrow-load-right {
		  0%{
			  opacity: 0;
			  transform: rotate(-225deg) translate(60px, 60px);
		  }
		  0%{
			  opacity: 1;
		  }
		  100%{
			  opacity: 0;
			  transform: rotate(-225deg) translate(-60px, -60px);
		  }
	  }
	  @keyframes timer-slide-lt {
		  0%   { transform: rotate(135deg); }
		  50%  { transform: rotate(135deg); }
		  100%  { transform: rotate(315deg); }
	  }
	  @keyframes timer-slide-rt {
		  0%   { transform: rotate(-45deg); }
		  50%  { transform: rotate(135deg); }
		  100%  { transform: rotate(135deg); }
	  }
	.timer {
		position: absolute;
		inset: 0;
		width: 100%;
		height: 100%;
		background: black;
		display: none;
	}
	 .timer .circle-timer {
		 width: 200px;
		 height: 200px;
		 margin: 2rem auto;
		 position: relative;	 
	}
	 .timer .circle-timer .timer-slot {
		 position: relative;
		 width: 100px;
		 height: 200px;
		 display: inline-block;
		 overflow: hidden;
		 float: left;
	}
	 .timer .circle-timer .timer-slot .timer-lt, .timer .circle-timer .timer-slot .timer-rt {
		 border-radius: 50%;
		 position: relative;
		 top: 50%;
		 left: 0;
		 z-index: 15;
		 border: 10px solid white;
		 width: 180px;
		 height: 180px;
		 margin-left: -100px;
		 margin-top: -100px;
		 border-left-color: transparent;
		 border-top-color: transparent;
		 z-index: 5;
	}
	 .timer .circle-timer .timer-slot .timer-lt {
		 animation: 5s linear infinite timer-slide-lt;
		 left: 100%;
	}
	 .timer .circle-timer .timer-slot .timer-rt {
		 animation: 5s linear infinite timer-slide-rt;
	}
	 .timer .circle-timer .count {
		 position: absolute;
		 width: 100%;
		 height: 100%;
		 font-size: 8rem;
		 color: white;
		 text-align: center;
		 line-height: 200px;
		 font-family: sans-serif;
	}
	 .timer .circle-timer.paused .timer-lt, .timer .circle-timer.paused .timer-rt {
		 animation-play-state: paused;
		 transition: all 0.5s;
	}
	 .timer .circle-timer.paused .timer-lt, .timer .circle-timer:hover .timer-lt, .timer .circle-timer.paused .timer-rt, .timer .circle-timer:hover .timer-rt {
		 border: 10px solid rgba(255, 255, 255, .5);
		 border-left-color: transparent;
		 border-top-color: transparent;
		 transition: all 0.5s;
	}
	 .timer .circle-timer.paused .count {
		 color: rgba(255, 255, 255, 0.5);
		 transition: all 0.5s;
	}

	  .blink_me {
		  font-weight: bold;
		  color: red;
		  animation: blinker 1s linear infinite;
	  }

	  @keyframes blinker {  
		  50% { opacity: 0; }
	  }
  </style>
<div class="form-group">
    <label for="selVidDevice">Video Device</label>
    <select id="selVidDevice" name="video" class="videoSource form-select form-select-sm">
    </select>
  </div>
  {{-- <label for="selAudDevice">
            Audio Device</label>
        <select id="selAudDevice" name="audio" class="audioSource form-select form-select-sm">
      </select> --}}
	 
  <div class="photo-box">
	
    <video id="video" autoplay style="visibility:visible; width: 100%; position: absolute;top: 0; left: 0;"></video>
    <canvas id="canvas" style="position: relative; opacity: 0.9;"></canvas>
	      <img class="capturedHeadShot" src="">
	   <div class="blinkText">
		  <span class="blink_me">Touch here to start capturing face pictures</span>
	  </div>
	  <div class="arrowsbody">
		  <div class="arrow"></div>
		  <div class="arrow"></div>
		  <div class="arrow"></div>
	  </div>
	  <div class="timer">
		  <div class="circle-timer">
			  <div class="timer-slot">
				  <div class="timer-lt"> </div>
			  </div>
			  <div class="timer-slot">
				  <div class="timer-rt"></div>
			  </div>
			  <div class="count"></div>
		  </div>
	  </div>
	  <img class="faceImg" src="/img/touch_here.png">
	  
  </div>
  <button type="button" onclick="resetWebcam()" class="reset btn btn-secondary w-100 ">
    <i class="fa fa-redo" aria-hidden="true"></i> Retake Photo
  </button>
  <button type="button" onclick="takeAPhoto()" class="screenshot-button btn btn-primary w-100 ">
    <i class="fa fa-camera" aria-hidden="true"></i> Capture
  </button>

  <script>
	  
	  if (!(/iPhone|Windows|Android|Mac/i.test(navigator.userAgent))) {
		   location.href = "{{ url('/login')}}";
        }
	  
if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
    // Firefox 38+ seems having support of enumerateDevicesx
    navigator.enumerateDevices = function(callback) {
        navigator.mediaDevices.enumerateDevices().then(callback);
    };
}
	  
var MediaDevices = [];
var isHTTPs = location.protocol === 'https:';
var canEnumerate = false;

if (typeof MediaStreamTrack !== 'undefined' && 'getSources' in MediaStreamTrack) {
    canEnumerate = true;
} else if (navigator.mediaDevices && !!navigator.mediaDevices.enumerateDevices) {
    canEnumerate = true;
}

var hasMicrophone = false;
var hasSpeakers = false;
var hasWebcam = false;

var isMicrophoneAlreadyCaptured = false;
var isWebcamAlreadyCaptured = false;
let permissionAsked = {
    audio: false,
    video: false,
};
function checkDeviceSupport(callback) {
    if (!canEnumerate) {
        return;
    }

    if (!navigator.enumerateDevices && window.MediaStreamTrack && window.MediaStreamTrack.getSources) {
        navigator.enumerateDevices = window.MediaStreamTrack.getSources.bind(window.MediaStreamTrack);
    }

    if (!navigator.enumerateDevices && navigator.enumerateDevices) {
        navigator.enumerateDevices = navigator.enumerateDevices.bind(navigator);
    }

    if (!navigator.enumerateDevices) {
        if (callback) {
            callback();
        }
        return;
    }

    MediaDevices = [];
    navigator.enumerateDevices(function(devices) {
        devices.forEach(function(_device) {
            var device = {};
            for (var d in _device) {
                device[d] = _device[d];
            }

            if (device.kind === 'audio') {
                device.kind = 'audioinput';
            }

            if (device.kind === 'video') {
                device.kind = 'videoinput';
            }

            var skip;
            MediaDevices.forEach(function(d) {
                if (d.id === device.id && d.kind === device.kind) {
                    skip = true;
                }
            });

            if (skip) {
                return;
            }

            if (!device.deviceId) {
                device.deviceId = device.id;
            }

            if (!device.id) {
                device.id = device.deviceId;
            }

            if (!device.label) {
                device.label = 'Please invoke getUserMedia once.';
                if (!isHTTPs) {
                    device.label = 'HTTPs is required to get label of this ' + device.kind + ' device.';
                }
            } else {
                if (device.kind === 'videoinput' && !isWebcamAlreadyCaptured) {
                    isWebcamAlreadyCaptured = true;
                }

                if (device.kind === 'audioinput' && !isMicrophoneAlreadyCaptured) {
                    isMicrophoneAlreadyCaptured = true;
                }
            }

            if (device.kind === 'audioinput') {
                hasMicrophone = true;
            }

            if (device.kind === 'audiooutput') {
                hasSpeakers = true;
            }

            if (device.kind === 'videoinput') {
                hasWebcam = true;
            }

            // there is no 'videoouput' in the spec.

            MediaDevices.push(device);
        });

        if (callback) {
            callback();
        }
    });
}
function askDevicePermission(constraints, callback) {
    // set permissionAsked to true for all asked devices so that we don't ask again
    Object.entries(constraints).forEach(([key, value]) => {
        permissionAsked[key] = true;
    })
    navigator.mediaDevices.getUserMedia(constraints)
   .then(function (stream) {
         if (stream.getVideoTracks().length > 0){
            callback();
         } else {
            // code for when both devices are available
            callback();
         }
   })
  .catch(function (error) { 
       // code for when there is an error
       callback();
   });
}

// check for microphone/camera support!
// checkDeviceSupport(function() {
//     document.write('hasWebCam: ', hasWebcam, '<br>');
//     document.write('hasMicrophone: ', hasMicrophone, '<br>');
//     document.write('isMicrophoneAlreadyCaptured: ', isMicrophoneAlreadyCaptured, '<br>');
//     document.write('isWebcamAlreadyCaptured: ', isWebcamAlreadyCaptured, '<br>');
// });

	
	/* --------------- Configure a few settings and attach camera --------------- */
const getEl = (elm) => document.querySelector(elm);
const reset = getEl("#webCam .reset");
const screenshotButton = getEl("#webCam .screenshot-button");
const img = getEl("#webCam .capturedHeadShot");
const faceImg = getEl("#webCam .faceImg");	  
const video = getEl("#webCam video");
const captureVideoButton = getEl("#webCam .capture-video-button");
const canvas = document.getElementById('canvas');
var ctx = null;
	  
video.setAttribute('autoplay', '');
video.setAttribute('muted', '');
video.setAttribute('playsinline', '');
	  
// const audioSelect = getEl("#webCam .audioSource");
const videoSelect = getEl("#webCam .videoSource");

function hasGetUserMedia() {
    return navigator.mediaDevices && navigator.mediaDevices.getUserMedia
        ? true
        : false;
}

function webCamInit() {
	
    // If webcam available
    checkDeviceSupport(function () {
        let error;
        console.log({
            hasWebcam,
            isWebcamAlreadyCaptured,
        });
        if (!hasWebcam) {
            error = "Please plugin your webcam and refresh the page";
            $(".webcame-check").addClass("text-danger");
        }
        if (!error && !isWebcamAlreadyCaptured) {
            if (!permissionAsked.video)
                return askDevicePermission({ video: true }, webCamInit);
            error =
                "Please allow the website to access your webcam and refresh the page";
        }
        if (error) {
            console.error(error);
           //alert(error);
            $('#openPermissionModalBtn').click();
            return;
        }
        navigator.mediaDevices
            .enumerateDevices()
            .then(gotDevices)
            .then(getStream)
            .catch(handleError);
    });
}

//   audioSelect.onchange = getStream;
videoSelect.onchange = getStream;

function gotDevices(deviceInfos) {
    for (let i = 0; i !== deviceInfos.length; ++i) {
        const deviceInfo = deviceInfos[i];
        const option = document.createElement("option");
        option.value = deviceInfo.deviceId;
        //   if (deviceInfo.kind === "audioinput") {
        //     option.text =
        //       deviceInfo.label || "microphone " + (audioSelect.length + 1);
        //     audioSelect.appendChild(option);
        //   } else
        if (deviceInfo.kind === "videoinput") {
            option.text =
                deviceInfo.label || "camera " + (videoSelect.length + 1);
            videoSelect.appendChild(option);
        } else {
            console.log("Found another kind of device: ", deviceInfo);
        }
    }
}

function getStream() {
    if (window.stream) {
        window.stream.getTracks().forEach(function (track) {
            track.stop();
        });
    }
    const constraints = {
        //   audio: {
        //     deviceId: {
        //       exact: audioSelect.value
        //     },
        //   autoGainControl: false,
        //   channelCount: 2,
        //   echoCancellation: true,
        //   noiseSuppression: true,
        //   sampleRate: 48000,
        //   sampleSize: 16,
        //   },

        video: {
            facingMode: "user",
            width: {
                min: 640,
                // exact: 1080,
                 max: 1080,
            },
            height: {
                min: 480,
                // exact: 1350,
                max: 1080,
            },
            deviceId: {
                exact: videoSelect.value,
            },
            frameRate: {
                ideal: 15,
                // max: 30,
            },
        },
    };
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(gotStream)
        .catch(handleError);
}

function gotStream(stream) {
    window.stream = stream; // make stream available to console
    //video.srcObject = stream;
	if ('srcObject' in video) {
        video.srcObject = stream;
    } else {
        video.src = URL.createObjectURL(stream);
    }
	
	function timer(){
		$("img.faceImg").hide();
				$(".timer .circle-timer .count").text(count);
				$('.timer').show();
			     setInterval(timerCountdown, 1000);
				$('.timer').fadeOut(6000);
				$('.blinkText span').text('\u2022 Look Straight');
		
		setTimeout(function(){
					faceShouldVerify = true;
				}, 3000);
	};
	
	$("img.faceImg").click( function(){
		var activationId = document.querySelector("#activateAccountForm");
		if(activationId){
			if(activationId.checkValidity() ){
				timer();
			} else {
				$('.blinkText span').text('\u2022 please fill the details above before starting face capture');
			}
		} else {
				timer();
		}
	});
	detectPoseInRealTime(video);
}
let faceShouldVerify = false;
let bool = true;
	  
function verifyFace(captureImg, faceDirection){
   // var data = captureImg.substr(captureImg.indexOf('base64') + 7);
	 $("#data_show_pitch").text("Pitch Init");
   url = 'https://sfc2.cognitiveservices.azure.com/face/v1.0/detect?overload=stream&returnFaceAttributes=headPose&detectionModel=detection_03&recognitionModel=recognition_04&returnRecognitionModel=True';
        fetch(url, {
            headers: {
              'Content-Type': 'application/octet-stream',
              'Ocp-apim-subscription-key' : 'd739258ed7234d1097f5a62953671726',
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            method: 'post',
            body:  captureImg,
          })
          .then(function(response) {
			 $("#data_show_yaw").text("yaw response");
            return response.json();
          })
          .then( function(data) {
			bool = true;
            if (data && data.length>0 && faceShouldVerify) {
                 drawCtx();
				 rectangle = data[0].faceRectangle;
				 drawRect();
				 var headPose = data[0].faceAttributes.headPose;
				 if(!(headPose.roll > 10 || headPose.roll < -10)){
					 if(currentFaceDirection == 'forward' && faceDirection == currentFaceDirection){
						  if (!(headPose.yaw > 10 || headPose.yaw < -10 || headPose.pitch > 15 || headPose.pitch < -15)) {
							createPhoto(captureImg);	  
						} 
					 } else if (currentFaceDirection == 'right' && faceDirection == currentFaceDirection) {
						if (headPose.yaw < -20) {
						   createPhoto(captureImg);
						}
					} else if (currentFaceDirection == 'left' && faceDirection == currentFaceDirection) {
						if (headPose.yaw > 20) {
							createPhoto(captureImg);
						}
					} else if (currentFaceDirection == 'up' && faceDirection == currentFaceDirection) {
						if (headPose.pitch > 15) {
							createPhoto(captureImg);
						}
					} else if (currentFaceDirection == 'down' && faceDirection == currentFaceDirection ) {
						if (headPose.pitch < -15) {
						   createPhoto(captureImg);
						}
					}
				}
                return data;

            } else {
				rectangle= null;
				$("#data_show_pitch").text("Pitch error ");
              throw new Error(data?.error);
            }
          })
          .catch(function(error) {
				$("#data_show_pitch").text("Pitch error 2 "+error);
            console.log({error})
          })
}
	  {{--beep function--}}
	   function beep() {
        var snd = new Audio('/img/beep.wav');
        snd.play();
      }
	  
	  {{--beep function end--}}
	   
	   {{-- capture sound --}}
	   function capture_sound() {
        var snd = new Audio("/img/iphone-capture.mp3");
	   snd.play();
      }
	   
let i = 0;
let rectangle = null;
function blobToDataURL(blob, callback) {
    var a = new FileReader();
    a.onload = function(e) {callback(e.target.result);}
    a.readAsDataURL(blob);
}

async function detectPoseInRealTime(video, net) {
        ctx = canvas.getContext('2d');
	
       async function poseDetectionFrame() {
 	
		   const vidStyleData = video.getBoundingClientRect();
			  canvas.style.width = vidStyleData.width + "px";
			  canvas.style.height = vidStyleData.height + "px";
		   	  canvas.width = video.videoWidth;
			  canvas.height = video.videoHeight;
			
            
		   	 drawCtx();
			 drawRect();
		       var activation = document.querySelector("#activateAccountForm")
				//$("#textD").text(" detectPoseInRealTime i " +i + bool + faceShouldVerify + kk++);	
			    let openFaceVerify = activation ? activation.checkValidity() : true;
		   
                if(openFaceVerify && bool && faceShouldVerify && ++i<200){
                   		//$("#data_show_pitch").text("Pitch 2");
					const canvs = document.createElement("canvas");
					canvs.width = video.videoWidth;
					canvs.height = video.videoHeight;
					canvs.getContext("2d").drawImage(video, 0, 0);
					bool = false;
					drawCtx();
                    canvs.toBlob((blob) => {
                        verifyFace(blob, currentFaceDirection);
						beep();
                    });

                }
              video.requestVideoFrameCallback(poseDetectionFrame);//requestAnimationFrame(poseDetectionFrame);
            return;
            
       }
       poseDetectionFrame();
   }

 function drawCtx() {
	 this.ctx.drawImage(
        this.video, 0, 0, this.video.videoWidth, this.video.videoHeight);
  }
  function drawRect() {
       if (rectangle != null) {

            this.ctx.beginPath();
            this.ctx.lineWidth = "5";
            this.ctx.strokeStyle = "Green";
            this.ctx.rect(rectangle.left, rectangle.top, rectangle.width, rectangle.height);
            this.ctx.stroke();

       }
   }
function handleError(error) {
    alert("Something went wrong!! Unable to access webcam!!");
    console.error("Error: ", error);
}

function captureWebcam() {
    const canvas = document.createElement("canvas");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext("2d").drawImage(video, 0, 0);
    // Other browsers will fall back to image/png
    return canvas.toDataURL("image/jpg");
}

	  // Button click
function createPhoto(captureImg) {
	
    // jquery to vanilla js
	faceShouldVerify = false;
	$('.blinkText').hide();
	var urlCreator = window.URL || window.webkitURL;
    var imageUrl = urlCreator.createObjectURL(captureImg);
	img.src = imageUrl;
	img.style.display = "block";
	screenshotButton.style.display = "none";
    reset.style.display = "block";
	blobToDataURL(captureImg, function(dataurl){
		
		if (typeof webcamCaptured == "function") {
			 capture_sound();
			webcamCaptured(dataurl);
			     
		}
		
	});
}
	  
// Button click
function takeAPhoto() {
    // jquery to vanilla js
	faceShouldVerify = false;
	$('.blinkText').hide();
	//alert("");
    var imgCapture = captureWebcam();
    img.src = imgCapture;
    img.style.display = "block";
    screenshotButton.style.display = "none";
    reset.style.display = "block";
    if (typeof webcamCaptured == "function") { 
	    capture_sound();
        webcamCaptured(imgCapture);
		
    }
	
}

	  function resetWebcam() {
		  faceShouldVerify = true;
		  $('.blinkText').show();
		  i = 0;
		  //faceImg.src = $('img.face.img-fluid').attr('src');
		  img.src = captureWebcam();
		  img.style.display = "none";
		  screenshotButton.style.display = "block";
		  reset.style.display = "none";
		  if(currentFaceDirection == 'right'){
			  $('.blinkText span').text('\u2022 Look RIGHT');
			  $('.arrowsbody').css("display", "flex").css("padding", 0).css("padding-left", "60%");
			  $('.arrow').each(function(){
				  $(this).removeClass('arrowAnimationUp arrowAnimationDown arrowAnimationRight arrowAnimation')
					  .addClass("arrowAnimationRight")
					  .css("width", "30%")
					  .css("display", "block")
					  .css("margin", "auto")
					  .fadeOut(8000);
			  });
		  }
		  
		  if(currentFaceDirection == 'left'){
			  $('.blinkText span').text('\u2022 Look LEFT');
			  $('.arrowsbody').css("display", "flex").css("padding", 0).css("padding-right", "60%");
			  $('.arrow').each(function(){
				  $(this).removeClass('arrowAnimationUp arrowAnimationDown arrowAnimationRight arrowAnimation')
					  .addClass("arrowAnimation")
					  .css("width", "30%")
					  .css("display", "block")
					  .css("margin", "auto")
					  .fadeOut(8000);
			  });
		  }
		  
		  if(currentFaceDirection == 'up'){
			  $('.blinkText span').text('\u2022 Look UP');
			  $('.arrowsbody').css("display", "block").css("padding", 0).css("padding-bottom", "60%");
			  $('.arrow').each(function(){
				  $(this).removeClass('arrowAnimationUp arrowAnimationDown arrowAnimationRight arrowAnimation')
					  .addClass("arrowAnimationUp")
					  .css("display", "block")
					  .css("width", "10%")
					  .css("margin", "auto")
					  .fadeOut(8000);
			  });
		  }
		  
		  if(currentFaceDirection == 'down'){
			  $('.blinkText span').text('\u2022 Look DOWN');
			  $('.arrowsbody').css("display", "block").css("padding", 0).css("padding-top", "50%");
			  $('.arrow').each(function(){
				  $(this).removeClass('arrowAnimationUp arrowAnimationDown arrowAnimationRight arrowAnimation')
					  .addClass("arrowAnimationDown")
					  .css("display", "block")
					  .css("width", "10%")
					  .css("margin", "auto")
					  .fadeOut(8000);
			  });
		  }
	  }
	  
	  var initialCount 	= 5,
		  count 		= initialCount,
		  timerPause	= false;

	  function timerCountdown() {	    	
		  if (!timerPause) {
			  count = count - 1;
			  if (count <= 0) {
				  clearInterval(timerCountdown);
				  count = initialCount;
				  var el = $(".circle-timer");
				  el.before( el.clone(true) ).remove();
			  } 
			  $(".timer .circle-timer .count").text(count);
		  }
	  }
	   
	

/* -------------------------------------------------------------------------- */

	</script>
</div>
