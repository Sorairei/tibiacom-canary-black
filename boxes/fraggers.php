<?php
if (!defined('INITIALIZED')) {
    exit;
}

$stmt = $SQL->prepare('
    SELECT TRIM(`killed_by`) AS `name`, COUNT(`killed_by`) AS `frags`
    FROM `player_deaths`
    WHERE `is_player` = 1 AND `killed_by` != ""
    GROUP BY `killed_by`
    ORDER BY `frags` DESC
    LIMIT 5
');
$stmt->execute();
$topFraggers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
  .fraggers_widget {
    width: 180px;
    height: auto;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    font-family: Verdana, sans-serif;
  }

  .fraggers_header {
    height: 45px;
        width: 180px;
        background-image: url('templates/tibiacom/images/themeboxes/box_top.png');
        font-family: Verdana;
        font-weight: bold;
        color: #d5c3af;
        line-height: 65px;
  }

  .fraggers_content {
    width: 160px;
    background-image: url('templates/tibiacom/images/themeboxes/box_bg.png');
    background-size: cover;
    background-position: center;
    padding: 5px 10px 13px 10px; /* Adjusted padding */
    display: flex;
    flex-direction: column;
    gap: 5px;
    align-items: flex-start;
}

  .fraggers_bottom {
    height: 30px;
    width: 180px;
    background-image: url('templates/tibiacom/images/themeboxes/box_bottom.png');
    background-size: cover;
    margin-top: -20px;
  }

@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.fragger_entry {
  width: 90%;
  display: flex;
  justify-content: space-between;
  font-size: 11px;
  color: #ffcc33;
  background: linear-gradient(to right, #ff0000, #ff6b81, #ff9aa2, #ffb380); /* Rojo, rubor, rosa, caramelo */
  background-size: 200% 200%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientMove 3s infinite linear;
}

@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.fragger_entry a {
  color: #ffcc33;
  text-decoration: none;
  padding-left: 5px;
  background: linear-gradient(to right, red, orange);
  background-size: 200% 200%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: gradientMove 3s infinite linear;
  display: inline-block;
}

.fragger_entry a:hover {
  color: #ffffff;
}

.fragger_entry a::before {
  content: " 💀"; /* Emoji de calavera */
  font-size: 12px; /* Ajusta el tamaño según necesites */
  margin-left: 5px; /* Espacio entre el nombre y la calavera */
}

</style>

<div class="fraggers_widget">
  <div class="fraggers_header">Top Fraggers</div>
  <div class="fraggers_content">
    <?php
    if (empty($topFraggers)) {
        echo '<div class="fragger_entry">No data found.</div>';
    } else {
        foreach ($topFraggers as $fragger) {
    $name = trim($fragger['name']); // Extra trim in PHP for safety
    echo '
    <div class="fragger_entry">
        <a href="?subtopic=characters&name=' . urlencode($name) . '">' . htmlspecialchars($name) . '</a>
        <span>' . $fragger['frags'] . '</span>
    </div>';
}
    }
    ?>
  </div>
  <div class="fraggers_bottom"></div>
</div>

