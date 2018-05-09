# pip install gpiozero
# python pir3.py
#
import time
from gpiozero import MotionSensor

pir = MotionSensor(4)
while True:
    if pir.motion_detected:
        print('Motion detected')
        time.sleep(2)
