# What is Smart Secretary?
This program informs users of current weather and important schedules as a personal secretary in the morning everyday in front of a door.

# Motivation
Unfortunayely, modern people can not keep their umbrellas on a rainy day because of busy daily life, and often leave the house. So when the weather you know is often going out, it often changes. People are very busy in the morning. As a result of that, they do not finally bring their important schedules in front of door.
From our experiecne, we often do not remember things or schedules we need to pack in the morning. Therefore, we need to get a personal assistant to solve these problems. We named __Smart Secretary__ (SS). The recommended pronunciation is **"double s"** to minimize your inconvenience because of long project name.

# Requirement
First of all, you have to prepare hardware and software as follows.

### Hardware
Smart Secretary (SS) provides an intelligent facility to assist a busy modern people. It is developed with popular
embedded device Raspberry Pi3 board. We also bought a PIR motion sensor to probe a movement of a hunman being.
* Raspberry Pi3 board: https://www.raspberrypi.org/products/raspberry-pi-3-model-b/ (40,000 won)
* PIR Sensor (Motion Sensor): http://m.eleparts.co.kr/goods/view?no=3227278 (1,800 won)

### Software
Thanks to Linux kernel, We could easily set-up a free operating systems (OS) that is called Ubuntu OS, Raspbian OS
on our Raspberry Pi3 board.
* Raspbian OS: https://www.raspberrypi.org/downloads/raspbian/ (free)
* Ubuntu OS: https://ubuntu-mate.org/raspberry-pi/ (free)
* MobaXterm: https://mobaxterm.mobatek.net/download.html (free)

### Programming languages
Our program is developed by Python, PHP, and HTML language.
* Python - https://www.python.org/ (free)
* PHP - http://php.net/ (free)
* HTML - https://www.w3schools.com/html/ (free)
* C - https://gcc.gnu.org/ (free)

# Design
The figure below shows an entire operation sequence of our solution. First of all, this program gets a necessary information from web API servers such as weather and fine dust. The program then uses the PIR motion sensor to detect human motion exactly. When a person comes around the Raspberry Pi3 board, Smart Secretary only prints important information on the screen, but also speaks by voice for busy modern people. Users can also check the important schedule(you can show schedule thanks to google calendar API service) before leaving home. In the event of rain, users can check the weather information in real time using e-mail.

<img src=./pic/ss-diagram2.jpg border=0 width=800 height=400> </img>


# How to install

### Install Ubuntu OS in Raspberry Pi3
First of all, read documents that we uploaded in [doc](doc/README.md) folder.
Then, please try to install Ubuntu OS in Raspberry Pi3 device.


### Install Smart Secretary
Smart Secretary was mainly developed by Python (motion sensor) and PHP (Web application). 
Please install two applications as following:
```bash
Run ssh session with mobaxterm software on windows7 PC.
$ cd /var/www/html
$ git clone https://github.com/hjoon0510/SmartSecretary.git
$ cd ./SmartSecretary 
$ sudo chown -R www-data:www-data /var/www/html/SmartSecretary/webpage/data/
$ sudo visudo
--------------- /etc/sudoers: start ----------------
# User privilege specification
root    ALL=(ALL:ALL) ALL
hjoon0510       ALL=NOPASSWD: ALL <---- Please append your id here.!!!!
--------------- /etc/sudoers: ending ---------------
```

# How to run
This section describes how to start web-application and pir-sensor program.

### Run software manually
* How to run with run.c
At first, compile run.c with gcc command. Then, Just execute `run` file. 
```bash
$ cd SmartSecretary
$ gcc -o run run.c
$ ./run
```

* How to run with console command
Run PIR motion sensor and Web application firsthand as follows. 
```bash
$ /var/www/html/SmartSecretary/motion/pir-sensor.py 
( or $ exec /var/www/html/SmartSecretary/motion/pir-sensor.py &> /dev/null & )
$ sudo systemctl restart apache2
$ chromium-browser http://localhost/SmartSecretary/ --start-fullscreen
```
That is all. Enjoy Smart Secrectary!!! 
If you do not want to see the `ubuntu-mate-welcome` pop-up window at boot time, uncheck the **Welcome** menu at `Startup Applications` menu.

### Run software at boot-time automatically
If you want to start automatically chromium-browser in full screen mode at boot time, Please append new program to the list of startup program on `Startup Applications` windows as follows. 
```bash
* Ubuntu - System - Preference - Personal - Startup Applications

* Smart Secretary (web-app)
   * Name: Smart Secretary (webapp)
   * Command: chromium-browser http://localhost/SmartSecretary/ --start-fullscreen
   * Comment: none

* Smart Secretary (pir-sensor)
   * Name: Smart Secretary (pir-sensor)
   * Command: /var/www/html/SmartSecretary/motion/pir-sensor.py
   * Comment: none
```
The above icons are saved in the `~/.config/autostart/` folder. Alternatively, you can append your terminal commands in `/etc/init.d/rc.local`, and it will also automatically execute upon boot.

