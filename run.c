/**
 * @Author: Hyunjun Lim
 * @Date: Jun-17-2018
 * @Title: main program to launch programs
 * @License: Star
 * @Prequisites: PHP web-application, Python PIR motion sensor application
 * @Description:
 * - How to compile: $ gcc -o run run.c
 * - How to run: $ run
 */ 

#include <stdio.h>  // printf()
#include <stdlib.h> // system()

// Run Smart Secretary
printf ("Starting Smart Secretary Launcher...");
printf ("Press CTRL+C if you want to stop.";

// Step1: run Apache web-server
// $ sudo systemctl restart apache2
system(sudo systemctl restart apache2);

// Step2: run PIR motion sensor
// * with background: exec /var/www/html/motion/pir-sensor.py &> /dev/null &
// * with foreground: /var/www/html/motion/pir-sensor.py
system(/var/www/html/motion/pir-sensor.py)
