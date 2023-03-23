FROM mysql:5.7
ADD init-entrypoint/* /docker-entrypoint-initdb.d/
CMD ["mysqld"]
EXPOSE 3306