# Demonstration
* IP address - http://192.168.219.104 
   * The IP address is not public IP address. It is a private IP address. So you can only connect to IP adddress in specified WiFi Router range for security.
* Website - http://doubles.mooo.com
   * This web address is created free of charge via https://freedns.afraid.org/.
<img src=https://github.com/hjoon0510/SmartSecretary/blob/master/pic/demo6.jpg border=0 width=500 height=350> </img>
<img src=https://github.com/hjoon0510/SmartSecretary/blob/master/pic/demo7.jpg border=0 width=500 height=350> </img>
<img src=https://github.com/hjoon0510/SmartSecretary/blob/master/pic/demo8.jpg border=0 width=500 height=350> </img>

# Reference
* https://guides.github.com/features/mastering-markdown/
* https://openweathermap.org/ (Open API for weather)
* https://www.data.go.kr/dataset/15000581/openapi.do (Open API for fine dust)
* https://github.com/erikflowers/weather-icons/tree/master/svg
* http://www.iconarchive.com/
* https://www.raspberrypi.org/products/raspberry-pi-3-model-b/
* http://gpiozero.readthedocs.io/en/stable/installing.html (How to use GPIO pin)
* https://github.com/ajwans/sSMTP
* https://developers.google.com/calendar/v3/reference/events/list (Google Calendar API)
* https://tutorials-raspberrypi.com/raspberry-pi-sensors-overview-50-important-components/ (50 sensors)
* http://www.eleparts.co.kr/goods/view?no=3824794 (Shopping Mall: RPI NOIR CAMERA BOARD V2, 29,000 won)

# Terminology
* API: Application Programming Interface
* GPIO: General-Purpose Input/Output
* HTML: HyperText Markup Language
* MD: MarkDown
* OS: Operating System
* PIR: Passive-InfraRed
* RPi: Raspberry Pi
* SS: Smart Secretary
* SMTP: Simple Mail Transfer Protocol
* WWW: World-Wide Web

# Translation
We make an effort to write english statement by utilizing https://translate.google.com to talk about the Smart Secretary project with foreign students all over the world. If you are not student that can not speak in english such as us, we recomend that you try to use https://translate.google.co.kr/?hl=ko#en/ja/https%3A%2F%2Fgithub.com%2Fhjoon0510%2FSmartSecretary for your convenience.

* [Korean](https://translate.googleusercontent.com/translate_c?act=url&depth=1&hl=ko&ie=UTF8&prev=_t&rurl=translate.google.co.kr&sl=en&sp=nmt4&tl=ko&u=https://github.com/hjoon0510/SmartSecretary&xid=17259,15700021,15700124,15700149,15700168,15700186,15700190,15700201,15700208&usg=ALkJrhh-pPbQEVR-AjDeXt25RURdyjlS_w)
* [Japanese](https://translate.googleusercontent.com/translate_c?act=url&depth=1&hl=ko&ie=UTF8&prev=_t&rurl=translate.google.co.kr&sl=en&sp=nmt4&tl=ja&u=https://github.com/hjoon0510/SmartSecretary&xid=17259,15700021,15700124,15700149,15700168,15700186,15700190,15700201,15700208&usg=ALkJrhj0--Y6Mqw9XJHI_b4fCYAthZpLxw)
* [Chinese](https://translate.googleusercontent.com/translate_c?act=url&depth=1&hl=ko&ie=UTF8&prev=_t&rurl=translate.google.co.kr&sl=en&sp=nmt4&tl=zh-CN&u=https://github.com/hjoon0510/SmartSecretary&xid=17259,15700021,15700124,15700149,15700168,15700186,15700190,15700201,15700208&usg=ALkJrhhUqfZCJg1ImbQahsXoILq56vbrSA)


# Contact
My name is Hyunjun Lim (임현준 in korean). I am a student in [Maetan middle-school](http://maetan.ms.kr/). My homepage is http://hjoon0510.github.io. Also, I am project leader for Smart Secretary. If you have any questions, Please contact me hjoon0510@gmail.com.
<br><br>

My name is Suyeon Lim (임수연 in korean). I ma a student in [Maeheon middle-school](http://maehyeon.ms.kr). My homepage is https://lsy0314.github.io/.  If you have any questions, Please do not hesitate to contact me lsy0314@gmail.com.

# License
The official license of Smart Secretary is `Star` License. For more details, please read [Star License](LICENSE.md) clause.
* [ScanCode](https://github.com/nexB/scancode-toolkit) scans code and detects licenses, copyrights, package manifests & dependencies 
