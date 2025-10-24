<?php
// Consulta para obter apenas uma guilda ativa
$stmt = $SQL->prepare('
    SELECT g.id, g.name, g.logo_name, cw.throne_points, cw.active
    FROM castle_war cw
    JOIN guilds g ON cw.guild_id = g.id
    WHERE cw.active = 1
    ORDER BY cw.id ASC
    LIMIT 1
');
$stmt->execute();
$consulta = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style type="text/css">
.castle_war_widget {
    width: 180px;
    height: auto;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    font-family: Verdana, sans-serif;
  }
    .castle_war_header{
        height: 45px;
        width: 180px;
        background-image: url('templates/tibiacom/images/themeboxes/box_top.png');
        font-family: Verdana;
        font-weight: bold;
        color: #d5c3af;
        line-height: 65px;
    }
    .castle_war_bottom{
        height: 30px;
        width: 180px;
        margin-top: -20px;
        background-image: url('templates/tibiacom/images/themeboxes/box_bottom.png');
    }
    .castle_war_content{
        padding: 0px 10px;
        width: 160px;
        height: 108px;
        background-image: url('templates/tibiacom/images/themeboxes/box_bg.png');
        display: grid;
        justify-content: center;
        align-items: center;
    }
  .guild_container {
    text-align: center;
    width: 100%;
    color: #ffcc33;
  }
  .guild_logo {
    width: 64px;
    height: 64px;
    margin-bottom: 6px;
	margin-top: 2px;
  }
  .guild_name {
    font-family: Verdana;
    font-size: 14px;
    color: #CC5500;
    text-decoration: none;
	text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Sombra negra sutil */
    background-size: 400% 400%;
    width: 135px;
    height: 20px;
    line-height: 20px;
    margin: 0 auto;
    background-image: linear-gradient(45deg, #00ff00, #00ccff, #0000ff);
    animation: gradientAnimation 3s infinite alternate;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
}

@keyframes gradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

  .guild_info {
    font-family: Verdana;
    font-size: 11px;
    color: #bcbcbc;
    margin-top: 1px;
  }
  /* Estilizando o link para remover o traço azul */
  .guild_container a {
    text-decoration: none; /* Remove o sublinhado padrão */
    color: inherit; /* Herda a cor do elemento pai (guild_name ou guild_info) */
  }
  .guild_container a:link,
  .guild_container a:visited,
  .guild_container a:hover,
  .guild_container a:active {
    text-decoration: none; /* Remove o sublinhado em todos os estados */
    color: inherit; /* Mantém a cor original */
  }
  .guild_container a:hover {
    color: #ffffff; /* Opcional: muda a cor ao passar o mouse */
  }
  


</style>

<div class="castle_war">
  <div class="castle_war_header">Castle War</div>
  <div class="castle_war_content">
    <?php
    if (empty($consulta)) {
      echo '<div class="guild_container">No se encontraron gremios activos.</div>';
    } else {
      $guild = $consulta[0];
      $logo = file_exists("images/guilds/" . $guild['logo_name']) ? $guild['logo_name'] : 'default.gif';
      echo '
      <div class="guild_container">
        <a href="/?guilds/' . htmlspecialchars($guild['name']) . '">
          <img class="guild_logo" src="/images/guilds/' . htmlspecialchars($logo) . '" alt="' . htmlspecialchars($guild['name']) . '" width="64" height="64" border="0"/>
          <div class="guild_name">' . htmlspecialchars($guild['name']) . '</div>
          <div class="guild_info">Puntos: ' . htmlspecialchars($guild['throne_points']) . '</div>
        </a>
      </div>';
    }
    ?>
  </div>
  <div class="castle_war_bottom"></div>
</div>