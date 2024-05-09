<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    <link rel="stylesheet" href="Styling.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body onload="updateVideoTime(0)">
    <div class="videoContainer" id="videoContainer">
        <video controls class="video" id="video" onclick="togglePause()" muted="false" onended="videoEnd()" src="Bali.mp4" loading="lazy">
            Your browser does not support the video tag.
        </video>
        <div class="customControls">
            <div class="topControls">
                <p class="videoTitle">Balinese Music</p>
            </div>
            <div class="playbackCenter">
                <svg class="playbackCenterIcons">
                    <use href="#play-icon" class="playIconCenter"></use>
                    <use href="#pause" class="pauseIconCenter"></use>
                </svg>
            </div>
            <div class="bottomControls">
                <div class="bottomControlsTop">
                    <div class="timestampFrameIndicatorContainer">
                        <div class="timestampFrame"></div>
                        <div class="timestampFrameIndicatorDiv">
                            <p class="timestampFrameIndicator"></p>
                        </div>
                    </div>
                    <input type="range" class="timestampSliderInput" oninput="updateVideoTime(this.value)" step=".01" max="100" min="0" value="0">
                </div>
                <div class="bottomControlsBottom">
                    <div class="leftBottomControls">
                        <div class="playbackBtn videoBtn" onclick="togglePause()">
                            <svg class="playbackIcons videoBtnIcons">
                                <use href="#play-icon" class="playIcon"></use>
                                <use href="#pause" class="pauseIcon"></use>
                            </svg>
                        </div>
                        <div class="volumeContainer" onmouseenter="showVolumeSlider()" onmouseleave="hideVolumeSlider()">
                            <div class="volumeBtn videoBtn" onclick="toggleMute()">
                                <svg class="volumeBtnIcons videoBtnIcons">
                                    <use href="#volume-high" class="muteIcon volumeHigh"></use>
                                    <use href="#volume-low" class="muteIcon volumeLow"></use>
                                    <use href="#volume-mute" class="unmuteIcon"></use>
                                </svg>
                            </div>
                            <div class="volumeSlider videoBtn">
                                <input type="range" class="volumeSliderInput" oninput="changeVolume(this.value)">
                            </div>
                        </div>
                        <div class="videoBtn timestamp">

                        </div>
                    </div>
                    <div class="rightBottomControls">
                        <div class="videoBtn" onclick="toggleAmbientGlow()">
                            <svg class="videoBtnIcons aGBtnIcon">
                                <use href="#ambientGlowEnabled" class="aGEnabled"></use>
                                <use href="#ambientGlowDisabled" class="aGDisabled"></use>
                            </svg>
                        </div>
                        <div class="videoBtn" onclick="toggleFullScreen()">
                            <svg class="videoBtnIcons">
                                <use href="#fullscreen" class="fullscreenIcon"></use>
                                <use href="#fullscreen-exit" class="fullscreenExitIcon"></use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <canvas id="ambientGlowCanvas" width="10" height="6" aria-hidden="true"></canvas>
    </div>
    <svg style="display: none">
        <defs>
            <symbol id="pause" viewBox="0 0 24 24">
                <path d="M14.016 5.016h3.984v13.969h-3.984v-13.969zM6 18.984v-13.969h3.984v13.969h-3.984z"></path>
            </symbol>

            <symbol id="play-icon" viewBox="0 0 24 24">
                <path d="M8.016 5.016l10.969 6.984-10.969 6.984v-13.969z"></path>
            </symbol>

            <symbol id="volume-high" viewBox="0 0 24 24">
                <path d="M14.016 3.234q3.047 0.656 5.016 3.117t1.969 5.648-1.969 5.648-5.016 3.117v-2.063q2.203-0.656 3.586-2.484t1.383-4.219-1.383-4.219-3.586-2.484v-2.063zM16.5 12q0 2.813-2.484 4.031v-8.063q1.031 0.516 1.758 1.688t0.727 2.344zM3 9h3.984l5.016-5.016v16.031l-5.016-5.016h-3.984v-6z"></path>
            </symbol>

            <symbol id="volume-low" viewBox="0 0 24 24">
                <path d="M5.016 9h3.984l5.016-5.016v16.031l-5.016-5.016h-3.984v-6zM18.516 12q0 2.766-2.531 4.031v-8.063q1.031 0.516 1.781 1.711t0.75 2.32z"></path>
            </symbol>

            <symbol id="volume-mute" viewBox="0 0 24 24">
            <path d="M14.016 3.234q3.047 0.656 5.016 3.117t1.969 5.648-1.969 5.648-5.016 3.117v-2.063q2.203-0.656 3.586-2.484t1.383-4.219-1.383-4.219-3.586-2.484v-2.063zM16.5 12q0 2.813-2.484 4.031v-8.063q1.031 0.516 1.758 1.688t0.727 2.344zM3 9h3.984l5.016-5.016v16.031l-5.016-5.016h-3.984v-6z"></path>
                <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-width="2" />
            </symbol>

            <symbol id="fullscreen" viewBox="0 0 24 24">
                <path d="M14.016 5.016h4.969v4.969h-1.969v-3h-3v-1.969zM17.016 17.016v-3h1.969v4.969h-4.969v-1.969h3zM5.016 9.984v-4.969h4.969v1.969h-3v3h-1.969zM6.984 14.016v3h3v1.969h-4.969v-4.969h1.969z"></path>
            </symbol>

            <symbol id="fullscreen-exit" viewBox="0 0 24 24">
                <path d="M15.984 8.016h3v1.969h-4.969v-4.969h1.969v3zM14.016 18.984v-4.969h4.969v1.969h-3v3h-1.969zM8.016 8.016v-3h1.969v4.969h-4.969v-1.969h3zM5.016 15.984v-1.969h4.969v4.969h-1.969v-3h-3z"></path>
            </symbol>

            <symbol id="pip" viewBox="0 0 24 24">
                <path d="M21 19.031v-14.063h-18v14.063h18zM23.016 18.984q0 0.797-0.609 1.406t-1.406 0.609h-18q-0.797 0-1.406-0.609t-0.609-1.406v-14.016q0-0.797 0.609-1.383t1.406-0.586h18q0.797 0 1.406 0.586t0.609 1.383v14.016zM18.984 11.016v6h-7.969v-6h7.969z"></path>
            </symbol>

            <symbol id="ambientGlowEnabled" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
