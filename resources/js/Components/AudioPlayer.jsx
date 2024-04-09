import React from "react";
import Pause from "./Icons/Pause";
import Play from "./Icons/Play";
import Restart from "./Icons/Restart";
import Download from "./Icons/Download";

const AudioPlayer = ({ audioSrc }) => {
   const audioRef = React.useRef(null);
   const progressBarRef = React.useRef(null);
   const currentTimeRef = React.useRef(null);
   const totalDurationRef = React.useRef(null);
   const playbackSpeedRef = React.useRef(null);

   const [isPlaying, setPlaying] = React.useState(false);

   const handlePlayPause = () => {
      if (audioRef.current.paused) {
         audioRef.current.play();
         setPlaying(true);
      } else {
         audioRef.current.pause();
         setPlaying(false);
      }
   };

   const handleStop = () => {
      audioRef.current.pause();
      audioRef.current.currentTime = 0;
      setPlaying(false);
   };

   const handleDownload = () => {
      const link = document.createElement("a");
      link.href = audioSrc;
      link.download = "audio.mp3";
      link.click();
   };

   const handlePlaybackSpeedChange = () => {
      const speed = parseFloat(playbackSpeedRef.current.value);
      audioRef.current.playbackRate = speed;
   };

   React.useEffect(() => {
      const audioPlayer = audioRef.current;
      const progressBar = progressBarRef.current;
      const currentTime = currentTimeRef.current;

      audioPlayer.addEventListener("timeupdate", () => {
         const progress =
            (audioPlayer.currentTime / audioPlayer.duration) * 100;
         progressBar.style.width = `${progress}%`;

         const minutes = Math.floor(audioPlayer.currentTime / 60);
         const seconds = Math.floor(audioPlayer.currentTime % 60);
         currentTime.textContent = `${minutes < 10 ? "0" : ""}${minutes}:${
            seconds < 10 ? "0" : ""
         }${seconds}`;
      });

      audioPlayer.addEventListener("loadedmetadata", () => {
         const minutes = Math.floor(audioPlayer.duration / 60);
         const seconds = Math.floor(audioPlayer.duration % 60);
         totalDurationRef.current.textContent = `${
            minutes < 10 ? "0" : ""
         }${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
      });
   }, []);

   return (
      <div className="audio-player w-full p-3 bg-gray-100 rounded flex items-center">
         <div className="controls flex items-center mr-4">
            {isPlaying ? (
               <Pause
                  className="w-4 h-4 text-gray-400 hover:text-primary-400 cursor-pointer"
                  onClick={handlePlayPause}
               />
            ) : (
               <Play
                  className="w-4 h-4 text-gray-400 hover:text-primary-400 cursor-pointer"
                  onClick={handlePlayPause}
               />
            )}
            <Restart
               className="ml-3 w-4 h-4 text-gray-400 hover:text-primary-400 cursor-pointer"
               onClick={handleStop}
            />
         </div>
         <div className="time text-sm text-gray-700 w-[100px]">
            <span ref={currentTimeRef}>00:00</span> /{" "}
            <span ref={totalDurationRef}>00:00</span>
         </div>
         <div className="progress-bar flex-grow h-1 bg-gray-400 rounded overflow-hidden">
            <div
               ref={progressBarRef}
               className="progress w-0 h-full bg-primary-500"
            ></div>
         </div>
         <div className="controls">
            <Download
               className="ml-3 w-5 h-5 text-gray-400 hover:text-primary-400 cursor-pointer"
               onClick={handleDownload}
            />
         </div>
         <div className="controls ml-3">
            <select
               ref={playbackSpeedRef}
               className="bg-gray-200 w-12 rounded cursor-pointer outline-0"
               onChange={handlePlaybackSpeedChange}
            >
               <option value="1">1x</option>
               <option value="1.5">1.5x</option>
               <option value="2">2x</option>
            </select>
         </div>
         <audio ref={audioRef} src={audioSrc}></audio>
      </div>
   );
};

export default AudioPlayer;
