 
# 응용 예제 

* 디지털 weather 만들기 (***)
* Raspberry Pi AP mode 설정(라즈베리파이를 무선 공유기 처럼 사용하기)
* CCTV 개발하기
* 디지털 앨범 개발하기
* 웹서버 만들기
* 동영상 스트리밍 서비스 개발하기
* 라디오 제작하기
* 말하는 알람 시계 http://www.instructables.com/id/Speaking-Alarm-Clock/
* 얼굴/웃음 감지기(opencv/python) http://www.instructables.com/id/Smile-Detection-With-Raspberry-Pi-Using-Opencv-and/ 

* 인터넷 라디오 * http://www.instructables.com/id/Raspberry-Pi-Internet-Radio/
* 라즈베리 파이는 마인크래프트 서버 * http://www.instructables.com/id/Raspberry-Pi-Minecraft-Server/
* 수면 주기 알람 시계 * http://www.instructables.com/id/WeggUp-A-sleeping-cycle-and-light-alarm-clocke/
* 개인비서 생성 * http://www.instructables.com/id/Raspberri-Personal-Assistant/
* 커스텀 열전사 프린터 * https://www.adafruit.com/product/1289
* 왓츠앱 http://www.instructables.com/id/WhatsApp-on-Raspberry-Pi/
* 미니 아케이드 * http://www.instructables.com/id/Build-your-own-Mini-Arcade-Cabinet-with-Raspberry-/
* HD 감시 카메라 -http://www.instructables.com/id/Raspberry-Pi-as-low-cost-HD-surveillance-camera/ 

* 게임 스테이션 http://www.instructables.com/id/Coffee-Table-Pi/
* Kodi Edition Raspberry Pi case * https://kodi.tv/article/official-kodi-edition-raspberry-pi-case
* OpenCL implementation running on the VideoCore IV GPU of the Raspberry Pi models https://github.com/doe300/VC4CL
* 음석 인식 (arecord/aplay, h/w: 3.5mm 오디오 잭 스피커와 USB 마이크) http://makeshare.org/bbs/board.php?bo_table=raspberrypi&wr_id=103 



# 운영체제(OS) 다운로드 및 설치하기 

* 인기 있는 OS 종류: 1) 라즈비안, 2) 우분투(마테버젼)*
OS 이미지를 다운로드하기 위하여 https://www.raspberrypi.org/downloads/ 에 접속후 2) 우분투(마테버젼)을 다운로드 한다.

* 보관장소(OS): D:\raspberrypi3\
보관장소(유틸리티): \\192.168.219.2\work\scratch\정보올림피아드문제-공모전\raspberry-pi3-board-sw 


* SD_CardFormatter0500SetupEN.exe 프로그램으로 micro SDcard를 포맷해야 한다.
다운로드 주소: https://www.download3k.com/Install-SDFormatter.html 


* 그리고나서, win32diskimager-1.0.0-install.exe 프로그램으로 다운로드한 OS을 micro SDcard에 설치해야 한다.
다운로드 주소: https://sourceforge.net/projects/win32diskimager/files/Archive/ 




# WiFi 설정 방법 ( 라즈비안 OS의 경우임.) 

라즈베리파이3는 WiFi 와 블루투스가 자체 내장되어있습니다.

라즈비안 OS의 경우에는 WiFI SSID를 정상적으로 scanning하기 위하여 WiFi Country에서 반드시 US (United State)를 선택해야 한다.
```bash
* 기본설정 - Raspberry Configuration - Localisation - WiFi Country - US (United State) 선택
```

# SSH 서버 설치하기 
```bash
  sudo apt -y install openssh-server openssh-client
  sudo systemctl restart ssh
  sudo systemctl enable ssh  
  ifconfig
```  
이제 windows7 PC에서 mobaxterm 프로그램을 실행한후에 RaspBerry Pi 3보드의 SSH 서버에 접속하면 된다.


# Raspberry Pi 화면 180도 회전 시키기 

```bash
sudo vi /boot/config.txt 
display_rotate=2 
(0:0도, 1:90도, 2:180도, 3: 270도) 
```

# 터치스크린 보정을 위해 xinput_calibrator 설치 

