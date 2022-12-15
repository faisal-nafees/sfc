/* --------------- Configure a few settings and attach camera --------------- */
const getEl = (elm) => document.querySelector(elm);
const reset = getEl("#webCam .reset");
const screenshotButton = getEl("#webCam .screenshot-button");
const img = getEl("#webCam .capturedHeadShot");
const video = getEl("#webCam video");
const captureVideoButton = getEl("#webCam .capture-video-button");

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
            alert(error);
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
                // max: 1080,
            },
            height: {
                min: 480,
                // exact: 1350,
                // max: 1080,
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
    video.srcObject = stream;
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
function takeAPhoto() {
    // jquery to vanilla js
    var imgCapture = captureWebcam();
    img.src = imgCapture;
    img.style.display = "block";
    screenshotButton.style.display = "none";
    reset.style.display = "block";
    if (typeof webcamCaptured == "function") {
        webcamCaptured(imgCapture);
    }
}

function resetWebcam() {
    img.src = captureWebcam();
    img.style.display = "none";
    screenshotButton.style.display = "block";
    reset.style.display = "none";
}

/* -------------------------------------------------------------------------- */
