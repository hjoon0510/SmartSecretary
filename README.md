# Smart Secretary
This program tells users the weather and schedule in front of door. It is developed by bash, python, php, and html.

# Motivation
Because of busy daily life, I do not take umbrella with me on rainy day.
It is difficult for users to cope with the changing weather frequently.
So, I planned to developer IoT device to help them.

# Requirement

## Hardware
Smart Secretary (SS) provides an intelligent facility to help busy modern people. It is developed with popular
embedded device Raspberry Pi3 board. I have used PIR motion sensor to probe movement of a hunman being.
* https://www.raspberrypi.org/products/raspberry-pi-3-model-b/

## Software
Thanks to Linux kernel, We can easily set-up free operating systems (OS) that is called Ubuntu OS, Raspbian OS
to Raspberry Pi3 board.
* Raspbian OS: https://www.raspberrypi.org/downloads/raspbian/
* Ubuntu Mate OS: https://ubuntu-mate.org/raspberry-pi/

# How to use
Fir of all, I recommend that you read documents that I uploaded in 'doc' folder.
```bash
$ cd /var/www/
$ mv html htmld.old
$ git clone https://github.com/hjoon0510/SmartSecretary.git
$ ln -s ./SmartSecretary html
$ cd /var/www/html/motion
$ sudo  ./pir-final.py
$ chromium-browser http://localhost
```

# Demonstration
* http://192.168.219.104 
* http://smartsecretary.mooo.com (This web address is created via https://freedns.afraid.org/.)
<img src=https://github.com/hjoon0510/SmartSecretary/blob/master/pic/demo5.jpg border=0 width=500 height=350> </img>


# Reference
* https://github.com/hjoon0510/hjoon0510.github.io (= http://hjoon0510.github.com)
* https://openweathermap.org/
   * https://github.com/erikflowers/weather-icons/tree/master/svg
* https://www.raspberrypi.org/products/raspberry-pi-3-model-b/
* https://gist.github.com/ihoneymon/652be052a0727ad59601
* http://gpiozero.readthedocs.io/en/stable/installing.html

# Contact
I am a student in Maheon mid-school. If you have any questions, Please contact me hjoon0510@gmail.com.
I make an effort to write english statement by utilizing https://translate.google.com.
