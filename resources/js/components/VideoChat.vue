<template>
    <div class="p-5">
        <div class="grid grid-flow-row grid-cols-3 grid-rows-3 gap-4 bg-black/]">
            <div id="my-video-chat-window"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'video-chat',
        data: function () {
            return {
                accessToken: ''
            }
        },
        methods: {
            getAccessToken: function () {

                const _this = this
                const axios = require('axios')

                // Request a new token
                axios.get('/api/access_token')
                    .then(function (response) {
                        _this.accessToken = response.data
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        console.log(_this.accessToken)
                        _this.connectToRoom()
                    });
            },
            connectToRoom: function () {

                const { connect, createLocalVideoTrack } = require('twilio-video');

                connect(this.accessToken, { name: 'cool room' }).then(room => {

                    console.log(`Successfully joined a Room: ${room}`);

                    const videoChatWindow = document.getElementById('my-video-chat-window');

                    createLocalVideoTrack().then(track => {
                        console.log({ track, videoChatWindow });
                        videoChatWindow.appendChild(track.attach());
                    });

                    room.on('participantConnected', participant => {
                        console.log(`Participant "${participant.identity}" connected`);

                        participant.tracks.forEach(publication => {
                            if (publication.isSubscribed) {
                                const track = publication.track;
                                videoChatWindow.appendChild(track.attach());
                            }
                        });

                        participant.on('trackSubscribed', track => {
                            videoChatWindow.appendChild(track.attach());
                        });
                    });
                }, error => {
                    console.log({error});
                    console.error(`Unable to connect to Room: ${error.message}`);
                });
            }
        },
        mounted: function () {
            console.log('Video chat room loading...')

            this.getAccessToken()
        },

    }
</script>
