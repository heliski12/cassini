#!/bin/bash

date_string=`date +%Y%m%d%H%M%S`

mysqldump -u motionry_cassini --password=${DB_PASSWORD} -h mysql.dh.motionry.com motionry_cassini > /home/motionry/backups/motionry_cassini_${date_string}.sql

status1=`/home/motionry/s3cmd/s3cmd --access_key=${AWS_KEY} --secret_key=${AWS_SECRET} put /home/motionry/backups/motionry_cassini_${date_string}.sql s3://motionry-db/`

echo "backups ran - ${date_string} ${status1}" | mail -s "motionry backups" jstavis@gmail.com
