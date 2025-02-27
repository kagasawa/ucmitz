#
# init.sh
# コンテナの初期化
# マイグレーション、書き込み権限の変更などを行う
# マイグレーションを実行する際、DBの起動より先に実行すると失敗してしまうため sleep で待つようにしている
#

echo "[$(date +"%Y/%m/%d %H:%M:%S")] Init Container start."

if [ ! -e '/var/www/html/docker_inited' ]; then

    # composer
    echo "[$(date +"%Y/%m/%d %H:%M:%S")] composer start."
    composer install --no-plugins

    # .env
    echo "[$(date +"%Y/%m/%d %H:%M:%S")] create .env."
    cp /var/www/html/config/.env.example /var/www/html/config/.env

    # bashrc
    echo "[$(date +"%Y/%m/%d %H:%M:%S")] Add Path to Environment."
    echo "export PATH=$PATH:/var/www/html/bin:/var/www/html/vendor/bin" >> ~/.bashrc

    # jwt
    echo "[$(date +"%Y/%m/%d %H:%M:%S")] Create JWT key."
    rm /var/www/shared/config/jwt.key
    rm /var/www/shared/config/jwt.pem
    openssl genrsa -out /var/www/html/config/jwt.key 1024
    openssl rsa -in /var/www/html/config/jwt.key -outform PEM -pubout -out /var/www/html/config/jwt.pem
    chown www-data.www-data /var/www/html/config/jwt.key

    # Guest tmp and logs
    echo "[$(date +"%Y/%m/%d %H:%M:%S")] Change Mode tmp and logs"
    chmod -R 777 /var/www/html/tmp
    chmod -R 777 /var/www/html/logs
    chmod 777 /var/www/html/plugins

    # Migrations
    echo "[$(date +"%Y/%m/%d %H:%M:%S")] Migration start."
    TIMES=0
    LIMIT_TIMES=50
    CONNECTED=1
    while [ "$(mysqladmin ping -h bc5-db -uroot -proot)" != "mysqld is alive" ]
    do
        echo "try connect $TIMES times"
        sleep 1
        TIMES=`expr $TIMES + 1`
        if [ $TIMES -eq $LIMIT_TIMES ]; then
            CONNECTED=0
            echo "MySQL timeout."
            break
        fi
    done
    if [ $CONNECTED -eq 1 ]; then
        mysql -h bc5-db -uroot -proot basercms -N -e 'show tables' | while read table; do mysql -h bc5-db -uroot -proot -e "drop table $table" basercms; done
        /var/www/html/bin/cake migrations migrate --plugin BaserCore
        /var/www/html/bin/cake migrations seed --plugin BaserCore
        /var/www/html/bin/cake migrations migrate --plugin BcSearchIndex
        /var/www/html/bin/cake migrations seed --plugin BcSearchIndex
        /var/www/html/bin/cake plugin assets symlink
    else
        echo "[$(date +"%Y/%m/%d %H:%M:%S")] Migration failed."
	fi

    # Clear cache
    /var/www/html/bin/cake cache clear_all

	# Touch installed
    touch /var/www/html/docker_inited

fi

echo "[$(date +"%Y/%m/%d %H:%M:%S")] Container setup is complete."
