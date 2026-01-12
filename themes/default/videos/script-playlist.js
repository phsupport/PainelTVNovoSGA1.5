document.addEventListener('DOMContentLoaded', function(){
  const video = document.getElementById('tvOlinda');
  if (!video) return;

  const sourceEls = Array.from(video.querySelectorAll('source'));
  const sources = sourceEls.map(s => s.getAttribute('src')).filter(Boolean);

  if (sources.length === 0) {
    const no = document.getElementById('noVideos');
    if (no) no.style.display = 'block';
    console.warn('Nenhum vídeo encontrado para reprodução.');
    return;
  }

  let idx = 0;
  // Start with the first source
  video.src = sources[idx];
  video.load();
  video.play().catch(() => {
    // autoplay may be blocked by browser; video is muted in markup so it should usually work
  });

  video.addEventListener('ended', () => {
    idx = (idx + 1) % sources.length;
    video.src = sources[idx];
    video.load();
    video.play();
  });

  // Optional: click to toggle pause/play
  video.addEventListener('click', () => {
    if (video.paused) video.play(); else video.pause();
  });
});