document.addEventListener('DOMContentLoaded', function () {
    const ytplayer = document.getElementById('movie_player');
    let player;
    console.log(222)
    window.onclick = () => {
        console.log(player);
        alert(player.playerInfo.currentTime);
    }
});
function onYouTubePlayerAPIReady() {
    console.log(1111)
    player = new YT.Player('ytplayer', {
        height: '360',
        width: '640',
        videoId: 'r-DS6PzFnkg'
    });
}
