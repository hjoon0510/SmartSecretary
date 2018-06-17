# What is Smart Secretary?
This program informs users of weather and schedules.

# Motivation
Modern people can not keep their umbrellas on a rainy day because of busy daily life, and often leave the house. So when the weather you know is often going out, it often changes. People are very busy in the morning.
So I often do not remember things or schedules I need to pack. I need a personal assistant to solve these problems. I named this device __Smart Secretary__ (SS). The recommended pronunciation is **"double s"**.

# Requirement
You have to prepare hardware and software as follows.

### Hardware
Smart Secretary (SS) provides an intelligent facility to help busy modern people. It is developed with popular
embedded device Raspberry Pi3 board. I have used PIR motion sensor to probe movement of a hunman being.
* Raspberry Pi3 board: https://www.raspberrypi.org/products/raspberry-pi-3-model-b/ (40,000won)
* PIR Sensor (Motion Sensor): http://m.eleparts.co.kr/goods/view?no=3227278 (1,800won)

### Software
Thanks to Linux kernel, We can easily set-up free operating systems (OS) that is called Ubuntu OS, Raspbian OS
to Raspberry Pi3 board.
* Raspbian OS: https://www.raspberrypi.org/downloads/raspbian/ (free)
* Ubuntu OS: https://ubuntu-mate.org/raspberry-pi/ (free)
* Mobaxterm: https://mobaxterm.mobatek.net/download.html (free)

### Programming languages
It is developed by Python, PHP, and HTML language.
* Python - https://www.python.org/ (free)
* PHP - http://php.net/ (free)
* HTML - https://www.w3schools.com/html/ (free)

# Design
The following figure shows the operation sequence of the program. First of all, this program gets the necessary information from the weather server. The program then uses the motion sensor to detect human motion. When a person comes around the hardware, it not only prints important information on the screen, but also speaks by voice. Users can also check the schedule(you can show schedule from google calendar)information before leaving home. In the event of rain, users can check the weather information in real time using e-mail.

<img src=./pic/ss-diagram2.jpg border=0 width=800 height=350> </img>


# How to install

### Install Ubuntu OS in Raspberry Pi3
First of all, read documents that we uploaded in [doc](doc/README.md) folder.
Then, please try to install Ubuntu OS in Raspberry Pi3 device.


### Install Smart Secretary
Smart Secretary was developed by Python (motion sensor) and PHP (Web application). 
Please install two applications as following:
```bash
Run ssh session with mobaxterm software on windows7 PC.
$ cd /var/www/
$ mv html htmld.old
$ git clone https://github.com/hjoon0510/SmartSecretary.git
$ ln -s ./SmartSecretary ./html
$ sudo chown -R www-data:www-data /var/www/html/html/webpage/data/
$ sudo visudo
--------------- /etc/sudoers: start ----------------
# User privilege specification
root    ALL=(ALL:ALL) ALL
hjoon0510       ALL=NOPASSWD: ALL <---- Please append your id here.!!!!
--------------- /etc/sudoers: ending ---------------
```

### Run Smart Secretary
Let's run PIR motion sensor and Webapplication. 
```bash
$ exec /var/www/html/motion/pir-sensor.py &> /dev/null &
$ sudo systemctl restart apache2
$ chromium-browser http://localhost --start-fullscreen
```
That's all. Enjoy Smart Secrectary!!! 
If you do not start `ubuntu-mate-welcome` window at boot time, uncheck **Welcome** menu at `Startup Applications`.

### How to start web-application and pir-sensor automatically at boot time
If you want to start automatically chromium-browser in full screen mode at boot time, Please append new program to the list of startup program on `Startup Applications` windows as follows. 
```bash
* Ubuntu - System - Preference - Personal - Startup Applications

* Smart Secretary (web-app)
   * Name: Smart Secretary (webapp)
   * Command: chromium-browser http://smartsecretary.mooo.com --start-fullscreen
   * Comment: none

* Smart Secretary (pir-sensor)
   * Name: Smart Secretary (pir-sensor)
   * Command: /var/www/html/motion/pir-sensor.py
   * Comment: none
```
The above icons are saved in the `~/.config/autostart/` folder. Alternatively, you can append your terminal commands in `/etc/init.d/rc.local`, and it will also automatically execute upon boot.

# Demonstration
* IP address - http://192.168.219.104 
   * The IP address is not public IP address. It is a private IP address. So you can only connect to IP adddress in specified WiFi Router range for security.
* Website - http://smartsecretary.mooo.com
   * This web address is created free of charge via https://freedns.afraid.org/.
<img src=https://github.com/hjoon0510/SmartSecretary/blob/master/pic/demo6.jpg border=0 width=500 height=350> </img>


# Reference
* https://guides.github.com/features/mastering-markdown/
* https://openweathermap.org/ (Open API for weather)
* https://www.data.go.kr/dataset/15000581/openapi.do (Open API for fine dust)
* https://github.com/erikflowers/weather-icons/tree/master/svg
* http://www.iconarchive.com/
* https://www.raspberrypi.org/products/raspberry-pi-3-model-b/
* http://gpiozero.readthedocs.io/en/stable/installing.html (How to use GPIO pin)
* https://github.com/ajwans/sSMTP
* https://tutorials-raspberrypi.com/raspberry-pi-sensors-overview-50-important-components/ (50 sensors)
* http://www.eleparts.co.kr/goods/view?no=3824794 (Shopping Mall: RPI NOIR CAMERA BOARD V2, 29,000 won)

# License
The official license of Smart Secretary is `Star` License. For more details, please read [Star License](LICENSE.md) clause.
* [ScanCode](https://github.com/nexB/scancode-toolkit) scans code and detects licenses, copyrights, package manifests & dependencies 

# Translation
We make an effort to write english statement by utilizing https://translate.google.com to talk about Smart Secretary project with foreign students all over the world. If you are not student that can not speak in english, you can use https://translate.google.co.kr/?hl=ko#en/ja/https%3A%2F%2Fgithub.com%2Fhjoon0510%2FSmartSecretary for your convenience.


# Contact
My name is Hyunjun Lim (임현준 in korean). I am a student in [Maetan middle-school](http://maetan.ms.kr/). My homepage is http://hjoon0510.github.io. Also, I am project leader for Smart Secretary. If you have any questions, Please contact me hjoon0510@gmail.com.
<br><br>

My name is Suyeon Lim (임수연 in korean). I ma a student in [Maeheon middle-school](http://maehyeon.ms.kr). My homepage is https://lsy0314.github.io/.  If you have any questions, Please do not hesitate to contact me lsy0314@gmail.com.


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
