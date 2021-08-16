<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <canvas id='canvas' style = 'border:1px solid; width:1337px; height: 800px;'>
    </canvas>

    <script>
      
      //cache a reference to the html element
      var canvas = document.getElementById('canvas');

      canvas.width = canvas.scrollWidth;
      canvas.height = canvas.scrollHeight;

      var ctx = canvas.getContext('2d');

      ctx.fillStyle = 'green';
      ctx.fillRect(10, 10, 100, 100);
      ctx.rotate((Math.PI / 180) * 20);

      ctx.fillStyle = 'green';
      ctx.fillRect(90, 100, 100, 100);
      ctx.rotate(-(Math.PI / 180) * 20);

      ctx.strokeStyle = 'red';
      ctx.strokeRect(250, 50, 100, 100);

      ctx.fillStyle = 'yellow';
      ctx.beginPath();
      ctx.arc(450, 100, 50, 0, Math.PI * 2);
      ctx.fill();

      ctx.strokeStyle = 'blue';
      ctx.beginPath();
      ctx.arc(570, 100, 50, 0, Math.PI * 2);
      ctx.stroke();

      ctx.strokeStyle = 'red';
      ctx.beginPath();
      ctx.arc(700, 100, 50, 0, Math.PI / 2);
      ctx.lineTo(700, 100);
      ctx.closePath();
      ctx.stroke();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(830, 100, 50, Math.PI / 2, (Math.PI) + (Math.PI / 2), false);
      ctx.lineTo(830, 100);
      ctx.fill();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(850, 100, 50, Math.PI / 2, (Math.PI) + (Math.PI / 2), true);
      ctx.lineTo(850, 100);
      ctx.fill();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(870, 200, 50, Math.PI / 2, Math.PI, false);
      ctx.lineTo(870, 200);
      ctx.fill();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(930, 200, 50, Math.PI / 2, Math.PI, true);
      ctx.lineTo(930, 200);
      ctx.fill();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(620, 200, 50, 0, (Math.PI) + (Math.PI / 2) , false);
      ctx.lineTo(620, 200);
      ctx.fill();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(620, 200, 50, 0, (Math.PI) + (Math.PI / 2) , false);
      ctx.lineTo(620, 200);
      ctx.fill();

      ctx.fillStyle = 'red';
      ctx.beginPath();
      ctx.arc(620, 320, 50, 0, (Math.PI) + (Math.PI / 2) , true);
      ctx.lineTo(620, 320);
      ctx.fill();

     // for the drawing and manipulation of arcs and circles; 
     // ctx.arc(x, y, radius, starting point, ending point, what part of the circle you want to get);
     // note: the most important components for the manipulation of the arcs are the starting and ending points......




    </script>
</body>
</html>