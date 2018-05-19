#!/usr/bin/python

# Author: Hyunjun Lim
# Date: May-07-2018
# Title: motion prober software
# License: Apache
# Prequisites: sudo apt install mplayer, sudo pip install gpiozero
#
# Caution:
# 1. Check location of  +DC voltage and GND line
# 2. Change sensor and pulse button (orange color) appropriately
#
# How to run program:
# $ sudo visudo 
#  # User privilege specification
#    root            ALL=(ALL:ALL) ALL
#    hjoon0510       ALL=NOPASSWD: ALL
# $ ./pir-final.py
#
# Reference:
# 1. http://gpiozero.readthedocs.io/en/stable/recipes.html
# 2. http://raspi.tv/2015/gpio-zero-test-drive-making-light-of-security
#
from gpiozero import MotionSensor
import time
import os

#----------- Configuration area -------------------------------
GPIO_PIN = 4
count = 0
condition_rain = "Rain\n"
condition_snow = "Snow\n"

#----------- Do not modify below statements -------------------
try:
    print "[DEBUG] Starting motion sensor..."
    # MotionSensor function probes the movement of people.
    pir = MotionSensor(GPIO_PIN)
    while True:
        pir.wait_for_motion()
        count += 1
        t = time.localtime()
        print "%d:%d:%d Motion Detected!" % (t.tm_hour, t.tm_min, t.tm_sec)
        print ("[DEBUG] Motion Detected! " + str(count))
        file = open("../webpage/current.txt")
        current = file.read()
        print ("[DEBUG] The weather data of curent.txt file is %s." % current)
        # if current weather is "Rain".
        if (current == condition_rain):
            cmd = "mplayer ../sound/wma/sound-rain-english.wma"
            os.system(cmd)
        elif(current == condition_snow):
            cmd = "mplayer ../sound/wma/sound-snow-english.wma"
            os.system(cmd)
        else:
            cmd = "mplayer ../sound/wav/dingdong.wav"
            os.system(cmd)
        # wait for 5 seconds
        time.sleep(5)
# let's exit if users press "Ctrl + C".
except KeyboardInterrupt:
    print "Quit"
    GPIO.cleanup()
