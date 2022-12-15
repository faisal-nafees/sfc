import { Player } from "@twilio/live-player-sdk";

async function runLivePlayer() {
    if (Player.isSupported) {
        /* Load your application */
        let playerStarted = false;
        const { host, protocol } = window.location;

        let getAccessToken = await fetch(
            `${protocol}//${host}/api/generate-playback-grants`
        );
        getAccessToken = await getAccessToken.json();
        console.log(getAccessToken);
        if (getAccessToken?.status !== "success") {
            alert("Error getting access token");
            console.log(getAccessToken?.data?.message);
            return;
        }
        let { pg_access_token } = getAccessToken?.data;

        // Join a live stream.
        const player = await Player.connect(pg_access_token, {
            playerWasmAssetsPath: `${protocol}//${host}/js/twilio/live-player`,
        });

        // // Call this method after the Player transitions to the Player.State.Ready state.
        // player.play();

        // // Pause playback.
        // player.pause();

        // // Mute audio.
        // player.isMuted = true;

        // // Unmute audio.
        // player.isMuted = false;

        // // Set volume.
        // player.setVolume(0.5);

        player.on(Player.Event.VolumeChanged, () => {
            if (player.isMuted) {
                /* Show the unmute button */
            } else {
                /* Hide the unmute button */
            }
        });

        player.on(Player.Event.StateChanged, (state) => {
            switch (state) {
                case Player.State.Buffering:
                    console.log("The player is buffering content");
                    break;

                case Player.State.Ended:
                    console.log("The stream has ended");
                    break;

                case Player.State.Idle:
                    // This state is also reached as a result of calling player.pause()
                    console.log(
                        "The player has successfully authenticated and is loading the stream."
                    );
                    break;

                case Player.State.Playing:
                    // This state occurs as a result of calling player.play()
                    console.log("The player is now playing a stream");
                    break;

                case Player.State.Ready:
                    console.log("The player is ready to play back the stream");
                    player.play();
                    // playerStarted = true;
                    break;
            }
        });
        // assumes there's a div on the page called "videoDiv"
        // where an HTML Video Element can be attached
        const videoDiv = document.getElementById("twilio-video-player");
        // attach the video data into a div on the page
        videoDiv.appendChild(player.videoElement);
    } else {
        /* Inform the user that the browser is not supported */
    }
}
runLivePlayer();
