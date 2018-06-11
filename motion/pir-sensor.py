#!/usr/bin/python

# Author: Hyunjun Lim
# Date: May-07-2018
# Title: motion prober software
# License: Apache
# Prequisites:
# $ sudo apt install mplayer
# $ sudo pip install gpiozero
#
# Caution:
# 1. Check location of +DC voltage and GND line at Raspberry Pi3 board
# 2. Change sensor and pulse button (orange color) appropriately
#
# How to run program:
# $ sudo visudo 
#  # User privilege specification
#    root            ALL=(ALL:ALL) ALL
#    hjoon0510       ALL=NOPASSWD: ALL
# $ ./pir-sensor.py
#
# Reference:
# 1. http://gpiozero.readthedocs.io/en/stable/recipes.html
# 2. http://raspi.tv/2015/gpio-zero-test-drive-making-light-of-security
#
from gpiozero import MotionSensor
import time
import os

#----------- Configuration area -------------------------------
folder = "/var/www/html/motion/"
GPIO_PIN = 4
count = 0
condition_rain = "Rain\n"
condition_snow = "Snow\n"

#----------- Do not modify below statements -------------------
try:
    print "[DEBUG] Starting motion sensor..."

    # go to the default absolute path in order to read data file correctly
    os.chdir(folder)
    # MotionSensor function probes the movement of people.
    pir = MotionSensor(GPIO_PIN)
    while True:
        print "[DEBUG] Sleeping..."
        pir.wait_for_motion()
        count += 1
        t = time.localtime()
        print ("################# Motion Detected! (%d) %d:%d:%d ##############################" \
        % (count, t.tm_hour, t.tm_min, t.tm_sec))
        # read current weather and current finedust value from current_weather.txt. and current_finedust.txt
        file = open("../webpage/data/current_weather.txt")
	file = open("../webpage/dats/current_finedust.txt")
        
	current_weather = file.read()
        curent_finedust = file.read()
        print ("[DEBUG] The weather data of curent.txt file is %s." % current_weather)
        # if current weather is "Rain".
        if (current_weather == condition_rain):
            cmd = "mplayer ../sound/wma/sound-rain-english.wma"
            os.system(cmd)
        # if current weather is "Snow".
        elif(current_weather == condition_snow):
            cmd = "mplayer ../sound/wma/sound-snow-english.wma"
            os.system(cmd)
        elif(current_finedust == 3 || current_finedust == 4):
            cmd = "mplayer ../sound/wma/sound-dust-english.wma"
	    os.system(cmd)
	else:
            cmd = "mplayer ../sound/wav/dingdong.wav"
            os.system(cmd)
        # wait for 5 seconds
        time.sleep(5)
# let's exit if users press "Ctrl + C".
except KeyboardInterrupt:
    print "Quit"
