# Smart Secretary
This program tells users the weather and schedule in front of door. 


# Motivation
Because of busy daily life, I do not take umbrella with me on rainy day.
It is difficult for users to cope with the changing weather frequently.
So, I planned to developer IoT device to help them.

# Requirement
You have to prepare hardware and software as follows.

### Hardware
Smart Secretary (SS) provides an intelligent facility to help busy modern people. It is developed with popular
embedded device Raspberry Pi3 board. I have used PIR motion sensor to probe movement of a hunman being.
* Raspberry Pi3 board: https://www.raspberrypi.org/products/raspberry-pi-3-model-b/
* PIR Motion Sensor: http://m.eleparts.co.kr/goods/view?no=3227278

### Software
Thanks to Linux kernel, We can easily set-up free operating systems (OS) that is called Ubuntu OS, Raspbian OS
to Raspberry Pi3 board.
* Raspbian OS: https://www.raspberrypi.org/downloads/raspbian/
* Ubuntu OS: https://ubuntu-mate.org/raspberry-pi/


### Programming languages
It is developed by Python, PHP, and HTML language.
* Python - https://www.python.org/
* PHP - http://php.net/
* HTML - https://www.w3schools.com/html/

# How to use
First of all, I recommend that you read documents that I uploaded in 'doc' folder in order to install software in Raspberry Pi3 device.
```bash
$ cd /var/www/
$ mv html htmld.old
$ git clone https://github.com/hjoon0510/SmartSecretary.git
$ ln -s ./SmartSecretary ./html
$ cd /var/www/html/motion
$ sudo ./pir-final.py
$ chromium-browser http://localhost
Enjoy my software.
```
# Design
The following figure shows the operation sequence of the program. First of all, this program gets the necessary information from the weather server. The program then uses the motion sensor to detect human motion. When a person comes around the hardware, it not only prints important information on the screen, but also speaks by voice. Users can also check the schedule information before leaving home. In the event of rain, users can check the weather information in real time using e-mail.
* TODO: append desgin picture.!!!!

# Demonstration
* IP address - http://192.168.219.104 
* Website - http://smartsecretary.mooo.com (This web address is created via https://freedns.afraid.org/.)
<img src=https://github.com/hjoon0510/SmartSecretary/blob/master/pic/demo6.jpg border=0 width=500 height=350> </img>


# Reference
* https://guides.github.com/features/mastering-markdown/
   * https://gist.github.com/ihoneymon/652be052a0727ad59601
* https://openweathermap.org/
   * https://github.com/erikflowers/weather-icons/tree/master/svg
* https://www.raspberrypi.org/products/raspberry-pi-3-model-b/
* http://gpiozero.readthedocs.io/en/stable/installing.html
* https://github.com/PHPMailer/PHPMailer

# Contact
I am a student in [Maetan mid-school](http://maetan.ms.kr/). My homepage is http://hjoon0510.github.io. If you have any questions, Please contact me hjoon0510@gmail.com.
<br><br>
I make an effort to write english statement by utilizing https://translate.google.com to talk about my project with foreigners all over the world. If you are not student that can not speak in english, you can use https://translate.google.co.kr/?hl=ko#en/ja/https%3A%2F%2Fgithub.com%2Fhjoon0510%2FSmartSecretary for your convenience.
