<?php

namespace App\Http\Controllers;

use App\StudMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getGame($game_name)
    {
        $path = storage_path('app/public/games/'.$game_name);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function html5_game($id)
    {
        if($id=="01"){
            $cost = 90;
            $title = "水果忍者";
            $script = "
            <link rel=\"stylesheet\" href=\"../games/fruit-ninja/images/index.css\">
            <div id=\"extra\"></div>
            <canvas id=\"view\" width=\"640\" height=\"480\"></canvas>
            <div id=\"desc\">
                <div style=\"text-align:center;clear:both;\">
                </div>
                <div id=\"browser\"></div>
            </div>
            <script src=\"../games/fruit-ninja/scripts/all.js\"></script>
            ";
        }
        if($id=="02") {
            $cost = 50;
            $title = "Flappy Bird";
            $script = "
            <style>
                #game_div, p {
                width: 400px;
                margin: auto;
                margin-top: 20px;
                }
            </style>

            <script type=\"text/javascript\" src=\"../games/flappy-bird/phaser.min.js\"></script>
            <script type=\"text/javascript\" src=\"../games/flappy-bird/main.js\"></script>
            <div style=\"text-align:center;clear:both\">
            <script src=\"/gg_bd_ad_720x90.js\" type=\"text/javascript\"></script>
            <script src=\"/follow.js\" type=\"text/javascript\"></script>
            </div>        
            <div id=\"game_div\"> </div>  
            <p>按「空白鍵開始」</p>
            ";
        }
        if($id=="03"){
            $cost = 80;
            $title = "太空戰機";
            $script = "
            <body onload=\"bodyLoaded();\">           
            <style type=\"text/css\">
            #dbg {
            font-family: \"Helvetica\", cursive, sans-serif;
            border: 1px solid black;
            width: 600;
            }
            body {
            background:#000;
            color:white;
            font-family: Arial,Helvetica,Sans-serif;
            }
            a {
            color: #009de9;
            outline: none;
            } 

            a:hover {
            text-decoration: none;
            }
           </style>
           <script type=\"text/javascript\" src=\"../games/fly/Sound.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Background.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Mouse.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Loader.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/FloatyText.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Keyboard.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Collision.js\"> </script>

           <script type=\"text/javascript\" src=\"../games/fly/AfterEffect.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/PeaShooter.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Laser.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/LevelDirector.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Sortie.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Enemy.js\"> </script>

           <script type=\"text/javascript\" src=\"../games/fly/Powerup.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Shot.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/EnemyShot.js\"> </script>
           <script type=\"text/javascript\" src=\"../games/fly/Ship.js\"> </script>

            <script type=\"text/javascript\">

              var g_canvas;
              var g_context;
              var g_soundsLoaded;
              var g_isChr;
              var g_onscreenControls;
              var g_paused;
              var g_renderInterval;
              var g_clockInterval;
        
              var g_totalItems;
              var g_itemsLoaded;
              //
              // thanks for viewing the code, feel free to reuse.
              // if you do, please link to my site!  thanks!
              //
              var g_background;
              var g_foreground;
        
              var g_ship;
              var g_gameState;
              var g_highScore;
        
              var g_powerups;
              var g_floatyText;
              var g_projectiles;
              var g_enemyProjectiles;
              var g_enemies;
              var g_afterEffects;
              var g_rainbow;
        
              var g_basicShotSound;
              var g_laserShotSound;
              var g_dinkSound;
              var g_smallExplodeSound;
              var g_bonusSound;
              var g_explodeSound;
              var g_artifact_chard_sound;
              var g_double_sound;
              var g_gem_sound;
              var g_gun_sound;
              var g_shot_sound;
              var g_speed_sound;
        
              var g_levelDirector;
              var g_shotsFired;
              var g_shotsRequired;
              var g_accuracy;
              var g_showAccuracy;
              var g_enemiesDestroyed;


      
              function main()
                {
                 var level_1_loop = document.getElementById(\"level_1_loop\");
                 var bossLoop = document.getElementById(\"boss_loop\");
        
                 //dbg(\"engine = \" + navigator.userAgent, false);
                 g_rainbow = new Array(\"yellow\", \"orange\", \"white\", \"red\");
        
                 document.addEventListener('keydown', keyDown, false);
                 document.addEventListener('keyup', keyUp, false);
        
                 if ( g_basicShotSound == null )
                 {
        
                    g_basicShotSound = new Sound(\"basic_shot\",5);
                    g_laserShotSound = new Sound(\"laser\",5);
                    g_smallExplodeSound = new Sound(\"small_explode\",5);
                    g_bonusSound = new Sound(\"bonus_sound\",4);
                    g_explodeSound = new Sound(\"explode\", 3);
        
                    g_artifact_chard_sound = new Sound(\"artifact_chard_sound\", 2);
                    g_double_sound = new Sound(\"double_sound\", 2);
                    g_gem_sound = new Sound(\"gem_sound\", 4);
                    g_gun_sound = new Sound(\"gun_sound\", 2);
                    g_shot_sound = new Sound(\"shot_sound\", 3);
                    g_speed_sound = new Sound(\"speed_sound\", 3);
                 }
        
                 g_highScore = 0;
                 g_gameState = \"setup\";
                 g_levelDirector = new LevelDirector();

         
                 g_levelDirector.startLevel();
              }
      
              function lookupSound(name)
              {
                 if ( name == \"double_sound\" )
                    return g_double_sound;
                 else if ( name == \"gem_sound\" )
                    return g_gem_sound;
                 else if ( name == \"gun_sound\" )
                    return g_gun_sound;
                 else if ( name == \"shot_sound\" )
                    return g_shot_sound;
                 else if ( name == \"speed_sound\" )
                    return g_speed_sound;
        
                 dbg(\"Failed sound lookup: \" + name, false);
        
                 return null;
              }
      
              function clockLoop()
              {
                 if ( g_paused )
                    return;
        
                 g_levelDirector.myClock += 100;
                 //dbg(\"Clock = \" +  g_levelDirector.myClock, false);
        
                 g_levelDirector.launchSorties();
                 g_levelDirector.gameEvents();
              }
              
              function renderLoop()
              { 
                 if ( g_paused )
                    return;
        
                 g_background.render();
                 g_ship.render();
        
                 var remainingPowerups = new Array();
                 for (var i = 0; i < g_powerups.length; ++i)
                 {
                    if (g_powerups[i].render())
                    {
                       remainingPowerups.push(g_powerups[i]);
                    }
                    else delete g_powerups[i];
                 }
                 delete g_powerups;
                 g_powerups = remainingPowerups;
        
                 var remainingText = new Array();
                 for (var i = 0; i < g_floatyText.length; ++i)
                 {
                    if (g_floatyText[i].render())
                    {
                       remainingText.push(g_floatyText[i]);
                    }
                    else delete g_floatyText[i];
                 }
                 delete g_floatyText;
                 g_floatyText = remainingText;
        
                 var remainingEnemies = new Array();
                 for (var i = 0; i < g_enemies.length; ++i)
                 {
                    if (g_enemies[i].render())
                    {
                       remainingEnemies.push(g_enemies[i]);
                    }
                    else delete g_enemies[i];
                 }
                 delete g_enemies;
                 g_enemies = remainingEnemies;
        
                 var remainingProjectiles = new Array();
                 for (var i = 0; i < g_projectiles.length; ++i)
                 {
                    if (g_projectiles[i].render())
                    {
                       remainingProjectiles.push(g_projectiles[i]);
                    }
                    else delete g_projectiles[i];
                 }
                 delete g_projectiles;
                 g_projectiles = remainingProjectiles;
        
                 var remainingEnemyProjectiles = new Array();
                 for (var i = 0; i < g_enemyProjectiles.length; ++i)
                 {
                    if (g_enemyProjectiles[i].render())
                    {
                       remainingEnemyProjectiles.push(g_enemyProjectiles[i]);
                    }
                    else delete g_enemyProjectiles[i];
                 }
                 delete g_enemyProjectiles;
                 g_enemyProjectiles = remainingEnemyProjectiles;
        
                 var remainingAfterEffects = new Array();
                 for (var i = 0; i < g_afterEffects.length; ++i)
                 {
                    if (g_afterEffects[i].render())
                    {
                       remainingAfterEffects.push(g_afterEffects[i]);
                    }
                    else delete g_afterEffects[i];
                 }
                 delete g_afterEffects;
                 g_afterEffects = remainingAfterEffects;
        
                 g_levelDirector.renderSpecialText();
        
                 g_foreground.render();
        
                 if ( g_onscreenControls )
                 {
                    var ox = 40;
                    var oy = 300;
                    var ow = 30;
        
                    var tx = 8;
                    var ty = 22;
        
                    g_context.fillStyle = \"yellow\";
                    g_context.strokeStyle = \"yellow\";
                    g_context.strokeRect(ox,oy,ow,ow);
                    g_context.strokeRect(ox-35,oy+35,ow,ow);
                    g_context.strokeRect(ox+35,oy+35,ow,ow);
                    g_context.strokeRect(ox,oy+70,ow,ow);
                    g_context.strokeRect(ox+520,oy+35,ow,ow);
                    g_context.strokeRect(ox+270,oy+35,ow,ow);
        
                    g_context.fillText(\"U\",ox+tx,oy+ty);
                    g_context.fillText(\"L\", ox-35+tx,oy+35+ty);
                    g_context.fillText(\"R\", ox+35+tx,oy+35+ty);
                    g_context.fillText(\"D\", ox+tx,oy+70+ty);
                    g_context.fillText(\"Z\",ox+520+tx,oy+35+ty);
                    g_context.fillText(\"P\",ox+270+tx,oy+35+ty);
                 }

                    g_ship.renderPowers();
                }
          
                      function start_level_1_loop(terminate)
                      {
                         var level_1_loop = document.getElementById(\"level_1_loop\");
                
                         if ( terminate != undefined )
                         {
                            if ( terminate.toString() == \"boss\" )
                            {
                               level_1_loop.volume = 0;
                               level_1_loop.removeEventListener(\"ended\", l1_loopit, true);
                               return;
                            }
                            else if ( terminate.toString() == \"gameover\" )
                            {
                               level_1_loop.removeEventListener(\"ended\", l1_loopit, true);
                               level_1_loop.pause();
                               return;
                            }
                         }
                
                         l1_loopit();
                      }
                
                      function l1_loopit()
                      {
                         var level_1_loop = document.getElementById(\"level_1_loop\");
                         level_1_loop.volume = 1;
                         level_1_loop.play();
                         level_1_loop.addEventListener(\"ended\", l1_loopit, true);
                      }
                
                      function startBossLoop(terminate)
                      {
                         var bossLoop = document.getElementById(\"boss_loop\");
                
                         if ( terminate != undefined && terminate.toString() == \"end_boss\")
                         {
                            bossLoop.volume = 0;
                            bossLoop.removeEventListener(\"ended\", bos_loopit, true);
                            return;
                         }
                
                         bos_loopit();
                      }
                      function bos_loopit()
                      {
                         var bossLoop = document.getElementById(\"boss_loop\");
                         bossLoop.volume = 1;
                         bossLoop.play();
                         bossLoop.addEventListener(\"ended\", bos_loopit, true);
                      }
                
                
                      function startLevel2Loop(terminate)
                      {
                         var penguinLoop = document.getElementById(\"level_2_loop\");
                
                         if ( terminate != undefined && terminate.toString() == \"terminate\")
                         {
                            penguinLoop.volume = 0;
                            penguinLoop.removeEventListener(\"ended\", l2_loopit, true);
                            return;
                         }
                         l2_loopit();
                      }
                
                      function l2_loopit()
                      {
                         var penguinLoop = document.getElementById(\"level_2_loop\");
                         penguinLoop.volume = 1;
                         penguinLoop.play();
                         penguinLoop.addEventListener(\"ended\", l2_loopit, true);
                      }
        
                      
                      function dbg(str, append)
                      {
                         var dbgObj = document.getElementById(\"dbg\");
                         dbgObj.innerHTML = append? (dbgObj.innerHTML + str): str;
                      }
                      
                      function loadGameSounds()
                      {
                          var fileref=document.createElement('script')
                          fileref.setAttribute(\"type\",\"text/javascript\")
                          fileref.setAttribute(\"src\", \"http://dougx.net/plunder/GameSounds.php\")
                
                          var agent = navigator.userAgent;
                          if ( agent.indexOf(\"MSIE\") != -1 )
                          {
                             //
                             // IE9 does not support OGG so we have to load a special
                             // version of the file that has MP3 encoded sound
                             //
                             fileref.setAttribute(\"src\", \"GameSoundsIE9.php\")
                          }
                
                      fileref.onload = function() { g_soundsLoaded = true; }
                   
                          document.getElementsByTagName(\"head\")[0].appendChild(fileref)
                      }
                
                      function pause()
                      {
                         if (g_paused == null )
                            g_paused = false;
                
                         g_paused = !g_paused;
                
                         if ( g_paused )
                            dbg(\"Game Paused\", false);
                         else
                            dbg(\"\", false);
                      }               
            </script>
        
            <style type=\"text/css\">
              canvas { border: 1px solid black; }
            </style>               
        
          <table cellpadding=\"0\" border=\"0\" cellspacing=\"0\" frame=\"void\" align=\"center\">
          <tr class='text-danger'><td>按方向鍵控制；按Z發射；按P暫停</td></tr>
          <tr> 
            <td valign=\"top\">
        
              <canvas align=\"left\" id=\"theCanvas\" width=\"600\" height=\"400\">                           
              </canvas>
            </td>
           <tr>
           </table>           
           
        
           <!--- put all of the game objects into the document which makes writing
                 the load screen pretty trivial; a really simple loader.  as items
                 load they call the itemLoaded() function which updates the load screen.
                 Just remember to make this div small and hidden. --->
        
              
           <div id=\"hidden\" style=\"visibility:hidden; width:1px; height:1px; overflow:hidden\">
        
            <img    id=\"splash_screen\" 
                    src=\"../games/fly/splash_screen.jpg\" 
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"loading\" 
                    src=\"../games/fly/loading.png\" 
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"title\" 
                    src=\"../games/fly/title.png\" 
                    onload=\"itemLoaded(this);\">
        
        <!--[if IE]>
            <audio  id=\"loading_music\" 
                    src=\"../games/fly/loading_music.mp3\"
                    autoplay=\"true\" >
            </audio>
        
            <audio  id=\"level_1_preloop\" 
                    src=\"../games/fly/level_1_preloop.mp3\" 
                    preload='true'>
             </audio>
        
            <audio  id=\"level_1_loop\" 
                    src=\"../games/fly/level_1_loop.mp3\" 
                    preload='true'>
            </audio>
        
            <audio  id=\"level_2_loop\" 
                    src=\"../games/fly/level_2_loop.mp3\" 
                    preload='true'>
            </audio>
        
            <audio  id=\"level_passed\" 
                    src=\"../games/fly/level_passed.mp3\" 
                    preload='true'>
            </audio>
        
            <audio  id=\"boss_loop\" 
                    src=\"../games/fly/boss_loop.mp3\" 
                    preload='true'>
            </audio>
        
        <![endif]-->
        
        <!--[if !IE]> <-->
            <audio  id=\"loading_music\" 
                    src=\"../games/fly/loading_music.ogg\"
                    autoplay=\"autoplay\" >
        
            </audio>
        
            <audio  id=\"level_1_preloop\" 
                    src=\"../games/fly/level_1_preloop.ogg\" 
                    autobuffer='true'>
            </audio>
        
            <audio  id=\"level_1_loop\" 
                    src=\"../games/fly/level_1_loop.ogg\" 
                    autobuffer='true'>
            </audio>
        
            <audio  id=\"level_2_loop\" 
                    src=\"../games/fly/level_2_loop.ogg\" 
                    autobuffer='true'>
            </audio>
        
            <audio  id=\"level_passed\" 
                    src=\"../games/fly/level_passed.ogg\" 
                    autobuffer='true'>
            </audio>
        
            <audio  id=\"boss_loop\" 
                    src=\"../games/fly/boss_loop.ogg\" 
                    autobuffer='true'>
            </audio>
        <!--> <![endif]-->
        
            <img    id=\"starfield\"
                    src=\"../games/fly/starfield.jpg\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"foreground\"
                    src=\"../games/fly/foreground.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_center\"
                    src=\"../games/fly/ship_center.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_up_1\"
                    src=\"../games/fly/ship_up_1.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_up_2\"
                    src=\"../games/fly/ship_up_2.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_up_3\"
                    src=\"../games/fly/ship_up_3.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_down_1\"
                    src=\"../games/fly/ship_down_1.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_down_2\"
                    src=\"../games/fly/ship_down_2.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_down_3\"
                    src=\"../games/fly/ship_down_3.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_icon\"
                    src=\"../games/fly/ship_icon.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"foreground_light\"
                    src=\"../games/fly/foreground_light.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"sky\"
                    src=\"../games/fly/sky.jpg\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"speed_image\"
                    src=\"../games/fly/speed_image.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"gun_image\"
                    src=\"../games/fly/gun_image.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"shot_image\"
                    src=\"../games/fly/shot_image.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"double_image\"
                    src=\"../games/fly/double_image.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"gem_image\"
                    src=\"../games/fly/gem_image.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small\"
                    src=\"../games/fly/enemy_small.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small_special\"
                    src=\"../games/fly/enemy_small_special.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small_2\"
                    src=\"../games/fly/enemy_small_2.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small_2_special\"
                    src=\"../games/fly/enemy_small_2_special.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small_3\"
                    src=\"../games/fly/enemy_small_3.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small_4\"
                    src=\"../games/fly/enemy_small_4.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_small_4_special\"
                    src=\"../games/fly/enemy_small_4_special.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_artifact\"
                    src=\"../games/fly/enemy_artifact.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"enemy_artifact_2\"
                    src=\"../games/fly/enemy_artifact_2.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_1\"
                    src=\"../games/fly/ship_death_1.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_2\"
                    src=\"../games/fly/ship_death_2.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_3\"
                    src=\"../games/fly/ship_death_3.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_4\"
                    src=\"../games/fly/ship_death_4.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_5\"
                    src=\"../games/fly/ship_death_5.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_6\"
                    src=\"../games/fly/ship_death_6.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"ship_death_7\"
                    src=\"../games/fly/ship_death_7.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_1\"
                    src=\"../games/fly/splode_1.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_2\"
                    src=\"../games/fly/splode_2.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_3\"
                    src=\"../games/fly/splode_3.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_4\"
                    src=\"../games/fly/splode_4.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_5\"
                    src=\"../games/fly/splode_5.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_6\"
                    src=\"../games/fly/splode_6.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"splode_7\"
                    src=\"../games/fly/splode_7.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"artifact_chard_image\"
                    src=\"../games/fly/artifact_chard.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"artifact_skull_image\"
                    src=\"../games/fly/artifact_skull.png\"
                    onload=\"itemLoaded(this);\">
        
            <img    id=\"command_ship\"
                    src=\"../games/fly/command_ship.png\"
                    onload=\"itemLoaded(this);\">
        
        
           </div>          
            ";
        }

        if($id=="04"){
            $cost = 60;
            $title = "Flappy Text";
            $script = "
            <link rel=\"stylesheet\" href=\"../games/flappy-text/css/style.css\" media=\"screen\" type=\"text/css\" />
            <div id=\"canvasContainer\"></div>
            <span id=\"textInputSpan\">
             請輸入文字 (最多 8 個) :
            <input id=\"textInput\" maxlength=\"10\" type=\"text\" width=\"150\" />
            <button onclick=\"changeText()\">GO!</button>
            </span>
            
            <div style=\"text-align:center;clear:both\">            
            </div>
            <script src=\"../games/flappy-text/js/index.js\"></script>            
            
            ";
        }

        $total_money = get_stud_total_money();
        if($total_money < $cost){
            $words = "你的資訊幣不夠喔！你可以靠「作業得分」、「打字」、別人「按讚」來增加喔！";
            return view('layouts.error',compact('words'));
        }

        $att2['user_id'] = auth()->user()->id;
        $att2['thing'] = "gaming";
        $att2['thing_id'] = "01";
        $att2['stud_money'] = "-".$cost;
        $att2['description'] = "玩「水果忍者」扣了點數！";

        StudMoney::create($att2);


        $data =[
            'title'=>$title,
            'script'=>$script
        ];
        return view('games.html5_game',$data);
    }
}
