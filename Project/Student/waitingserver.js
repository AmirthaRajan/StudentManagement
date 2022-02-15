var http = require('http');
http.createServer(function (req, res) {
  console.log(req.url)
  if (req.url.indexOf("wait") != -1){
    setTimeout(function(){
      res.writeHead(200, {'Content-Type': 'text/plain'});
      res.end('Good Morning\n');
    }, 20000);
  }
  else {
    res.writeHead(200, {'Content-Type': 'text/plain'});
    res.end('Good Evening\n');
  }

}).listen(4343, '0.0.0.0');
console.log('Server running at http://0.0.0.0:4343/');
