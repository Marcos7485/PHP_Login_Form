<div class="container hide" style="background-color: black;">

    <video width="100%" height="100%" id="jinx" controls autoplay muted>
        <source src="src//jinx.mp4" type="video/mp4">
        <source src="src//jinx.webm" type="video/webm">
        Tu navegador no soporta la etiqueta de video.
    </video>
    
</div>

<div class="container show" style="background-color: black;">
    
    <video width="100%" height="100%" id="jinx" controls autoplay muted>
        <source src="src//jinx_celular.mp4" type="video/mp4">
        <source src="src//jinx_celular.webm" type="video/webm">
        Tu navegador no soporta la etiqueta de video.
    </video>
    
</div>

<script>
    var video = document.getElementById("jinx");
    video.addEventListener('canplaythrough', function() {
        video.play();
    });
    video.addEventListener("ended", function() {
        window.location.href = "?a=system_start";
    });
</script>