@extends('classroom/layout')
@section('head')
<title>Live Conversation</title>
@endsection
@section('content')
<style>
    body {
        background: black;
    }

    main.col-md-9.ml-sm-auto.col-lg-10.p-4 {
        padding: 0 0 0 1rem !important;
    }

    .room-container {
        background: black;
        padding: 1rem;
    }

    .video-grid {
        display: grid;
        gap: 1rem;
        width: 100%;
        height: calc(100vh - 175px);
        grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
        align-items: center;
        align-content: center;
    }

    .video-grid video {
        width: 100%;
        aspect-ratio: 1.78/1;
        background: var(--dark)
    }


    .action-bar {
        background: rgb(10 10 10 / 80%);
        backdrop-filter: blur(20px);
        border-top: 2px solid rgb(255 255 255 / 10%);
        border-left: 2px solid rgb(255 255 255 / 10%);
        border-right: 1px solid rgb(255 255 255 / 2%);
        border-bottom: 1px solid rgb(255 255 255 / 2%);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 4px;
        position: fixed;
        bottom: 1rem;
        width: 80%;
        z-index: 2;
    }

    .action-bar .action-button {
        background: transparent;
        color: var(--light);
        border: none;
        /* padding: 0.5rem 1rem; */
        cursor: pointer;
        font-weight: 600;
        outline: none !important;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center
    }

    .action-bar .action-button i {
        font-size: 1.2rem;
    }

    .action-bar .action-button .icon-container {
        height: 24px;
        aspect-ratio: 1/1;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hide {
        display: none;
    }

    .gap-3 {
        gap: 1rem;
    }

    #local-media-container video {
        width: 100%;
    }

