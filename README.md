esta api fue probada en un servidor apache usando xampp
para evitar problemas de cors al usarla desde un cliente externo que se este ejecutando en otro puerto
configurar un archivo .htaccess

<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "*"
    Header set Access-Control-Allow-Methods "GET,POST,OPTIONS"
    Header set Access-Control-Allow-Headers "Content-Type,Authorization"
</IfModule>

copia esta configuracion dentro del .htaccess