필요한 프로그램 설치
```bash
sudo apt-get install libx11-dev libxext-dev libxi-dev x11proto-input-dev 
```
xinput_calibrator 다운로드
```bash
wget http://github.com/downloads/tias/xinput_calibrator/xinput_calibrator-0.7.5.tar.gz 
ls 
```
설치...(압축 풀고 해당 폴더에서...)
```bash
tar xvzf xinput_calibrator-0.7.5.tar.gz
cd xinput_calibrator-0.7.5
./configure 
make 
sudo make install 
```
실행 (Rasp Berry Pi3 보드에서 실행해야함.)
```bash
xinput_calibrator 
```
터치 4번 손으로 직접 조정하면 보정됨.
터치스크린 보정한 것을 부팅할때마다 자동으로 항상 불러오기
```bash
# mkdir /etc/X11/xorg.conf.d
# vi /etc/X11/xorg.conf.d/99-calibration.conf
 
Section "InputClass"
  Identifier "calibration"
  MatchProduct "FT5406 memory based driver"   
  Option "Calibration" "801 14 463 -12"
EndSection
```
재부팅시에 그래픽 화면이 나오지 않고 콘솔 화면으로 나온다면, 이 경우 대부분 99-calibration.conf 파일의 내용에 오타가 있었다.
```bash
# cd /etc/X11/xorg.conf.d/
# mv 99-calibration.conf 99-calibration.conf.disable
```
edit
7. 웹서버 설치하기 
라즈베리 파이 보드를 이용하여 자신만의 웹서버를 운영할 수 있다.
sudo apt install apache2
sudo systemctl restart apache2 
sudo systemctl enable apache2
firefox http://192.168.219.104 
sudo vi /var/www/html/index.html
<H2> This webserver is created by Gildong Hong</H2>
<br>
<img src=./now.jpg></img> 
User1 &nbsp; &nbsp; &nbsp; User2 &nbsp; &nbsp; &nbsp; User3
<br> 

<br>
<br>
1. [사용자1]<br>
오늘 수학숙제를 내는 날 입니다.<br>
오늘은 고양이를 병원에 데려가는 날입니다.<br>
5시에 수학학원을 가야 합니다.<br>

# 날씨 정보 습득 프로그램 설치 (google keywords: Weather from terminal) 

예제)
```bash
firefox https://github.com/chubin/wttr.in
curl http://wttr.in/:help
curl  wttr.in/suwon?0
curl wttr.in/suwon?n
curl wttr.in/suwon?lang=ko
wget wttr.in/suwon_0tqp_lang=suwon.png
convert -resize 800x600 suwon.png suwon-big.png
wget wttr.in/suwon_0tqp_lang=suwon.html
wget wttr.in/suwon.png
```

예제)
```bash
firefox https://github.com/fcambus/ansiweather
sudo apt-get install ansiweatherr
ansiweather -l London,GB -f 3
London forecast => Sat Jan 13: 7/2 °C ☔ - Sun Jan 14: 4/1 °C ☔ - Mon Jan 15: 9/6 °C ☔
```

예제)
```bash
firefox https://weather.com/weather/hourbyhour/l/USIL0074
```


예제)
```bash
$ cat ./weather.sh
#!/bin/bash
weather(){ curl -s "http://api.wunderground.com/auto/wui/geo/ForecastXML/index.xml?query=${@:-<YOURZIPORLOCATION>}"|perl -ne '/<title>([^<]+)/&&printf "%s: ",$1;/<fcttext>([^<]+)/&&print $1,"\n"';}
weather $1

$ bash weather.sh  suwon
```


## PHP 개발환경 설치

```bash
$ sudo apt-get -y install php php-cgi libapache2-mod-php php-common php-pear php-mbstring
$ sudo a2enconf php7.0-cgi 
$ sudo systemctl restart apache2 
$ sudo cd /var/www/html
$ sudo vi /var/www/html/index.php

<html>
<body>
<?php
  print Date("Y/m/d");
?>
</body>
</html 
```
 
 
# 기타 - VNC Server Setup on Raspberry Pi 3 

Install VNC Server
 
sudo apt install tightvncserver   (OR sudo apt install vnc4server)
vi ~/vnc.sh
---------- vnc server:start ---------------
#!/bin/sh
vncserver :1 -geometry 1280x1024 -depth 24
---------- vnc server: end ----------------

vi ~/.vnc/xstartup
---------- start ---------------
#!/bin/sh
xrdb $HOME/.Xresources
xsetroot -solid grey -cursor_name left_ptr
#x-terminal-emulator -geometry 80x24+10+10 -ls -title "$VNCDESKTOP Desktop" &
#x-window-manager &
# Fix to make GNOME work
export XKL_XMODMAP_DISABLE=1
/etc/X11/Xsession
---------- end ----------------

vncserver -kill :1


Run VNC client
firefox https://www.realvnc.com/en/connect/download/viewer/에서 프로그램을 다운로드한다.
접속할때 아래의 IP 및 암호를 입력하면 된다. 
 * IP 192.168.219.104:5901
 * password: ***
edit
10. gstreamer - 라즈베리 카메라 모듈 V2 탑재 및 실시간 카메라 Streamming 서비스 실행하기 
http://www.icbanq.com/P007122889 (라즈베리파이 카메라 모듈 V2 8MegaPixel) 

Install gstreamer
sudo apt update
sudo apt upgrade

