# Author: Hyunjun Lim
# Title: Motion Probing Sensor
#
#!/usr/bin/env python
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
PIR_PIN = 7

GPIO.setup(PIR_PIN, GPIO.IN)

try:
    print "PIR Module Test (CTRL+C to exit)"
    time.sleep(2)
    print "Ready"

    while True:
        if GPIO.input(PIR_PIN):
            t = time.localtime()
            print "%d:%d:%d Motion Detected!" % (t.tm_hour, t.tm_min, t.tm_sec)
        time.sleep(0.05)

except KeyboardInterrupt:
    print " Quit"
    GPIO.cleanup()
