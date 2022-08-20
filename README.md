
# Restaurante Siglo XXI

## Configuración de dominio local
- https://medium.com/@ajtech.mubasheer/configure-a-virtual-host-for-laravel-project-in-xampp-for-windows-10-d3f0068e7e1b
  - (Abrir como administrador) ```C:\Windows\System32\drivers\etc\hosts``` y pegar esto al final:
    - ```127.0.0.1 restaurante-sigloxxi.local```
  - Abrir el archivo ... y pegar lo siguiente:
    ```text
      <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs"
       ServerName localhost
      </VirtualHost>
      <VirtualHost 127.0.0.2:80>
       DocumentRoot "(CarpetaDelProyecto)/public"
       DirectoryIndex index.php
       ServerName restaurante-sigloxxi.dev
       <Directory "(CarpetaDelProyecto)/public">
      Options Indexes FollowSymLinks MultiViews
      AllowOverride all
      Order Deny,Allow
      Allow from all
      Require all granted
       </Directory>
      </VirtualHost>  
    ```

## Instalación de permisos con roles (administración)
Hacer lo siguiente https://spatie.be/docs/laravel-permission/v5/installation-laravel

