var canvas = document.getElementById('myCanvas');
var ctx = canvas.getContext('2d');

// define ball
var ballRadius = 10;

// set ball origin
var x = canvas.width / 2;
var y = canvas.height - 30;

// interating ball coordin after drawn frame
var dx = 4;
var dy = -4;

// define paddle
var paddleHeight = 10;
var paddleWidth = 75;
var paddleX = (canvas.width - paddleWidth) / 2;
var rightPressed = false;
var leftPressed = false;

// define bricks
var brickRowCount = 6;
var brickColumnCount = 8;
var brickWidth = 75;
var brickHeight = 20;
var brickPadding = 10;
var brickOffsetTop = 30;
var brickOffsetLeft = 30;

// define score
var score = 0;

// define lives
var lives = 3;

// brick postition array
var bricks = [];
for (var c = 0; c < brickColumnCount; c += 1) {
  bricks[c] = [];
  for (var r = 0; r < brickRowCount; r += 1) {
    bricks[c][r] = { x: 0, y: 0, status: 1 };
  }
}

function keyDownHandler(e) {
  if (e.keyCode === 39) {
    rightPressed = true;
  } else if (e.keyCode === 37) {
    leftPressed = true;
  }
}
document.addEventListener('keydown', keyDownHandler, false);

function keyUpHandler(e) {
  if (e.keyCode === 39) {
    rightPressed = false;
  } else if (e.keyCode === 37) {
    leftPressed = false;
  }
}
document.addEventListener('keyup', keyUpHandler, false);

function mouseMoveHandler(e) {
  var relativeX = e.clientX - canvas.offsetLeft;
  if (relativeX > 0 && relativeX < canvas.width) {
    paddleX = relativeX - paddleWidth / 2;
  }
}
document.addEventListener('mousemove', mouseMoveHandler, false);

function collisionDetection() {
  for (var _c = 0; _c < brickColumnCount; _c += 1) {
    for (var _r = 0; _r < brickRowCount; _r += 1) {
      var b = bricks[_c][_r];
      if (b.status === 1) {
        if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {
          dy = -dy;
          b.status = 0;
          score += 1;
          if (score === brickColumnCount * brickRowCount) {
            // alert("You Win");
            // document.location.reload();
          }
        }
      }
    }
  }
}

function drawBall() {
  ctx.beginPath();
  // context.arc(x,y,r,sAngle,eAngle,counterclockwise);
  ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
  ctx.fillStyle = '#0095DD';
  ctx.fill();
  ctx.closePath();
}

function drawPaddle() {
  ctx.beginPath();
  ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
  ctx.fillStyle = '#0095DD';
  ctx.fill();
  ctx.closePath();
}

function drawBricks() {
  for (var _c2 = 0; _c2 < brickColumnCount; _c2 += 1) {
    for (var _r2 = 0; _r2 < brickRowCount; _r2 += 1) {
      if (bricks[_c2][_r2].status === 1) {
        var brickX = _c2 * (brickWidth + brickPadding) + brickOffsetLeft;
        var brickY = _r2 * (brickHeight + brickPadding) + brickOffsetTop;
        bricks[_c2][_r2].x = brickX;
        bricks[_c2][_r2].y = brickY;
        ctx.beginPath();
        ctx.rect(brickX, brickY, brickWidth, brickHeight);
        ctx.fillStyle = '#0095DD';
        ctx.fill();
        ctx.closePath();
      }
    }
  }
}

function drawScore() {
  ctx.font = '16px Arial';
  ctx.fillStyle = '#0095DD';
  ctx.fillText('Score: ' + score, 8, 20);
}

function drawLives() {
  ctx.font = '16px Arial';
  ctx.fillStyle = '#0095DD';
  ctx.fillText('Lives: ' + lives, canvas.width - 65, 20);
}

function gameOver(gameScore) {
  // post score to db
  axios.post('/scores', { score: gameScore }).then(function (response) {
    console.log(response);
  }).catch(function (error) {
    console.log(error);
  });
}

function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height); // Clears entire canvas
  drawBricks();
  drawBall();
  drawPaddle();
  drawScore();
  drawLives();
  collisionDetection();

  // ball boundries - top || bottom 
  if (y + dy < ballRadius) {
    dy = -dy;
  } else if (y + dy > canvas.height - ballRadius) {
    lives -= 1;
    if (!lives) {
      gameOver(score);
      window.cancelAnimationFrame(undefined);
    } else {
      x = canvas.width / 2;
      y = canvas.height - 30;
      dx = 2;
      dy = -2;
      paddleX = (canvas.width - paddleWidth) / 2;
    }
  } else if (y + dy > canvas.height - ballRadius - paddleHeight) {
    // paddle & ball collision detection
    if (x > paddleX && x < paddleX + paddleWidth) {
      dy = -dy;
    }
  }

  // ball boundries - left || right
  if (x + dx < ballRadius || x + dx > canvas.width - ballRadius) {
    dx = -dx;
  }

  // ball moving logic
  x += dx;
  y += dy;

  // paddle moving logic (with boundries)
  if (rightPressed && paddleX < canvas.width - paddleWidth) {
    paddleX += 7;
  } else if (leftPressed && paddleX > 0) {
    paddleX -= 7;
  }

  window.requestAnimationFrame(draw);
}

// var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
//                             window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

// var cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

// var start = Date.now();  // Only supported in FF. Other browsers can use something like Date.now().

// var myReq;

// function step(timestamp) {
//   var progress = timestamp - start;
//   d.style.left = Math.min(progress / 10, 200) + 'px';
//   if (progress < 2000) {
//     myReq = requestAnimationFrame(step);
//   }
// }
// myReq = requestAnimationFrame(step);

// cancelAnimationFrame(myReq);

function startGame() {
  draw();
}