# Author: Hyunjun Lim
# Title: Motion Probing Sensor
#
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
PIR_PIN = 4
# PIR_PIN = 21

GPIO.setup(PIR_PIN, GPIO.IN)

try:
    print "PIR Module Test (CTRL+C to exit)"
    time.sleep(2)
    print "Ready"

    while True:
        if GPIO.input(PIR_PIN)==1:
            t = time.localtime()
            print "%d:%d:%d Motion Detected!" % (t.tm_hour, t.tm_min, t.tm_sec)
        time.sleep(1)

except KeyboardInterrupt:
    print "Quit"
    GPIO.cleanup()