sudo apt install gstreamer1.0
----gstreamer installation: start ------------
The following NEW packages will be installed:
  debhelper dh-strip-nondeterminism freepats gstreamer1.0-clutter gstreamer1.0-doc
  gstreamer1.0-dvswitch gstreamer1.0-espeak gstreamer1.0-fluendo-mp3 gstreamer1.0-hybris
  gstreamer1.0-libav gstreamer1.0-libav-dbg gstreamer1.0-packagekit gstreamer1.0-plugins-bad
  gstreamer1.0-plugins-bad-dbg gstreamer1.0-plugins-bad-doc gstreamer1.0-plugins-bad-faad
  gstreamer1.0-plugins-bad-videoparsers gstreamer1.0-plugins-base-apps
  gstreamer1.0-plugins-base-dbg gstreamer1.0-plugins-base-doc gstreamer1.0-plugins-good-dbg
  gstreamer1.0-plugins-good-doc gstreamer1.0-plugins-ugly gstreamer1.0-plugins-ugly-amr
  gstreamer1.0-plugins-ugly-dbg gstreamer1.0-plugins-ugly-doc gstreamer1.0-pocketsphinx
  gstreamer1.0-vaapi gstreamer1.0-vaapi-doc intltool-debian libandroid-properties1
  libarchive-zip-perl libavfilter-ffmpeg5 libavresample-ffmpeg2 libde265-0
  libfile-stripnondeterminism-perl libglib2.0-dev libglib2.0-doc libgstreamer-plugins-bad1.0-0
  libgstreamer1.0-0-dbg libgstreamer1.0-dev libhybris-common1 libmail-sendmail-perl libmedia1
  libmimic0 libmjpegutils-2.1-0 libmms0 libmpeg2encpp-2.1-0 libmpg123-0 libmplex2-2.1-0 libofa0
  libopencore-amrnb0 libopencore-amrwb0 libopencv-calib3d2.4v5 libopencv-contrib2.4v5
  libopencv-features2d2.4v5 libopencv-flann2.4v5 libopencv-highgui2.4v5 libopencv-legacy2.4v5
  libopencv-ml2.4v5 libopencv-objdetect2.4v5 libopencv-video2.4v5 libpcre3-dev libpcre32-3
  libpcrecpp0v5 libpocketsphinx3 libsidplay1v5 libsoundtouch1 libspandsp2 libsphinxbase3 libsrtp0
  libsys-hostname-long-perl libva-wayland1 libvo-aacenc0 libvo-amrwbenc0 libwildmidi-config
  libwildmidi1 libzbar0 po-debconf zlib1g-dev
----gstreamer installation: end ------------

Run shell script to stream captured image files
gst-launch-1.0 --version
vi camera_test.sh
#---------- script code: start -------------------
#!/usr/bin/env bash
MY_IP=$(hostname -I)
echo "My IP Addr is $MY_IP"
raspivid -t 0 -h 720 -w 1280 -fps 25 -hf -b 2000000 -o - | gst-launch-1.0 \
-v fdsrc ! h264parse ! rtph264pay config-interval=1 pt=96 ! gdppay ! tcpserversink host=$MY_IP port=5000
#---------- script code: end -------------------

chmod +x camera_test.sh
./camera_test.sh

라즈베리파이 보드에 연결된 터치스크린/모니터에 카메라의 촬영 창이 실행되는 것을 볼수 있다.

안드로이드 모바일 폰은 구글스토어에서 "RaspberryPi Camera viewer"라는 애플리케이션을 검색/설치하면 된다. 그리고나서 해당 모바일 앱을 실행한후에 "+" 아이콘을 클릭하여 메뉴버턴을 생성한다. 생성된 메뉴버턴을 클릭한후 아래의 정보를 입력한다.
Name: 192.168.219.104
IP Address: 192.168.219.104
Port: 5000
Description: New Raspberry Pi device
Aspect ratio: 1.6 



edit
11. VLC: How to live stream video from webcam on Linux 

# Verify Webcam Device on VLC
$ ls /dev/video*
$ vlc v4l2:///dev/video0

# Live Stream Webcam from the Command Line
$ cvlc v4l2:///dev/video0 :v4l2-standard= :input-slave=alsa://hw:0,0 :live-caching=300 :sout="#transcode{vcodec=WMV2,vb=800,scale=1,acodec=wma2,ab=128,channels=2,samplerate=44100}:http{dst=:8080/stream.wmv}"


# Security Protections for Your Webcam Feed
$ vlc http://<ip_address_of_webcam_host>:8080/stream.wmv
$ mplayer http://<ip_address_of_webcam_host>:8080/stream.wmv


edit
12. OSS/ASLA: How to Record your Voice from the Microphone of USB Webcam ¶

Record a voice
 # make sure your microphone is connected to device
alsamixer
# capture microphone input with arecord

sudo apt install alsa-utils
# check probed audio devices
arecord -l
vi ~/.asoundrc
# http://auction.kr/iBV35PO (Logitech, HD Pro Webcam C920)
# hw:<card-val>,<device-val>
pcm.copy { type plug slave { pcm "hw:2,0" } } ctl.!default { type hw card 2 }


arecord -D copy -d 10 foo.wav

Play recorded audio file
 aplay foo.w