</style>
@include('inc.alert')
<div class="room-container">
    <div id="my-video-chat-window" class="video-grid ">
    </div>

    <div class="action-bar" style="display: none">
        <div class="d-flex gap-3">
            <button class="action-button" onclick="muteMyAudio(this)">
                <div class="icon-container center">
                    <i class="fas fa-microphone-alt "></i>
                    <i class="fas fa-microphone-alt-slash hide"></i>
                </div>
                <small class="text">Mute</small>
            </button>
            <button class="action-button" onclick="muteMyVideo(this)">
                <div class="icon-container center">
                    <i class="fas fa-video"></i>
                    <i class="fas fa-video-slash hide"></i>
                </div>
                <small class="text">Stop Video</small>
            </button>
        </div>
        <button class="action-button text-danger" onclick="endVideoCall()">End Meeting</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade " id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="card-title">Video Call</h4>
                <p class="card-text">Before starting the video call, make sure that your <b>WEBCAM</b> and
                    <b>MICROPHONE</b> are properly pluged in to your system.
                </p>
                <div class="d-flex py-5 text-center px-md-5 justify-content-around">
                    <div class="webcame-check">
                        <i class="fa fa-video fa-3x"></i>
                    </div>
                    <div class="microphone-check">
                        <i class="fa fa-microphone fa-3x"></i>
                    </div>
                </div>
                <div id="local-media-container"></div>
                <button type="button" onclick="getDevicesReadyAndStartVideoCall()" class="btn btn-primary">
                    <i class="fa fa-video" aria-hidden="true"></i>
                    Start Video Call
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="/js/app.js"></script>
<script src="/js/navigatorMediaCheck.js"></script>
<script>
    $("#modelId").modal('show');
    let accessToken = '{{ session()->get('accessToken') }}';
    const videoChatWindow = document.getElementById('my-video-chat-window');
    const localMediaContainer = document.getElementById('local-media-container');
    let myroom, mytrack;
    let permissionAsked = {
        audio: false,
        video: false
    };
    let participantsTrack = [] ;
    checkDeviceSupport(function() {
            let error
            console.log({
                hasWebcam, isWebcamAlreadyCaptured
            })
            if(!hasMicrophone){
                error = 'Please plugin your microphone and refresh the page'
            }
            if(!hasWebcam){
                error = 'Please plugin your webcam and refresh the page'
                $('.webcame-check').addClass('text-danger')
            }
            if(!error && !isMicrophoneAlreadyCaptured){
                if(!permissionAsked.audio) return askDevicePermission({audio: true})
                error = 'Please allow the website to access your microphone and refresh the page';
            }
            if(!error && !isWebcamAlreadyCaptured){
                if(!permissionAsked.video) return askDevicePermission({video: true})
                error = 'Please allow the website to access your webcam and refresh the page'
            }
            if(error){
                console.error(error)
                videoChatWindow.innerHTML = /*html*/`
                    <div class="text-center  text-info p-5">
                        <i class="fas fa-exclamation-circle fa-3x pb-3 "></i>
                        <h3 class="pb-5">${error}</h3>
                        <a href="${window.location.href}" class="btn btn-outline-light">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </a>
                    </div>
                `
                xtoast({
                    type: "danger",
                    text: error
                });
                return ;
            }
            TwilioVideo.createLocalVideoTrack().then(track => {
                localMediaContainer.appendChild(track.attach());
            });
        })
    function getDevicesReadyAndStartVideoCall(){
        $("#modelId").modal('hide')
        checkDeviceSupport(function() {
            let error
            console.log({
                hasWebcam, isWebcamAlreadyCaptured
            })
            if(!hasMicrophone){
                error = 'Please plugin your microphone and refresh the page'
            }
            if(!hasWebcam){
                error = 'Please plugin your webcam and refresh the page'
                $('.webcame-check').addClass('text-danger')
            }
            if(!error && !isMicrophoneAlreadyCaptured){
                if(!permissionAsked.audio) return askDevicePermission({audio: true})
                error = 'Please allow the website to access your microphone and refresh the page';
            }
            if(!error && !isWebcamAlreadyCaptured){
                if(!permissionAsked.video) return askDevicePermission({video: true})
                error = 'Please allow the website to access your webcam and refresh the page'
            }
            if(error){
                console.error(error)
                videoChatWindow.innerHTML = /*html*/`
                    <div class="text-center  text-info p-5">
                        <i class="fas fa-exclamation-circle fa-3x pb-3 "></i>
                        <h3 class="pb-5">${error}</h3>
                        <a href="${window.location.href}" class="btn btn-outline-light">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </a>
                    </div>
                `
                xtoast({
                    type: "danger",
                    text: error
                });
                return ;
            }
            TwilioVideo.createLocalVideoTrack().then(track => {
                localMediaContainer.appendChild(track.attach());
            });
        })
    }

    function askDevicePermission(constraints) {
        // set permissionAsked to true for all asked devices so that we don't ask again
        Object.entries(constraints).forEach(([key, value]) => {
            permissionAsked[key] = true;
        })
        navigator.getUserMedia (constraints,
            // successCallback
            function(localMediaStream) {
                getDevicesReadyAndStartVideoCall()
            },
            // errorCallback
            function(err) {
                getDevicesReadyAndStartVideoCall()
            }
        );
    }

    function connectToRoom() {
        TwilioVideo.connect(accessToken, { name: 'cool room' }).then(room => {
            $('.action-bar').show();
            myroom = room;
            console.log(`Successfully joined a Room: ${room}`);

            // My track
            TwilioVideo.createLocalVideoTrack().then(track => {
                mytrack = track;
                console.log({mytrack})
                videoChatWindow.appendChild(track.attach())
            });

            // Existing participants in the room
            room.participants.forEach(participant => {
                console.log({existingParticipant:participant});
                participant.tracks.forEach(publication => {
                    if (publication.track && mytrack.id !== publication.track.id) {
                        !participantsTrack.includes(publication.identity) && participantsTrack.push(publication.identity)
                        // videoChatWindow.appendChild(publication.track.attach()).classList.add(`${participant.identity}`);
                    }
                });

                participant.on('trackSubscribed', track => {
                    console.log({participantTrackSubscribed:participant});
                    // if participantsTrack doesn't contain the track id, then add it to the array
                    !participantsTrack.includes(participant.identity) && participantsTrack.push(participant.identity)
                    videoChatWindow.appendChild(track.attach()).classList.add(`${participant.identity}`);
                });
            });

            // On new participant, subscribe to their tracks
            room.on('participantConnected', participant => {
                !participantsTrack.includes(participant.identity) && participantsTrack.push(participant.identity)
                console.log({participantConnected: participant});
                participant.tracks.forEach(publication => {
                    if (publication.isSubscribed) {
                        const track = publication.track;
                        !participantsTrack.includes(publication.identity) && participantsTrack.push(participant.identity)
                        videoChatWindow.appendChild(track.attach()).classList.add(`${participant.identity}`);
                    }
                });

                participant.on('trackSubscribed', track => {
                    console.log({trackSubscribed:participant, trackKind: track.kind});
                    // !participantsTrack.includes(participant.identity) && participantsTrack.push(participant.identity)
                   !participantsTrack.includes(participant.identity) && participantsTrack.push(participant.identity)
                    videoChatWindow.appendChild(track.attach()).classList.add(`${participant.identity}`);
                });
                // refreshCSS();
            });

            room.on('participantDisconnected', participant => {
                if(participantsTrack.includes(participant.identity)){
                    $('.'+participant.identity).remove();
                    participantsTrack.splice(participantsTrack.indexOf(participant.identity), 1)
                }
                console.log({participantDisconnected: participant});
            });

            // On participant disconnect, remove their video tracks
            room.on('disconnected', room => {
                console.log({disconnected: room});
                // Detach the local media elements
                room.localParticipant.tracks.forEach(publication => {
                    const attachedElements = publication.track.detach();
                    attachedElements.forEach(element => element.remove());
                    // videoChatWindow.querySelector('.track'+ publication.track.id).remove();
                });
            });

            // Log your Client's LocalParticipant in the Room
            const localParticipant = room.localParticipant;
            console.log({localParticipant});
            console.log({participantsTrack})
        }, error => {
            console.log({error});
            console.error(`Unable to connect to Room: ${error.message}`);
        });
    }

    function endVideoCall() {
        if (myroom) {
            myroom.disconnect();
        }
        videoChatWindow.innerHTML = '';
        $("#modelId").modal('show');
    }

    function muteMyAudio(e) {
        // To mute your local audio
        myroom.localParticipant.audioTracks.forEach(publication => {
            if(publication.track.isEnabled){
                publication.track.disable();
                $(e).find('.text').text('Unmute')
            }else{
                publication.track.enable()
                $(e).find('.text').text('Mute');
            }
        });
    }

    function muteMyVideo(e) {
        // To unmute your local video
        myroom.localParticipant.videoTracks.forEach(publication => {
            if(publication.track.isEnabled){
                publication.track.disable();
                $(e).find('.text').text('Start Video')
            }else{
                publication.track.enable()
                $(e).find('.text').text('Stop Video');
            }
        });
    }

    $('.action-button ').on('click', function() {
        if($(this).find('i').length > 1){
            $(this).find('i').toggleClass('hide');
        }
    });

    // refreshCSS = () => {
    //     let links = document.getElementsByTagName('link');
    //     for (let i = 0; i < links.length; i++) {
    //         if (links[i].getAttribute('rel') == 'stylesheet') {
    //             let href = links[i].getAttribute('href')
    //                                     .split('?')[0];

    //             let newHref = href + '?version='
    //                         + new Date().getMilliseconds();

    //             links[i].setAttribute('href', newHref);
    //         }
    //     }
    // }
</script>
@endsection
