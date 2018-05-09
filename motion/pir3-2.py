# Author: Hyunjun Lim
# Date: May-07-2018
# Title: motion prober software
# Caution:
# 1. Check location of  +DC voltage and GND line
# 2. Change sensor and pulse button (orange color) appropriately
#
from gpiozero import MotionSensor
import time

print "Starting motion sensor..."
pir = MotionSensor(4)
count = 0
while True:
	pir.wait_for_motion()
        count += 1
	print ("Motion Detected! " + str(count))
	time.sleep(1)
print "GPIO.cleanup()"
GPIO.cleanup()
