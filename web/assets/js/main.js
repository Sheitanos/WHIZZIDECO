let videoContainer = $("#videoContainer");
videoContainer.on('click', function () {
    if (videoContainer[0].paused) {
        videoContainer[0].play();
    } else {
        videoContainer[0].pause();
    }
});

/*--*/
