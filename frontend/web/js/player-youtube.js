let player;
function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
        events: {
            'onReady': onPlayerReady
        }
    });
}
function onPlayerReady() {
    const youtubeDuration = document.getElementById("youtube-duration");
    youtubeDuration.innerHTML =
        'Branson Vacation Channel — ' + new Date(player.playerInfo.duration * 1000).toISOString().substring(14, 19);
    player.playVideo()
}
