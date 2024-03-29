FROM ubuntu:20.04

ENV SYSCOIN_VERSION 4.4.2

RUN apt-get update     \
    && apt-get install -y ca-certificates curl unzip libfontconfig1 --no-install-recommends     \
    && apt-get clean     \
    && rm -rf /var/lib/apt/lists/*     \
    && update-ca-certificates
RUN curl -LO https://github.com/syscoin/syscoin/releases/download/v$SYSCOIN_VERSION/syscoin-$SYSCOIN_VERSION-x86_64-linux-gnu.tar.gz      \
    && tar -zvxf syscoin-$SYSCOIN_VERSION-x86_64-linux-gnu.tar.gz      \
    && rm syscoin-$SYSCOIN_VERSION-x86_64-linux-gnu.tar.gz      \
    && mv syscoin-$SYSCOIN_VERSION/bin/* /usr/local/bin/      \
    && mv syscoin-$SYSCOIN_VERSION/lib/* /lib/x86_64-linux-gnu/

ADD ./ /usr/local/bin

ENTRYPOINT ["syscoind"]
