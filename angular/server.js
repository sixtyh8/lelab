var connect = require('connect'),
	http = require('http'),
	url = require('url'),
	proxy = require('proxy-middleware'),
	modRewrite = require('connect-modrewrite');

var app = connect()
  .use(connect.logger('dev'))
  .use(modRewrite([
    '^(api/.*)$ index.php?url=$1 [QSA,L,NC]',
    '^(app/.*)$ index.php?url=$1 [QSA,L,NC]',
    '%{REQUEST_FILENAME} !-f',      
    '%{REQUEST_FILENAME} !-d',
    '^(.*) index.html [NC,L]'
  ]))
  .use(connect.static('app'))
  .use(connect.static('.tmp'))
  .use(connect.directory('app'))
  .use(connect.cookieParser());

http.createServer(app).listen(8000, 'ng.lelab.local');

console.log('Listening on port 8000');