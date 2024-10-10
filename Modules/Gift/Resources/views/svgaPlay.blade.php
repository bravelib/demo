<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Svga 播放器</title>
    <script src="https://cdn.jsdelivr.net/npm/svgaplayerweb@2.3.1/build/svga.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/howler@2.0.15/dist/howler.core.min.js"></script>
    <script src="https://s1.yy.com/ued_web_static/lib/jszip/3.1.4/??jszip.min.js,jszip-utils.min.js"
            charset="utf-8"></script>
</head>
<body>
<div id="demoCanvas" style=""></div>

</body>
<script>
    var player = new SVGA.Player('#demoCanvas');
    var parser = new SVGA.Parser('#demoCanvas'); // 如果你需要支持 IE6+，那么必须把同样的选择器传给 Parser。
    parser.load('{{$svgaUrl}}', function (videoItem) {
        player.setVideoItem(videoItem);
        player.startAnimation();
        player.setImage('https://cdn.waoudianyin.com/images/2022/11/14/fd24eee5fb4b789e4dafe2bcc62fdc7b.png', 'avatar_left');
        player.setImage('https://cdn.waoudianyin.com/images/2022/10/16/42ca81c45dd986f657609f053084de11.png', 'avatar_right');
        player.setText('nickname_left', 'nickname_left');
        player.setText('nickname_right', 'nickname_right');
    })
</script>
</html>
