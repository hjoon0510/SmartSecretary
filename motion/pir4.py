#!/usr/bin/python

# Author: Hyunjun Lim
# Date: May-07-2018
# Title: motion prober software
# Caution:
# 1. Check location of  +DC voltage and GND line
# 2. Change sensor and pulse button (orange color) appropriately
# Prequisites: mplayer

from gpiozero import MotionSensor
import time
import os

#----------- Configuration area -------------------------------
GPIO_PIN = 4
count = 0
condition = "Rain\n"

#----------- Do not modify below statements -------------------
print "[DEBUG] Starting motion sensor..."
pir = MotionSensor(GPIO_PIN)
while True:
	pir.wait_for_motion()
        count += 1
	print ("[DEBUG] Motion Detected! " + str(count))
        # check if current weather is "Rain"
        file = open("../webpage/current.txt")
        current = file.read()
        # if current weather is rainy day, let's play sound.
        if ( current == condition):
            print ("[DEBUG] Current weather is %s" % current)
            cmd = "mplayer  ../sound/wma/sound-rain-english.wma"
            os.system(cmd)
        else:
            print ("[DEBUG] Current weather is %s" % current)
            cmd = "mplayer  ../sound/wav/dingdong.wav"
            os.system(cmd)
	time.sleep(0.1)
print "GPIO.cleanup()"
GPIO.cleanup()
