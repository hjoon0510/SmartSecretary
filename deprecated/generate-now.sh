
#!/usr/bin/env bash

# Author: Hyoonjun Lim
# Date: May-05-2018
# Title: weather file generate

# how to generate a picture file per 1 minutes
# sudo vi /etc/crontab
# make weather picture file per 1 minutes
# */01 * * * * root /var/www/html/generate-now.sh
#

# go to root directory of home page
cd /var/www/html

# let's create picture file from wttr.in website
FILTER=Suwon_0tqp_lang=suwon.png
#FILTER=suwon.png
wget wttr.in/${FILTER}

# Then, rename the generated picture file as follows.
mv ${FILTER}  suwon-now.png
