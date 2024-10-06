FROM mariadb:10.2

RUN apt-get update && \
    apt-get install -y mariadb-plugin-tokudb libjemalloc1

ENV LD_PRELOAD=/usr/lib/x86_64-linux-gnu/libjemalloc.so.1
RUN echo "plugin-load=ha_tokudb" >> /etc/mysql/conf.d/tokudb.cnf
COPY disable-thp.sh /usr/local/bin/disable-thp.sh
RUN chmod +x /usr/local/bin/disable-thp.sh
# RUN echo "malloc-lib=/usr/lib/x86_64-linux-gnu/libjemalloc.so.2" >> /etc/mysql/conf.d/tokudb.cnf