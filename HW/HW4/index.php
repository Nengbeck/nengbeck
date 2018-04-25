<!DOCTYPE html>
<html>
	<head>
		<title>SPACE INVADERS</title>
		<script type="text/javascript">
			var gameScreen;
			var output;
			
			///////////////////////////////
			var backGroundTrack;
			var bulletSound;
			var death;
			var enemyDeath;
			var powerUpSound;
			///////////////////////////////
			///////////////////////////////
			var bullets;
			///////////////////////////////
			///////////////////////////////
			var currentCount = 0;
			var autofire = false;
			var autofireCount = 0;
			///////////////////////////////
			
			var ship;
			var enemies = new Array();
			var orbs = new Array();
			
			var autofire = false;
			var autoFireCount = 0;
			
			var gameTimer;

			var leftArrowDown = false;
			var rightArrowDown = false;

			var bg1,bg2;
			const BG_SPEED = 4;
			
			const GS_WIDTH = 800;
			const GS_HEIGHT = 600;

			function init(){
				backGroundTrack = new sound("brazilsamba.mp3");
				backGroundTrack.play();
				
			    powerUpSound = new sound("powerUP.mp3");;
			    bulletSound = new sound("bullet.mp3");
			    death = new sound("death.mp3");;
			    enemyDeath = new sound("enemyDeath.mp3");
			    
			    
			    
				gameScreen = document.getElementById('gameScreen');
				gameScreen.style.width = GS_WIDTH + 'px';
				gameScreen.style.height = GS_HEIGHT + 'px';
				
				bg1 = document.createElement('IMG');
				bg1.className = 'gameObject';
				bg1.src = 'bg.jpg';
				bg1.style.width = '800px';
				bg1.style.height = '1422px';
				bg1.style.left = '0px';
				bg1.style.top = '0px';
				gameScreen.appendChild(bg1);
				
				bg2 = document.createElement('IMG');
				bg2.className = 'gameObject';
				bg2.src = 'bg.jpg';
				bg2.style.width = '800px';
				bg2.style.height = '1422px';
				bg2.style.left = '0px';
				bg2.style.top = '-1422px';
				gameScreen.appendChild(bg2);
				
				bullets = document.createElement('DIV');
				bullets.className = 'gameObject';
				bullets.style.width = gameScreen.style.width;
				bullets.style.height = gameScreen.style.height;
				bullets.style.left = '0px';
				bullets.style.top = '0px';
				gameScreen.appendChild(bullets);
				
				output = document.getElementById('output');

				ship = document.createElement('IMG');
				ship.src = 'ship.gif';
				ship.className = 'gameObject';
				ship.style.width = '32px';
				ship.style.height = '32px';
				ship.style.top = '500px';
				ship.style.left = '366px';

				gameScreen.appendChild(ship);
				
				for(var i = 0; i < 10; i++)
				{
					var enemy = new Image();
					enemy.className = 'gameObject';
					enemy.style.width = '32px';
					enemy.style.height = '32px';
					enemy.src = 'enemyShip.gif';
					gameScreen.appendChild(enemy);
					placeEnemyShip(enemy);
					enemies[i] = enemy;
				}
				
				for(var i=0; i<1; i++){
					var orb = new Image();
					orb.className = 'gameObject';
					orb.style.width = '32px';
					orb.style.height = '32px';
					orb.src = 'blueOrb.png';
					gameScreen.appendChild(orb);
					placeBlueOrb(orb);
					orbs[i] = orb;
				}
	
				gameTimer = setInterval(gameloop, 50);
			}

			function placeEnemyShip(e){
				e.speed = Math.floor(Math.random()*10) + 6;
				
				var maxX = GS_WIDTH - parseInt(e.style.width);
				var newX = Math.floor(Math.random()*maxX);
				e.style.left = newX + 'px';
				
				var newY = Math.floor(Math.random()*600) - 1000;
				e.style.top = newY + 'px';
			}
			
			function placeBlueOrb(o){
			
				o.speed = 4;
				
				var maxX = GS_WIDTH - parseInt(o.style.width);
				var newX = Math.floor(Math.random()*maxX);
				o.style.left = newX + 'px';
				
				var newY = Math.floor(Math.random()*600) - 1000;
				o.style.top = newY + 'px';
			}
			
			function explode(obj){
				var explosion = document.createElement('IMG');
				explosion.src = 'explosion.gif?x=' + Date.now();
				explosion.className = 'gameObject';
				explosion.style.width = obj.style.width;
				explosion.style.height = obj.style.height;
				explosion.style.left = obj.style.left;
				explosion.style.top = obj.style.top;
				gameScreen.appendChild(explosion);
				enemyDeath.play();
			}
			
			function sound(src) {
			    this.sound = document.createElement("audio");
			    this.sound.src = src;
			    this.sound.setAttribute("preload", "auto");
			    this.sound.setAttribute("controls", "none");
			    this.sound.style.display = "none";
			    document.body.appendChild(this.sound);
			    this.play = function(){
			        this.sound.play();
			    }
			    this.stop = function(){
			        this.sound.pause();
			    }
			}
			
			function gameloop(){
				
				backGroundTrack.play();
				if(autofire){
					currentCount += 1;
					if(currentCount % 2 == 0) {
						fire();
						autofireCount += 1;
						if(autofireCount > 80) {
						autofire = false;
						autofireCount = 0;
						}
					}
				}
				
				var bgY = parseInt(bg1.style.top) + BG_SPEED;
				if(bgY > GS_HEIGHT)
				{
					bg1.style.top = -1 * parseInt(bg1.style.height) + 'px';
				}
				else bg1.style.top = bgY + 'px';
				
				bgY = parseInt(bg2.style.top) + BG_SPEED;
				if(bgY > GS_HEIGHT)
				{
					bg2.style.top = -1 * parseInt(bg2.style.height) + 'px';
				}
				else bg2.style.top = bgY + 'px';
				
				
				if(leftArrowDown){
					var newX = parseInt(ship.style.left);
					if(newX > 0) ship.style.left = newX - 20 + 'px';
					else ship.style.left = '0px';
				}

				if(rightArrowDown){
					var newX = parseInt(ship.style.left);
					var maxX = GS_WIDTH - parseInt(ship.style.width);
					if(newX <  maxX) ship.style.left = newX + 20 + 'px';
					else ship.style.left = maxX + 'px';
				}
				
				var b = bullets.children;
				for(var i=0; i<b.length;i++){
					var newY = parseInt(b[i].style.top) - b[i].speed;
					if( newY < 0) 
					{
						bullets.removeChild(b[i]);
					}
					else 
					{
						b[i].style.top = newY + 'px';
						for(var j=0; j<enemies.length;j++)
						{
							if(hittest(b[i],enemies[j]) ){
								bullets.removeChild(b[i]);
								explode(enemies[j]);
								placeEnemyShip(enemies[j]);
								break;
							}
						}
					}
				}
				//output.innerHTML = b.length;
				
				for(var i = 0; i < enemies.length; i++)
				{
					var newY = parseInt(enemies[i].style.top);
					if(newY > GS_HEIGHT) placeEnemyShip(enemies[i]);
					else enemies[i].style.top = newY + enemies[i].speed + 'px';
					
					if( hittest(enemies[i], ship))
					{
						explode(ship);
						death.play();
						explode(enemies[i]);
						ship.style.top = '-10000px';
						placeEnemyShip(enemies[i]);
						
						//Add the Would you like to play again here?
					}
				}
				
				
				for(var i=0; i<orbs.length; i++){
					var newY = parseInt(orbs[i].style.top);
					
					if(newY < GS_HEIGHT)
					{
						orbs[i].style.top = newY + orbs[i].speed + 'px';
					}
					
					else placeBlueOrb(orbs[i]);
				
					if( hittest(orbs[i], ship) )
					{
						powerUpSound.play();
						placeBlueOrb(orbs[i]);
						autofire = true;
					}
				}
				
				
			}//end of gameLoop
			
			function hittest(a,b){
				var aW = parseInt(a.style.width);
				var aH = parseInt(a.style.height);
				
				var aX = parseInt(a.style.left) + aW/2;
				var aY = parseInt(a.style.top) + aH/2;
				
				var aR = (aW + aH) / 4;
				
				var bW = parseInt(b.style.width);
				var bH = parseInt(b.style.height);
				
				var bX = parseInt(b.style.left) + bW/2;
				var bY = parseInt(b.style.top) + bH/2;
				
				var bR = (bW + bH) / 4;
				
				var minDistance = aR + bR;
				
				var cXs = (aX - bX) * (aX - bX);
				var cYs = (aY - bY) * (aY - bY);
				var distance = Math.sqrt(cXs + cYs);
				
				if(distance < minDistance) return true;
				else return false;
			}

			function fire(){
				
				var bulletWidth = 4;
				var bulletHeight = 10;
				var bullet = document.createElement('DIV');
				bullet.className = 'gameObject';
				bullet.style.backgroundColor = 'limegreen';
				if(autofire == true)
				{
					bullet.style.backgroundColor = 'red';
				}
				bullet.style.width = "10px";
				bullet.style.height = "10px";
				bullet.speed = 20;
				bullet.style.top = parseInt(ship.style.top) - bulletHeight + 'px';
				var shipX = parseInt(ship.style.left) + parseInt(ship.style.width)/2;
				bullet.style.left = (shipX - bulletWidth/2) + 'px';
				bullets.appendChild(bullet);
				bulletSound.play();
			}
			
			document.addEventListener('keypress', function(event){
				if(event.charCode==32) fire();
			});
			
			document.addEventListener('keydown', function(event){
				if(event.keyCode==37) leftArrowDown = true;
				if(event.keyCode==39) rightArrowDown = true;
			});

			document.addEventListener('keyup', function(event){
				if(event.keyCode==37) leftArrowDown = false;
				if(event.keyCode==39) rightArrowDown = false;
			});

		</script>
		<style>
			#gameScreen{
				position: relative;
				background-color: silver;
				overflow: hidden;
				margin:0 auto;
			}
			body{
				background-color: black;
	
			}
			#head{
				background-color:black;
			}
			.gameObject{
				position: absolute;
				z-index: 1;
			}
			#SCREEN{
				margin : 0 auto;
			}

			#footerText{
				color: limegreen;
			}
			footer{
				margin : 0 auto;
				padding-right : 50px;
				 text-align: center;
			}
			head{
				margin : 0 auto;
			}
			h3{
				margin : 0 auto;
				padding-left: '25px';
				text-align: center;
			}

		</style>
	</head>
	<body id = "body" onload="init()">
		<div id="SCREEN">
		<div id="gameScreen"></div>
		</div>
		<div id="output"></div>
	</body>
	<footer id="footer">
		<br><br>
		<h3 id= "footerText">CST336 Internet Programming. 2018&copy; Engbeck </h3></br>
                    </br>
                    </br>
                    <img id= "img" src="csumb_logo.jpg" alt="CSUMB Logo" height = 125, width = 200/>
                    <img src="buddy_verified.png" alt="CSUMB Logo" height = 125, width = 200/>

	</footer>
</html>
