flag=true

while $flag; do

  if (docker-compose -f ./docker/docker-compose.yml logs | grep Ready > /dev/null 2>&1) ; then
    echo "Mysql Ready"
    flag=false
  fi

done