/**
 * @Author: Hyunjun Lim, Suyeon Lim
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

int main(void){
    int result;
  
    // Start Smart Secretary
    printf ("Starting Smart Secretary Launcher...");
    printf ("Press CTRL+C if you want to stop.";

    // Step1: run Apache web-server
    // * $ sudo systemctl restart apache2
    result = system(sudo systemctl restart apache2);
    if (result == 0){
        printf("[ERROR] No shell is available.\n"); exit(0);
    }
    else if (result == 127){
        printf("[ERROR] A web-server process could not be created.\n"); exit(0);
    }
    else
        printf("Apache web-server is successfully started.\n");

    // Step2: run PIR motion sensor
    // * with background: exec /var/www/html/motion/pir-sensor.py &> /dev/null &
    // * with foreground: /var/www/html/motion/pir-sensor.py
    result = system(/var/www/html/motion/pir-sensor.py);
    if (result == 0){
        printf("[ERROR] No shell is available.\n"); exit(0);
    }
    else if (result == 127){
        printf("[ERROR] A PIR sensor process could not be created.\n"); exit(0);
    }
    else
        printf("A PIR sensor process is successfully started.\n");
            
    // display help message to users.
    printf("Please visit http://localhost/ to use web-application.\n");
            
    return 0;
}
