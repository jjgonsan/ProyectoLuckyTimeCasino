# ProyectoLuckyTimeCasino
Proyecto de final de grado de Desarrollo de Aplicaciones Web.

usuario: administrador
contraseña: admin1234

usuario: root
contraseña: admin1234

CONFIGURACIÓN DE LA MÁQUINA VIRTUAL

- Las configuraciones que se han utilizado están basadas en una máquina virtual con las especificaciones indicadas a continuación.

- 2 GB de RAM, 80GB de disco duro, 2 núcleos de procesador.

- Instalar Debian 10 con interfaz gráfica.

- No es necesario instalar el servidor SSH si no se va a editar el código

- Una vez instalado Debian 10 (credenciales que se deben usar arriba). Instalar XAMPP ver. 8.0.12.

- Añadir net tools para que funcione XAMPP mediante:
>  sudo apt install net-tools

- Editar /etc/sudoers como root mediante el comando en consola:
>  su root

tras cambiar a root, hay que escribir:
> sudo nano /etc/sudoers

En el apartado #User Privilege specification
Se debe añadir: 
> administrador ALL=(ALL:ALL) ALL

debajo de los privilegios de root. Se guarda el documento.

- Para añadir los archivos del proyecto se puede hacer mediante el servidor SSH o instalando guest-additions.

- Editar el archivo /opt/lampp/etc/httpd.conf y descomentar los virtualHost.

- Editar el archivo httpd-vhosts.conf y añadir: 

> <VirtualHost *:80>

   > DocumentRoot "/opt/lampp/htdocs/luckytime"
    
   > DirectoryIndex index.php
    
   > ServerName luckytime.local
    
   > ErrorLog "logs/dummy-hostweb.example.com-error_log"
    
   > CustomLog "logs/dummy-hostweb.example.com-access_log" common
    
> <Directory "/opt/lampp/htdocs/luckytime">

   > Require all granted
        
> </Directory>

> </VirtualHost>

- Necesitamos configurar el fichero hosts con los siguientes parámetros:
> sudo nano /etc/hosts

> 127.0.0.1	localhost

> 127.0.1.1	luckytime.local

> 192.168.1.86	luckytime.luckytime.local

> The following lines are desirable for IPv6 capable hosts

> ::1     localhost ip6-localhost ip6-loopback

> ff02::1 ip6-allnodes

> ff02::2 ip6-allrouters

- También debemos de tener IP fija, lo haremos editando /etc/network/interfaces y añadiendo lo siguiente:
> allow-hotplug enp0s3

> iface enp0s3 inet static

   > address 192.168.1.86
   
   > netmask 255.255.255.0
   
   > gateway 192.168.1.1
   
   > dns-nameservers 8.8.8.8



//////////////////////Conectar a la aplicación web Lucky Time Casino//////////////////////////////


- Una vez encendida e iniciada la sesión con el usuario Administrador, abrimos la terminal.

- En la terminal, escribimos: 
> cd /opt/lampp

- Una vez estemos en dicha carpeta, escribimos: 
> sudo ./lampp start

-Nos pedirá la contraseña, por lo que volvemos a escribir: 
> admin1234

-Esto iniciará XAMPP y todos los servicios necesarios para hacer funcionar nuestra aplicación web. 

- Abrimos Mozilla Firefox y en la barra de navegación escribimos: 
> luckytime.local

-Y ya podremos acceder a la página web de Lucky Time Casino.
