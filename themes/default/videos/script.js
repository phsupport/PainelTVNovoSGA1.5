const video = document.getElementById('tvOlinda');
const sources = Array.from(document.querySelectorAll('#tvOlinda source')).map(s => s.src);
let idx = 0;
if (sources.length) {
  video.src = sources[0];
  video.addEventListener('ended', () => {
    idx = (idx + 1) % sources.length;
    video.src = sources[idx];
    video.play();
  });
}