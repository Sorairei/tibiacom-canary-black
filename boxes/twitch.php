<?php
if (!defined('INITIALIZED')) {
    exit;
}
?>

<style>
.twitch {
    width: 180px;
    height: auto;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    font-family: Verdana, sans-serif;
  }
    .twitch_header{
        height: 45px;
        width: 180px;
        background-image: url('templates/tibiacom/images/themeboxes/box_top.png');
        font-family: Verdana;
        font-weight: bold;
        color: #d5c3af;
        line-height: 65px;
    }
    .twitch_bottom{
        height: 30px;
        width: 180px;
        margin-top: -20px;
        background-image: url('templates/tibiacom/images/themeboxes/box_bottom.png');
    }
    .twitch_content{
        padding: 0px 10px;
        width: 160px;
        height: 103px;
        background-image: url('templates/tibiacom/images/themeboxes/box_bg.png');
        display: grid;
        justify-content: center;
        align-items: center;
    }
    .twitch_text{
        margin-left: 45px;
        font-family: Verdana;
        color: #f1c232;
        text-align: left;
    }

  .twitch_iframe {
    width: 160px;
    height: 94px;
    border: none;
  }
</style>

<div class="twitch_widget">
  <div class="twitch_header">Live Stream</div>
  <div class="twitch_content">
    <iframe
      class="twitch_iframe"
      src="https://player.twitch.tv/?channel=lunacoresOT&parent=<?php echo $_SERVER['HTTP_HOST']; ?>"
      allowfullscreen>
    </iframe>
  </div>
  <div class="twitch_bottom"></div>
</div>

