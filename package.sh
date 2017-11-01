#!/bin/bash

rm rm-order-exporter.ocmod.zip

zip rm-order-exporter.ocmod.zip \
    install.xml \
    LICENSE \
    README.md \
    -r upload