</symbol>

            
            <symbol id="ambientGlowDisabled" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5V3m0 18v-2M7.05 7.05 5.636 5.636m12.728 12.728L16.95 16.95M5 12H3m18 0h-2M7.05 16.95l-1.414 1.414M18.364 5.636 16.95 7.05M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
    <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-width="2" />
</symbol>

        </defs>
    </svg>

    <script>
        var videoContainer = $("#videoContainer");

        const defaultVolume = 100;
        const volumeSliderAnimationTime = 250;
        const playBackCenterFadeAnimationTime = 700;
        var ambientGlow = true;

        var prevVolume = defaultVolume;
        var zeroVolumeHandler = false;

        const video = $(".video", videoContainer);
        const customControls = $(".customControls", videoContainer);
        const pauseIcon = $(".pauseIcon", videoContainer);
        const playIcon = $(".playIcon", videoContainer);
        const pauseIconCenter = $(".pauseIconCenter", videoContainer);
        const playIconCenter = $(".playIconCenter", videoContainer);
        const playbackCenter = $(".playbackCenter", videoContainer);
        const fullscreenExitIcon = $(".fullscreenExitIcon", videoContainer);
        const fullscreenIcon = $(".fullscreenIcon", videoContainer);
        const unmuteIcon = $(".unmuteIcon", videoContainer);
        const muteIcon = $(".muteIcon", videoContainer);
        const volumeHighIcon = $(".volumeHigh", videoContainer);
        const volumeLowIcon = $(".volumeLow", videoContainer);
        const volumeSlider = $(".volumeSlider", videoContainer)
        const volumeSliderInput = $(".volumeSliderInput", videoContainer);
        const timestamp = $(".timestamp", videoContainer);
        const timestampSliderInput = $(".timestampSliderInput", videoContainer);
        const timestampFrameIndicator = $(".timestampFrameIndicator", videoContainer);
        const timestampFrameIndicatorContainer = $(".timestampFrameIndicatorContainer", videoContainer);
        const timestampFrame = $(".timestampFrame", videoContainer);
        const canvas = document.getElementById('ambientGlowCanvas', videoContainer);
        const ambientGlowEnabled = $(".aGEnabled", videoContainer);
        const ambientGlowDisabled = $(".aGDisabled", videoContainer);

        video.prop("controls", false);
        customControls.css("display", "block");
        playbackCenter.hide();
        changeVolume(prevVolume);

        ctx = canvas.getContext('2d');
        let step;

        const draw = () => {
            if (!ambientGlow) {
                return;
            }
                ctx.drawImage(video.get(0), 0, 0, canvas.width, canvas.height)
        };

        const drawLoop = () => {
            draw();
            step = window.requestAnimationFrame(drawLoop);
        };

        const drawPause = () => {
            window.cancelAnimationFrame(step);
            step = undefined;
        };

        drawLoop();

        const init = () => {
            video.get(0).addEventListener("loadeddata", draw, false);
            video.get(0).addEventListener("seeked", draw, false);
            video.get(0).addEventListener("play", drawLoop, false);
            video.get(0).addEventListener("pause", drawPause, false);
            video.get(0).addEventListener("ended", drawPause, false);
        };

        const cleanup = () => {
            video.get(0).removeEventListener("loadeddata", draw);
            video.get(0).removeEventListener("seeked", draw);
            video.get(0).removeEventListener("play", drawLoop);
            video.get(0).removeEventListener("pause", drawPause);
            video.get(0).removeEventListener("ended", drawPause);
        };

        window.addEventListener("load", init);
        window.addEventListener("unload", cleanup);

        function togglePause() {
            if (video.prop("paused")) {
                video.get(0).play();
            } else {
                video.get(0).pause();
            }
        }

        video.get(0).addEventListener("play", function() {
            pauseIcon.css("display", "block");
            playIcon.css("display", "none");
            pauseIconCenter.css("display", "none");
            playIconCenter.css("display", "block");
            playbackCenter.show();
            playbackCenter.fadeOut(playBackCenterFadeAnimationTime);
        })

        video.get(0).addEventListener("pause", function() {
            pauseIcon.css("display", "none");
            playIcon.css("display", "block");
            pauseIconCenter.css("display", "block");
            playIconCenter.css('display', 'none');
            playbackCenter.show();
            playbackCenter.fadeOut(playBackCenterFadeAnimationTime);
        })

        function toggleFullScreen() {
            if (document.fullscreenElement) {
                document.exitFullscreen();
                fullscreenExitIcon.css("display", "none");
                fullscreenIcon.css("display", "block");
            } else if (document.webkitFullscreenElement) {
                // Need this to support Safari
                document.webkitExitFullscreen();
                fullscreenExitIcon.css("display", "none");
                fullscreenIcon.css("display", "block");
            } else if (videoContainer.get(0).webkitRequestFullscreen) {
                // Need this to support Safari
                videoContainer.get(0).webkitRequestFullscreen();
                fullscreenExitIcon.css("display", "block");
                fullscreenIcon.css("display", "none");
            } else {
                videoContainer.get(0).requestFullscreen();
                fullscreenExitIcon.css("display", "block");
                fullscreenIcon.css("display", "none");
            }
        }

        function toggleMute() {
            if (video.prop("muted") == false) {
                // On Mute
                changeVolume(0, true);
            } else if (video.prop("muted")) {
                // On Unmute
                if (zeroVolumeHandler == false) {
                    prevVolume = defaultVolume;
                }
                changeVolume(prevVolume);
                zeroVolumeHandler = false;
            }
        }

        function changeVolume(volume, muteBtn) {
            prevVolume = volumeSliderInput.prop("value");
            volumeSliderInput.prop("value", volume);
            video.prop("volume", volume / 100);
            if (video.prop("volume") > 0.5) {
                // On High Volume
                unmuteIcon.css("display", "none");
                muteIcon.css("display", "block");
                volumeHighIcon.css("display", "block");
                volumeLowIcon.css("display", "none");
                video.prop("muted", false);
            } else if (video.prop("volume") == 0) {
                // On Mute
                if (muteBtn) {
                    zeroVolumeHandler = true;
                } else {
                    zeroVolumeHandler = false;
                }
                unmuteIcon.css("display", "block");
                muteIcon.css("display", "none");
                video.prop("muted", true);
            } else {
                // On Low Volume
                unmuteIcon.css("display", "none");
                muteIcon.css("display", "block");
                volumeHighIcon.css("display", "none");
                volumeLowIcon.css("display", "block");
                video.prop("muted", false);
            }
            volumeSliderInput.css('background', `linear-gradient(to right, white ${volumeSliderInput.prop("value")}%, rgb(255, 255, 255, 0.3) ${volumeSliderInput.prop("value")}%)`);
        }

        function showVolumeSlider() {
            volumeSlider.css("display", "flex");
            volumeSlider.animate({
                width: "72px"
            }, volumeSliderAnimationTime);
        }

        function hideVolumeSlider() {
            volumeSlider.animate({
                width: 0
            }, volumeSliderAnimationTime, function() {
                volumeSlider.css("display", "none")
            });
        }

        function videoEnd() {
            pauseIcon.css("display", "none");
            playIcon.css("display", "block");
        }

        function secondsToHms(d) {
            d = Number(d);
            var h = Math.floor(d / 3600);
            var m = Math.floor(d % 3600 / 60);
            var s = Math.floor(d % 3600 % 60);

            h = h > 0 ? h > 9 ? h + ':' : '0' + h + ':' : "";
            m = m > 0 ? m > 9 ? m + ':' : '0' + m + ':' : "00" + ':';
            s = s > 0 ? s > 9 ? s : '0' + s : "00";

            display = h + m + s;
            return display;
        }

        updateTimestamp("00:00", secondsToHms(video.get(0).duration));

        video.get(0).addEventListener('timeupdate', function() {
            updateVideoTimeInput(this.currentTime);
            updateTimestamp(secondsToHms(this.currentTime), secondsToHms(this.duration));
        });

        function updateTimestamp(currentTime, duration) {
            timestamp.html(currentTime + ' / ' + duration);
        }

        function updateVideoTime(value) {
            video.get(0).currentTime = (value / 100) * video.get(0).duration;
            timestampSliderInput.css('background', `linear-gradient(to right, red ${timestampSliderInput.prop("value")}%, rgb(255, 255, 255, 0.3) ${timestampSliderInput.prop("value")}%)`);
        }

        function updateVideoTimeInput(value) {
            timestampSliderInput.get(0).value = (value / video.get(0).duration) * 100;
            timestampSliderInput.css('background', `linear-gradient(to right, red ${timestampSliderInput.prop("value")}%, rgb(255, 255, 255, 0.3) ${timestampSliderInput.prop("value")}%)`);
        }

        function toggleAmbientGlow() {
            if (ambientGlow == true) {
                ambientGlow = false;
                drawPause();
                $("#ambientGlowCanvas").fadeOut(600);
                ambientGlowDisabled.css("display", "block");
                ambientGlowEnabled.css("display", "none");
            }
            else {
                ambientGlow = true;
                ambientGlowDisabled.css("display", "none");
                ambientGlowEnabled.css("display", "block");
                if (!step) {
            drawLoop(); 
        }
        $("#ambientGlowCanvas").fadeIn(600);

            }
        }

        if (ambientGlow == false) {
                ambientGlowDisabled.css("display", "block");
                ambientGlowEnabled.css("display", "none");
            }
            else {
                ambientGlowDisabled.css("display", "none");
                ambientGlowEnabled.css("display", "block");
            }

        /*function showTooltip(e) {
            timestampFrameIndicator.get(0).innerHTML = secondsToHms(getTimeValue(e));
            timestampFrameIndicatorContainer.css("display", "flex");
        }

        timestampSliderInput.get(0).onmousemove = function(e) {
            let y = (e.offsetX - (timestampFrameIndicatorContainer.get(0).clientWidth / 2) + 10);
            let x = y + 'px';
            if (y < 15) {
                timestampFrameIndicatorContainer.get(0).style.left = "15px";
            } else {
                timestampFrameIndicatorContainer.get(0).style.left = x;
            }
            showTooltip(e);
            timestampSliderInput.css("height", "8px");
        }
        timestampSliderInput.get(0).onmouseleave = function(e) {
            timestampSliderInput.css("height", "7px");
            timestampFrameIndicatorContainer.css("display", "none");
        }           
        
        Buggy Feature */

        function getTimeValue(e) {
            let w = timestampSliderInput.get(0).clientWidth;
            let x = e.offsetX;
            let percents = x / w;
            let max = 100
            let videoTime = percents * max * video.get(0).duration / 100;
            return videoTime;
        }
    </script>
</body>

</html>